<?php include "includes/header.php";

// Fetch news details if ID is provided
if (isset($_GET['id'])) {
    $news_id = $_GET['id'];
    $news = Database::search(
        "SELECT *, DATE_FORMAT(publish_date, '%W, %M %e, %Y') AS formatted_date 
         FROM news WHERE news_id = ?",
        [$news_id]
    )->fetch_assoc();
    
    $news_images = Database::search(
        "SELECT * FROM news_images WHERE news_id = ?",
        [$news_id]
    );
}

// Function to check image existence
function getImagePath($path) {
    $fullPath = __DIR__ . '/' . $path;
    return (file_exists($fullPath) && is_file($fullPath)) ? $path : 'assets/images/default-news.jpg';
}

// Format description with markdown links
function formatNewsContent($text) {
    $text = nl2br(htmlspecialchars_decode($text));
    $text = preg_replace('/\*(.*?)\*\s*:\s*(https?:\/\/[^\s]+)/', '<a href="$2" target="_blank" class="text-info font-weight-bold">$1</a>', $text);
    return $text;
}
?>

<main class="container-fluid px-0">
    <!-- News Header Section -->
    <section class="news-header bg-gradient-info text-white py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-4 font-weight-bold mb-3"><?= htmlspecialchars($news['title'] ?? 'News Article') ?></h1>
                    <div class="header-divider mx-auto bg-white"></div>
                    <?php if(isset($news['publish_date'])): ?>
                    <div class="news-meta mt-4">
                        <div class="publish-date badge badge-light text-info p-3">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            Published: <?= htmlspecialchars($news['formatted_date']) ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-5">
        <div class="row">
            <!-- Main News Content -->
            <div class="col-lg-8 mb-5 mb-lg-0">
                <article class="news-content card shadow-lg">
                    <!-- Main News Image -->
                    <?php if (!empty($news['main_image'])): ?>
                        <div class="main-image-container">
                            <img src="<?= getImagePath($news['main_image']) ?>" 
                                class="img-cover"
                                alt="<?= htmlspecialchars($news['title']) ?>">
                        </div>
                    <?php endif; ?>

                    <!-- News Body -->
                    <div class="card-body p-4 p-lg-5">
                        <?php if(!empty($news['content'])): ?>
                        <div class="news-description">
                            <?= formatNewsContent($news['content']) ?>
                        </div>
                        <?php endif; ?>

                        <!-- Additional Images Gallery -->
                        <?php if ($news_images->num_rows > 0): ?>
                        <div class="additional-images mt-5 pt-4 border-top">
                            <h4 class="text-info mb-4">Event Gallery</h4>
                            <div class="row gallery-grid">
                                <?php while ($image = $news_images->fetch_assoc()): ?>
                                    <div class="col-6 col-md-4 col-lg-6 mb-3">
                                        <img src="<?= getImagePath($image['image_path']) ?>" 
                                            class="img-thumbnail"
                                            alt="Gallery image">
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="news-actions mt-5 pt-4 border-top">
                            <a href="news.php" class="btn btn-outline-info">
                                <i class="fas fa-arrow-left mr-2"></i>Back to News
                            </a>
                        </div>
                    </div>
                </article>
            </div>

            <!-- News Sidebar -->
            <div class="col-lg-4">
                <!-- Recent News -->
                <div class="recent-news card shadow-lg mb-4">
                    <div class="card-header bg-info text-white">
                        <h3 class="h5 mb-0">Recent News</h3>
                    </div>
                    <div class="card-body p-3">
                        <?php 
                        $recent_news = Database::search(
                            "SELECT * FROM news 
                             ORDER BY publish_date DESC 
                             LIMIT 4"
                        );
                        while ($recent = $recent_news->fetch_assoc()): ?>
                            <div class="recent-item mb-3">
                                <a href="news-single.php?id=<?= $recent['news_id'] ?>" 
                                   class="text-decoration-none">
                                    <div class="media">
                                        <?php $first_image = Database::search(
                                            "SELECT image_path FROM news_images 
                                             WHERE news_id = ? LIMIT 1",
                                            [$recent['news_id']]
                                        )->fetch_assoc(); ?>
                                        <img src="<?= getImagePath($first_image['image_path'] ?? $recent['main_image']) ?>" 
                                            class="mr-3 img-cover" 
                                            style="width: 80px; height: 80px;"
                                            alt="<?= htmlspecialchars($recent['title']) ?>">
                                        <div class="media-body">
                                            <h6 class="mt-0 text-dark font-weight-bold">
                                                <?= htmlspecialchars($recent['title']) ?>
                                            </h6>
                                            <small class="text-muted">
                                                <?= date('M j, Y', strtotime($recent['publish_date'])) ?>
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    .news-header {
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
        /* width: 100%;
        height: 100%; */
        justify-content: center;
        align-items: center;
    }
    
    .news-description {
        line-height: 1.8;
        font-size: 1.1rem;
        color: #495057;
    }
    
    .news-description img {
        max-width: 100%;
        height: auto;
        margin: 1rem 0;
        border-radius: 5px;
    }
    
    .recent-item:hover {
        transform: translateX(5px);
        transition: transform 0.3s ease;
    }
    
    @media (max-width: 768px) {
        .news-header {
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        
        .news-header h1 {
            font-size: 2rem;
        }
        
        .publish-date {
            font-size: 0.9rem;
        }
    }
</style>

<?php include "includes/footer.php" ?>