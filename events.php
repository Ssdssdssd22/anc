<?php include "includes/header.php" ?>
<div class="container-fluid">
    <!-- Main Header Section -->
    <div class="row justify-content-center mb-5 mt-lg-5">
        <div class="col-12 col-lg-10">
            <div class="page-header py-4 bg-gradient-info text-white rounded-lg shadow-lg">
                <h1 class="display-4 font-weight-bold text-center mb-0">Event Blog</h1>
                <div class="divider mx-auto bg-white"></div>
                <p class="lead text-center mt-3">Explore our upcoming and past events</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <?php
            function formatEventDescription($text) {
                $text = nl2br(htmlspecialchars_decode($text));
                $text = preg_replace('/\*(.*?)\*\s*:\s*(https?:\/\/[^\s]+)/', '<a href="$2" target="_blank" class="text-info font-weight-bold">$1</a>', $text);
                return $text;
            }

            $currentDate = new DateTime();
            
            // Upcoming Events Section
            $upcomingEvents = Database::search(
                "SELECT * FROM events WHERE date >= ? ORDER BY date ASC",
                [$currentDate->format('Y-m-d')]
            );
            ?>
            
            <!-- Upcoming Events Section -->
            <section class="mb-5">
                <div class="section-header mb-4">
                    <h2 class="text-uppercase font-weight-bold position-relative">
                        <span class="bg-info text-white px-3 py-2 rounded">Upcoming Events</span>
                        <span class="header-line bg-info"></span>
                    </h2>
                </div>

                <?php if($upcomingEvents->num_rows > 0): ?>
                    <?php while ($event = $upcomingEvents->fetch_assoc()): 
                        $eventDate = new DateTime($event['date']);
                        $images = Database::search(
                            "SELECT * FROM event_images WHERE event_id = ?",
                            [$event['event_id']]
                        );
                    ?>
                        <article class="event-card card shadow-lg mb-4 overflow-hidden">
                            <?php if($images->num_rows > 0): ?>
                            <div class="carousel-container position-relative">
                                <div id="carousel-<?= $event['event_id'] ?>" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner ratio ratio-16x9">
                                        <?php $first = true; while ($image = $images->fetch_assoc()): ?>
                                            <div class="carousel-item <?= $first ? 'active' : '' ?>">
                                                <img src="<?= $image['image_path'] ?>" 
                                                    class="d-block card-img-top" 
                                                    alt="Event image">
                                            </div>
                                        <?php $first = false; endwhile; ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-target="#carousel-<?= $event['event_id'] ?>" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-target="#carousel-<?= $event['event_id'] ?>" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </button>
                                </div>
                                <div class="date-badge bg-info text-white px-3 py-2 rounded shadow">
                                    <div class="day"><?= $eventDate->format('d') ?></div>
                                    <div class="month"><?= $eventDate->format('M') ?></div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="card-body p-4">
                                <a href="single-event.php?id=<?= $event['event_id'] ?>" class="text-decoration-none">
                                    <h3 class="card-title font-weight-bold text-dark mb-3"><?= htmlspecialchars($event['topic']) ?></h3>
                                </a>
                                <div class="meta-info mb-3">
                                    <span class="text-muted">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        <?= $eventDate->format('F j, Y') ?>
                                    </span>
                                </div>
                                <div class="card-text event-description">
                                    <?= formatEventDescription(substr($event['Description'], 0, 700)) ?>
                                    <?php if(strlen($event['Description']) > 700): ?>
                                        <a href="single-event.php?id=<?= $event['event_id'] ?>" class="read-more">
                                            Continue Reading <i class="fas fa-arrow-right"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="alert alert-info">No upcoming events scheduled. Check back later!</div>
                <?php endif; ?>
            </section>

            <!-- Past Events Section -->
            <section class="mb-5">
                <div class="section-header mb-4">
                    <h2 class="text-uppercase font-weight-bold position-relative">
                        <span class="bg-secondary text-white px-3 py-2 rounded">Past Events</span>
                        <span class="header-line bg-secondary"></span>
                    </h2>
                </div>

                <?php
                $pastEvents = Database::search(
                    "SELECT * FROM events WHERE date < ? ORDER BY date DESC",
                    [$currentDate->format('Y-m-d')]
                );
                if($pastEvents->num_rows > 0): ?>
                    <?php while ($event = $pastEvents->fetch_assoc()): 
                        $eventDate = new DateTime($event['date']);
                        $images = Database::search(
                            "SELECT * FROM event_images WHERE event_id = ?",
                            [$event['event_id']]
                        );
                    ?>
                        <article class="event-card card shadow-lg mb-4 overflow-hidden">
                            <?php if($images->num_rows > 0): ?>
                            <div class="carousel-container position-relative">
                                <div id="carousel-<?= $event['event_id'] ?>" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner ratio ratio-16x9">
                                        <?php $first = true; while ($image = $images->fetch_assoc()): ?>
                                            <div class="carousel-item <?= $first ? 'active' : '' ?>">
                                                <img src="<?= $image['image_path'] ?>" 
                                                    class="d-block card-img-top" 
                                                    alt="Event image">
                                            </div>
                                        <?php $first = false; endwhile; ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-target="#carousel-<?= $event['event_id'] ?>" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-target="#carousel-<?= $event['event_id'] ?>" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </button>
                                </div>
                                <div class="date-badge bg-info text-white px-3 py-2 rounded shadow">
                                    <div class="day"><?= $eventDate->format('d') ?></div>
                                    <div class="month"><?= $eventDate->format('M') ?></div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="card-body p-4">
                                <a href="single-event.php?id=<?= $event['event_id'] ?>" class="text-decoration-none">
                                    <h3 class="card-title font-weight-bold text-dark mb-3"><?= htmlspecialchars($event['topic']) ?></h3>
                                </a>
                                <div class="meta-info mb-3">
                                    <span class="text-muted">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        <?= $eventDate->format('F j, Y') ?>
                                    </span>
                                </div>
                                <div class="card-text event-description">
                                    <?= formatEventDescription(substr($event['Description'], 0, 700)) ?>
                                    <?php if(strlen($event['Description']) > 700): ?>
                                        <a href="single-event.php?id=<?= $event['event_id'] ?>" class="read-more">
                                            Continue Reading <i class="fas fa-arrow-right"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="alert alert-info">No past events to display.</div>
                <?php endif; ?>
            </section>
        </div>

        <!-- Featured Events Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-sidebar">
                <div class="featured-header bg-info text-white p-4 rounded-lg shadow mb-4" style="border-radius: 12px;">
                    <h2 class="h4 font-weight-bold text-uppercase mb-0">Featured Events</h2>
                    <div class="divider-small bg-white"></div>
                </div>

                <?php
                $featuredEvents = Database::search(
                    "SELECT * FROM events ORDER BY date DESC LIMIT 3"
                );
                while ($s_event = $featuredEvents->fetch_assoc()):
                    $eventDate = new DateTime($s_event['date']);
                    $first_image = Database::search(
                        "SELECT image_path FROM event_images WHERE event_id = ? LIMIT 1",
                        [$s_event['event_id']]
                    )->fetch_assoc();
                ?>
                    <article class="card shadow-sm mb-4">
                        <?php if($first_image): ?>
                        <img src="<?= $first_image['image_path'] ?>" 
                            class="card-img-top" 
                            alt="Event image">
                        <?php endif; ?>
                        <div class="card-body">
                            <a href="single-event.php?id=<?= $s_event['event_id'] ?>" class="text-decoration-none">
                                <h5 class="card-title font-weight-bold text-dark mb-2"><?= htmlspecialchars($s_event['topic']) ?></h5>
                            </a>
                            <div class="meta-info mb-2">
                                <small class="text-muted">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <?= $eventDate->format('M j, Y') ?>
                                </small>
                            </div>
                            <p class="card-text">
                                <?= substr(strip_tags(formatEventDescription($s_event['Description'])), 0, 100) ?>...
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
        width: 100%;
        height: 100%;
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
    
    .event-card:hover {
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
    
    @media (max-width: 768px) {
        .page-header {
            padding: 2rem 1rem;
        }
        
        .event-card {
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