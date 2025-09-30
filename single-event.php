<?php include "includes/header.php";
if (isset($_GET['id'])) {
    $event_id = $_GET['id'];
    $event = Database::search("SELECT *, DATE_FORMAT(date, '%W, %M %e, %Y') AS formatted_date FROM events WHERE event_id = ?", [$event_id])->fetch_assoc();
    $images = Database::search("SELECT * FROM event_images WHERE event_id = ?", [$event_id]);

    // If no images found, set num_rows to 0
    if (!$images) {
        $images = new stdClass();
        $images->num_rows = 0;
    }
}

// Function to check if image exists and return default if not
function getImagePath($path) {
    $fullPath = __DIR__ . '/' . $path;
    if (file_exists($fullPath) && is_file($fullPath)) {
        return $path;
    }
    return 'assets/images/default-event.jpg';
}

function formatEventDescription($text) {
    $text = nl2br(htmlspecialchars_decode($text));
    $text = preg_replace('/\*(.*?)\*\s*:\s*(https?:\/\/[^\s]+)/', '<a href="$2" target="_blank" class="text-info font-weight-bold">$1</a>', $text);
    return $text;
}
?>

<main class="container-fluid px-0">
    <!-- Event Header Section -->
    <section class="event-header bg-gradient-info text-white py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-4 font-weight-bold mb-3"><?= htmlspecialchars($event['topic'] ?? 'Event Details') ?></h1>
                    <div class="header-divider mx-auto bg-white"></div>
                    <?php if(isset($event['date'])): ?>
                    <div class="event-meta mt-4">
                        <div class="event-date badge badge-light text-info p-3">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <?= htmlspecialchars($event['formatted_date']) ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-5">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8 mb-5 mb-lg-0">
                <article class="event-content card shadow-lg">
                    <!-- Image Gallery -->
                    <?php if ($images->num_rows > 0): ?>
                        <div id="mainCarousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php for ($i = 0; $i < $images->num_rows; $i++): ?>
                                    <li data-target="#mainCarousel" data-slide-to="<?= $i ?>" 
                                        <?= $i == 0 ? 'class="active"' : '' ?>></li>
                                <?php endfor; ?>
                            </ol>
                            <div class="carousel-inner ratio ratio-16x9">
                                <?php $first = true; 
                                while ($image = $images->fetch_assoc()): 
                                    $imagePath = getImagePath($image['image_path']); ?>
                                    <div class="carousel-item <?= $first ? 'active' : '' ?>">
                                        <img src="<?= htmlspecialchars($imagePath) ?>" 
                                            class="d-block card-img-top"
                                            alt="<?= htmlspecialchars($event['topic']) ?>">
                                    </div>
                                <?php $first = false; endwhile; ?>
                            </div>
                            <?php if ($images->num_rows > 1): ?>
                                <a class="carousel-control-prev" href="#mainCarousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#mainCarousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="no-image text-center p-5 bg-light">
                            <img src="assets/images/default-event.jpg" 
                                class="img-fluid img-contain"
                                style="max-height: 400px;"
                                alt="No images available">
                            <p class="text-muted mt-3">No images available for this event</p>
                        </div>
                    <?php endif; ?>

                    <!-- Event Details -->
                    <div class="card-body p-4 p-lg-5">
                        <?php if(!empty($event['caption'])): ?>
                        <h2 class="event-caption h3 font-weight-bold text-info mb-4">
                            <?= htmlspecialchars($event['caption']) ?>
                        </h2>
                        <?php endif; ?>
                        
                        <div class="event-description">
                            <?= formatEventDescription($event['Description'] ?? '') ?>
                        </div>

                        <div class="event-actions mt-5 pt-4 border-top">
                            <a href="events.php" class="btn btn-outline-info">
                                <i class="fas fa-arrow-left mr-2"></i>Back to Events
                            </a>
                            <div class="social-share mt-3">
                                <span class="text-muted mr-2">Share:</span>
                                <a href="#" class="btn btn-sm btn-outline-secondary">
                                    <i class="fab fa-facebook"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-outline-secondary">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-link"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar Gallery -->
            <div class="col-lg-4">
                <?php if ($images->num_rows > 0): ?>
                    <div class="event-gallery card shadow-lg sticky-sidebar">
                        <div class="card-header bg-info text-white">
                            <h3 class="h5 mb-0">Event Gallery</h3>
                        </div>
                        <div class="card-body p-3">
                            <div class="row gallery-grid">
                                <?php $images->data_seek(0);
                                while ($image = $images->fetch_assoc()):
                                    $imagePath = getImagePath($image['image_path']); ?>
                                    <div class="col-6 col-md-4 col-lg-6 mb-3">
                                        <a href="<?= htmlspecialchars($imagePath) ?>" 
                                           data-toggle="lightbox" 
                                           data-gallery="event-gallery"
                                           class="gallery-item">
                                            <img src="<?= htmlspecialchars($imagePath) ?>" 
                                                class="img-fluid img-cover ratio ratio-1x1 card-img-top"
                                                alt="Gallery image">
                                        </a>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<style>
    .event-header {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        margin-bottom: 5rem;
    }
    
    .header-divider {
        width: 80px;
        height: 3px;
        background: rgba(255,255,255,0.5);
    }
    
    .img-cover {
        object-fit: cover;
    }
    
    .img-contain {
        object-fit: contain;
    }
    
    .event-gallery .gallery-item {
        display: block;
        overflow: hidden;
        border-radius: 5px;
        transition: transform 0.3s ease;
    }
    
    .event-gallery .gallery-item:hover {
        transform: translateY(-3px);
    }
    
    .event-caption {
        position: relative;
        padding-left: 1.5rem;
    }
    
    .event-caption::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0.4em;
        height: 1.2em;
        width: 5px;
        background: #17a2b8;
    }
    
    .event-description {
        line-height: 1.8;
        color: #495057;
        font-size: 1.1rem;
    }
    
    @media (max-width: 768px) {
        .event-header {
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        
        .event-header h1 {
            font-size: 2rem;
        }
        
        .event-date {
            font-size: 0.9rem;
        }
    }
</style>

<?php include "includes/footer.php" ?>