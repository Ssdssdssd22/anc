<?php require "includes/header.php";
// Get two main active admissions (most recent)
$mainAdmissions = Database::search(
    "SELECT * FROM admissions 
    WHERE is_active = 1 
    ORDER BY admission_id DESC 
    LIMIT 2"
)->fetch_all(MYSQLI_ASSOC);

// Get IDs of main admissions
$mainIds = !empty($mainAdmissions) ? array_column($mainAdmissions, 'admission_id') : [];

// Get search query
$search = $_GET['search'] ?? '';

// Get other active admissions (excluding main ones)
$query = "SELECT * FROM admissions WHERE is_active = 1";
$params = [];

if (!empty($mainIds)) {
    $query .= " AND admission_id NOT IN (" . implode(',', $mainIds) . ")";
}

if (!empty($search)) {
    $query .= " AND (title LIKE ? OR description LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$query .= " ORDER BY admission_id DESC";
$otherAdmissions = Database::search($query, $params)->fetch_all(MYSQLI_ASSOC);
?>

<!-- Main Admissions Section -->
<div class="row slider_section offset-lg-1">
    <?php foreach ($mainAdmissions as $admission): ?>
    <div class="card mt-5 col-lg-5">
        <?php if (!empty($admission['image_path'])): ?>
        <img class="card-img-top" src="<?= htmlspecialchars($admission['image_path']) ?>" alt="Admission banner">
        <?php endif; ?>
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($admission['title']) ?></h5>
            <p class="card-text"><?= nl2br(htmlspecialchars($admission['description'])) ?></p>
            <div class="mt-3">
                <?php if ($admission['download_link']): ?>
                <a href="<?= htmlspecialchars($admission['download_link']) ?>" 
                   class="btn btn-primary" download>
                    Download Form
                </a>
                <?php endif; ?>
                <small class="text-muted d-block mt-2">
                    Open until <?= date('M d, Y', strtotime($admission['end_date'])) ?>
                </small>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Search Bar -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="GET" class="input-group">
                <input type="text" name="search" class="form-control" 
                       placeholder="Search admissions..." 
                       value="<?= htmlspecialchars($search) ?>">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i> Search
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Other Admissions List -->
<div class="container mt-4">
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php if (!empty($otherAdmissions)): ?>
            <?php foreach ($otherAdmissions as $admission): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($admission['title']) ?></h5>
                        <p class="card-text text-muted">
                            <?= nl2br(htmlspecialchars(mb_strimwidth($admission['description'], 0, 150, '...'))) ?>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <?php if ($admission['download_link']): ?>
                            <a href="<?= htmlspecialchars($admission['download_link']) ?>" 
                               class="btn btn-outline-primary btn-sm" download>
                                Download
                            </a>
                            <?php endif; ?>
                            <small class="text-muted">
                                <?= date('M Y', strtotime($admission['start_date'])) ?>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No other admissions found<?= !empty($search) ? ' matching your search' : '' ?>.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require "includes/footer.php"; ?>