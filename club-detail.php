<?php 
require "includes/header.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$club_id = $_GET['id'];
$club = Database::search("SELECT * FROM clubs WHERE club_id = ?", [$club_id])->fetch_assoc();

if (!$club) {
    header("Location: index.php");
    exit();
}

// Get gallery images
$gallery_images = Database::search("SELECT * FROM club_gallery WHERE club_id = ?", [$club_id]);
?>

<!-- Hero Section -->
<section class="hero-section position-relative">
    <div class="hero-image" style="background-image: url('<?= htmlspecialchars($club['hero_image']) ?>');">
        <div class="hero-overlay d-flex align-items-center">
            <div class="container text-center text-white">
                <h1 class="display-4 mb-2" style="font-weight: 600; font-size: 4rem;"> <?= htmlspecialchars($club['hero_title']) ?></h1>
                <p class="lead"><?= htmlspecialchars($club['hero_subtitle']) ?></p>
                <a href="#admission" class="btn btn-primary btn-lg mt-3">Apply Now</a>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="mb-4">About Our Society</h2>
                <p class="lead"><?= htmlspecialchars($club['about_text']) ?></p>
            </div>
            <div class="col-lg-6">
                <img src="<?= htmlspecialchars($club['about_image']) ?>" alt="About Us" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>

<!-- Admission Process -->
<section id="admission" class="admission-process py-5">
    <div class="container">
        <h2 class="text-center mb-5">Admission Process</h2>
        <div class="row">
            <?php
            $steps = Database::search("SELECT * FROM club_admission_steps WHERE club_id = ? ORDER BY step_order", [$club_id]);
            while ($step = $steps->fetch_assoc()) {
                echo <<<HTML
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow">
                        <div class="card-body">
                            <h3 class="card-title">{$step['step_title']}</h3>
                            <p>{$step['step_description']}</p>
                        </div>
                    </div>
                </div>
HTML;
            }
            ?>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="gallery-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Our Creative Work</h2>
        
        <!-- Gallery Filters -->
        <div class="row mb-4 justify-content-center">
            <div class="col-auto">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-dark active" data-filter="all">All</button>
                    <?php
                    $categories = Database::search("SELECT DISTINCT category FROM club_gallery WHERE club_id = ?", [$club_id]);
                    while ($cat = $categories->fetch_assoc()) {
                        echo '<button type="button" class="btn btn-outline-dark" data-filter="'.htmlspecialchars($cat['category']).'">'.htmlspecialchars($cat['category']).'</button>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Gallery Grid -->
        <div class="row grid-gallery" data-masonry='{"percentPosition": true}'>
            <?php 
            while ($image = $gallery_images->fetch_assoc()) {
                echo <<<HTML
                <div class="col-md-4 col-lg-3 mb-4 gallery-item {$image['category']}">
                    <a href="{$image['image_path']}" data-lightbox="gallery-{$club_id}">
                        <div class="image-container">
                            <img src="{$image['image_path']}" class="img-fluid" alt="Gallery Image">
                            <div class="image-overlay">
                                <div class="overlay-content">
                                    <span class="badge bg-dark mb-2">{$image['category']}</span>
                                    <i class="fas fa-expand-arrows-alt fa-2x text-white"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
HTML;
            }
            ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

<style>
    .hero-section {
        height: 70vh;
        min-height: 500px;
    }

    .hero-image {
        height: 100%;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
    }
    
.gallery-section {
    background: #f8f9fa;
}

.image-container {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    transition: transform 0.3s ease;
}

.image-container:hover {
    transform: translateY(-5px);
}

.image-container img {
    transition: transform 0.3s ease;
}

.image-container:hover img {
    transform: scale(1.05);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.image-container:hover .image-overlay {
    opacity: 1;
}

.overlay-content {
    text-align: center;
}

.btn-group .active {
    background: #212529;
    color: white;
}

/* Masonry grid layout */
.grid-gallery {
    column-count: 3;
    column-gap: 1.5rem;
}

.gallery-item {
    break-inside: avoid;
    margin-bottom: 1.5rem;
}

@media (max-width: 768px) {
    .grid-gallery {
        column-count: 2;
    }
}

@media (max-width: 576px) {
    .grid-gallery {
        column-count: 1;
    }
}
</style>

<script>
// Filtering functionality
document.querySelectorAll('[data-filter]').forEach(button => {
    button.addEventListener('click', () => {
        const filter = button.dataset.filter;
        
        // Update active state
        document.querySelectorAll('[data-filter]').forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
        
        // Filter items
        document.querySelectorAll('.gallery-item').forEach(item => {
            if (filter === 'all' || item.classList.contains(filter)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
</script>

<!-- Required Libraries -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js"></script>