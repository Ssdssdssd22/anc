<?php include "includes/header.php" ?>
<div class="container-fluid">
    <!-- Main Header Section -->
    <div class="row justify-content-center mb-5 mt-lg-5">
        <div class="col-12 col-lg-10">
            <div class="page-header py-4 bg-gradient-info text-white rounded-lg shadow-lg">
                <h1 class="display-4 font-weight-bold text-center mb-0">News Blog</h1>
                <div class="divider mx-auto bg-white"></div>
                <p class="lead text-center mt-3">Stay updated with our latest news and announcements</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <?php
            function formatNewsContent($text) {
                $text = nl2br(htmlspecialchars_decode($text));
                $text = preg_replace('/\*(.*?)\*\s*:\s*(https?:\/\/[^\s]+)/', '<a href="$2" target="_blank" class="text-info font-weight-bold">$1</a>', $text);
                return $text;
            }

            $currentDate = new DateTime();
            
            // Latest News Section
            $latestNews = Database::search(
                "SELECT * FROM news 
                WHERE publish_date <= ? 
                ORDER BY publish_date DESC 
                LIMIT 5",
                [$currentDate->format('Y-m-d')]
            );
            ?>
            
            <!-- Latest News Section -->
            <section class="mb-5">
                <div class="section-header mb-4">
                    <h2 class="text-uppercase font-weight-bold position-relative">
                        <span class="bg-info text-white px-3 py-2 rounded">Latest News</span>
                        <span class="header-line bg-info"></span>
                    </h2>
                </div>

                <?php if($latestNews->num_rows > 0): ?>
                    <?php while ($news = $latestNews->fetch_assoc()): 
                        $publishDate = new DateTime($news['publish_date']);
                        $mainImage = Database::search(
                            "SELECT image_path FROM news_images 
                            WHERE news_id = ? 
                            LIMIT 1",
                            [$news['news_id']]
                        )->fetch_assoc();
                    ?>
                        <article class="news-card card shadow-lg mb-4 overflow-hidden">
                            <?php if(!empty($news['main_image'])): ?>
                            <div class="carousel-container position-relative">
                                <div class="">
                                    <img src="<?= $news['main_image'] ?>" 
                                        class="img-cover card-img-top"
                                        alt="<?= htmlspecialchars($news['title']) ?>">
                                </div>
                                <div class="date-badge bg-info text-white px-3 py-2 rounded shadow">
                                    <div class="day"><?= $publishDate->format('d') ?></div>
                                    <div class="month"><?= $publishDate->format('M') ?></div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="card-body p-4">
                                <a href="single-news.php?id=<?= $news['news_id'] ?>" class="text-decoration-none">
                                    <h3 class="card-title font-weight-bold text-dark mb-3"><?= htmlspecialchars($news['title']) ?></h3>
                                </a>
                                <div class="meta-info mb-3">
                                    <span class="text-muted">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        <?= $publishDate->format('F j, Y') ?>
                                    </span>
                                </div>
                                <div class="card-text news-description">
                                    <?= formatNewsContent(substr($news['content'], 0, 700)) ?>
                                    <?php if(strlen($news['content']) > 700): ?>
                                        <a href="single-news.php?id=<?= $news['news_id'] ?>" class="read-more">
                                            Continue Reading <i class="fas fa-arrow-right"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="alert alert-info">No news articles available. Check back later!</div>
                <?php endif; ?>
            </section>
        </div>

        <!-- Featured News Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-sidebar" style="top: 20px;">
                <div class="featured-header bg-info text-white p-4 rounded-lg shadow mb-4">
                    <h2 class="h4 font-weight-bold text-uppercase mb-0">Featured News</h2>
                    <div class="divider-small bg-white"></div>
                </div>

                <?php
                $featuredNews = Database::search(
                    "SELECT * FROM news 
                    ORDER BY publish_date DESC 
                    LIMIT 3"
                );
                while ($f_news = $featuredNews->fetch_assoc()):
                    $pubDate = new DateTime($f_news['publish_date']);
                    $mainImage = Database::search(
                        "SELECT image_path FROM news_images 
                        WHERE news_id = ? 
                        LIMIT 1",
                        [$f_news['news_id']]
                    )->fetch_assoc();
                ?>
                    <article class="card shadow-sm mb-4">
                        <?php if(!empty($f_news['main_image'])): ?>
                        <div class="ratio ratio-16x9">
                            <img src="<?= $f_news['main_image'] ?>" 
                                class="img-cover"
                                alt="<?= htmlspecialchars($f_news['title']) ?>">
                        </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <a href="single-news.php?id=<?= $f_news['news_id'] ?>" class="text-decoration-none">
                                <h5 class="card-title font-weight-bold text-dark mb-2"><?= htmlspecialchars($f_news['title']) ?></h5>
                            </a>
                            <div class="meta-info mb-2">
                                <small class="text-muted">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <?= $pubDate->format('M j, Y') ?>
                                </small>
                            </div>
                            <p class="card-text">
                                <?= substr(strip_tags(formatNewsContent($f_news['content'])), 0, 100) ?>...
                            </p>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>

<style>
    .img-cover {
        object-fit: cover;
        /* width: 100%;
        height: 100%; */
    }
    
    .section-header .header-line {
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background: inherit;
        opacity: 0.3;
        z-index: -1;
    }
    
    .date-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 2;
        text-align: center;
        line-height: 1.2;
    }
    
    .date-badge .day {
        font-size: 1.5rem;
        font-weight: bold;
    }
    
    .date-badge .month {
        font-size: 0.9rem;
        text-transform: uppercase;
    }
    
    .news-card:hover {
        transform: translateY(-5px);
        transition: transform 0.3s ease;
    }
    
    .read-more {
        color: #17a2b8;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .read-more:hover {
        color: #138496;
        text-decoration: none;
    }
    
    .featured-header .divider-small {
        height: 2px;
        width: 50px;
        margin: 10px 0;
    }
    
    .news-description {
        line-height: 1.8;
        color: #495057;
    }
    
    @media (max-width: 768px) {
        .page-header {
            padding: 2rem 1rem;
        }
        
        .news-card {
            margin-left: 0;
            margin-right: 0;
        }
        
        .date-badge {
            top: 10px;
            left: 10px;
            padding: 8px;
        }
    }
</style>

<?php include "includes/footer.php" ?>