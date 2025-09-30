<?php
require "../includes/header.php";

// Initialize variables
$club = ['club_id' => 0, 'hero_image' => '', 'about_image' => ''];
$steps = [];
$gallery = [];
$successMessage = null;
$formError = null;

// Get club data if editing
if (isset($_GET['id'])) {
    $club_id = $_GET['id'];
    $club = Database::search("SELECT * FROM clubs WHERE club_id = ?", [$club_id])->fetch_assoc();
    $steps = Database::search("SELECT * FROM club_admission_steps WHERE club_id = ? ORDER BY step_order", [$club_id]);
    $gallery = Database::search("SELECT * FROM club_gallery WHERE club_id = ?", [$club_id]);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $club_id = $_POST['club_id'] ?? 0;
        $name = $_POST['name'];
        $hero_title = $_POST['hero_title'];
        $hero_subtitle = $_POST['hero_subtitle'];
        $about_text = $_POST['about_text'];
        $admission_description = $_POST['admission_description'];

        // File upload handling
        $uploadDir = "../../images/clubs/";
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Process hero image
        $hero_image = $club['hero_image'] ?? '';
        if (!empty($_FILES['hero_image']['name'])) {
            $heroName = uniqid() . '_' . basename($_FILES['hero_image']['name']);
            $heroPath = $uploadDir . $heroName;
            move_uploaded_file($_FILES['hero_image']['tmp_name'], $heroPath);
            $hero_image = 'images/clubs/' . $heroName;
        }

        // Process about image
        $about_image = $club['about_image'] ?? '';
        if (!empty($_FILES['about_image']['name'])) {
            $aboutName = uniqid() . '_' . basename($_FILES['about_image']['name']);
            $aboutPath = $uploadDir . $aboutName;
            move_uploaded_file($_FILES['about_image']['tmp_name'], $aboutPath);
            $about_image = 'images/clubs/' . $aboutName;
        }

        // Save club data
        if ($club_id > 0) {
            Database::iud(
                "UPDATE clubs SET 
                name = ?, hero_title = ?, hero_subtitle = ?, hero_image = ?,
                about_text = ?, about_image = ?, admission_description = ?
                WHERE club_id = ?",
                [$name, $hero_title, $hero_subtitle, $hero_image, 
                 $about_text, $about_image, $admission_description, $club_id]
            );
        } else {
            Database::iud(
                "INSERT INTO clubs 
                (name, hero_title, hero_subtitle, hero_image, about_text, about_image, admission_description) 
                VALUES (?, ?, ?, ?, ?, ?, ?)",
                [$name, $hero_title, $hero_subtitle, $hero_image, 
                 $about_text, $about_image, $admission_description]
            );
            $club_id = Database::$connection->insert_id;
        }

        // Handle admission steps
        Database::iud("DELETE FROM club_admission_steps WHERE club_id = ?", [$club_id]);
        if (!empty($_POST['step_titles'])) {
            foreach ($_POST['step_titles'] as $index => $title) {
                $description = $_POST['step_descriptions'][$index] ?? '';
                $order = $index + 1;
                Database::iud(
                    "INSERT INTO club_admission_steps 
                    (club_id, step_title, step_description, step_order) 
                    VALUES (?, ?, ?, ?)",
                    [$club_id, $title, $description, $order]
                );
            }
        }

        // Handle gallery updates
        if (!empty($_POST['delete_images'])) {
            foreach ($_POST['delete_images'] as $image_id) {
                $image = Database::search("SELECT image_path FROM club_gallery WHERE image_id = ?", [$image_id])->fetch_assoc();
                if ($image && file_exists("../../" . $image['image_path'])) {
                    unlink("../../" . $image['image_path']);
                }
                Database::iud("DELETE FROM club_gallery WHERE image_id = ?", [$image_id]);
            }
        }

        // Update existing image categories
        if (!empty($_POST['update_categories'])) {
            foreach ($_POST['update_categories'] as $image_id => $category) {
                Database::iud(
                    "UPDATE club_gallery SET category = ? WHERE image_id = ?",
                    [$category, $image_id]
                );
            }
        }

        // Add new gallery images
        if (!empty($_FILES['gallery_images']['name'][0])) {
            $category = $_POST['new_image_category'] ?? 'General';
            foreach ($_FILES['gallery_images']['tmp_name'] as $key => $tmp_name) {
                $imageName = uniqid() . '_' . basename($_FILES['gallery_images']['name'][$key]);
                $targetPath = $uploadDir . $imageName;
                if (move_uploaded_file($tmp_name, $targetPath)) {
                    Database::iud(
                        "INSERT INTO club_gallery (club_id, image_path, category) 
                        VALUES (?, ?, ?)",
                        [$club_id, 'images/clubs/' . $imageName, $category]
                    );
                }
            }
        }

        $successMessage = "Club updated successfully!";
        echo "<script>window.location.href = 'edit-club.php?id=" . $club_id . "';</script>";
            exit();
    } catch (Exception $e) {
        $formError = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Club</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .image-preview {
            max-height: 200px;
            object-fit: contain;
            margin-bottom: 1rem;
        }
        .gallery-thumbnail {
            height: 200px;
            object-fit: cover;
            width: 100%;
            border-radius: 8px;
        }
        .preview-card {
            position: relative;
            margin-bottom: 1rem;
            transition: transform 0.2s;
        }
        .delete-checkbox {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 2;
            background: rgba(255,255,255,0.8);
            padding: 5px;
            border-radius: 50%;
        }
        .category-select {
            position: absolute;
            bottom: 10px;
            left: 10px;
            right: 10px;
            background: rgba(255,255,255,0.9);
            padding: 5px;
            border-radius: 4px;
        }
        .step-group {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        .preview-card:hover {
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
<div class="container-fluid py-4">
    <?php if ($successMessage): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= htmlspecialchars($successMessage) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <?php if ($formError): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <?= htmlspecialchars($formError) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="club_id" value="<?= htmlspecialchars($club['club_id']) ?>">

        <!-- Hero Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Hero Section</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Club Name</label>
                            <input type="text" name="name" class="form-control" 
                                   value="<?= htmlspecialchars($club['name'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hero Title</label>
                            <input type="text" name="hero_title" class="form-control" 
                                   value="<?= htmlspecialchars($club['hero_title'] ?? '') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hero Subtitle</label>
                            <input type="text" name="hero_subtitle" class="form-control" 
                                   value="<?= htmlspecialchars($club['hero_subtitle'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Hero Image</label>
                            <?php if (!empty($club['hero_image'])): ?>
                            <img src="../../<?= htmlspecialchars($club['hero_image']) ?>" 
                                 class="image-preview d-block w-100 mb-2">
                            <?php endif; ?>
                            <input type="file" name="hero_image" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- About Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">About Section</div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">About Text</label>
                            <textarea name="about_text" class="form-control" rows="4"><?= 
                                htmlspecialchars($club['about_text'] ?? '') ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">About Image</label>
                            <?php if (!empty($club['about_image'])): ?>
                            <img src="../../<?= htmlspecialchars($club['about_image']) ?>" 
                                 class="image-preview d-block w-100 mb-2">
                            <?php endif; ?>
                            <input type="file" name="about_image" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admission Process -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span>Admission Process</span>
                <button type="button" class="btn btn-light btn-sm" onclick="addStep()">
                    <i class="material-icons">add</i> Add Step
                </button>
            </div>
            <div class="card-body">
                <div id="steps-container">
                    <?php while ($step = $steps->fetch_assoc()): ?>
                    <div class="step-group">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" name="step_titles[]" class="form-control" 
                                       value="<?= htmlspecialchars($step['step_title']) ?>" 
                                       placeholder="Step Title" required>
                            </div>
                            <div class="col-md-7">
                                <textarea name="step_descriptions[]" class="form-control" 
                                          rows="2" placeholder="Step Description" required><?= 
                                    htmlspecialchars($step['step_description']) ?></textarea>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger h-100 w-100" 
                                        onclick="removeStep(this)">
                                    <i class="material-icons">delete</i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

        <!-- Gallery Management -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Gallery Management</div>
            <div class="card-body">
                <div class="row">
                    <!-- Existing Images -->
                    <div class="col-12 mb-4">
                        <h5>Existing Images</h5>
                        <div class="row row-cols-2 row-cols-md-4 g-4">
                            <?php while ($image = $gallery->fetch_assoc()): ?>
                            <div class="col">
                                <div class="card preview-card">
                                    <div class="position-relative">
                                        <img src="../../<?= htmlspecialchars($image['image_path']) ?>" 
                                             class="gallery-thumbnail">
                                        <div class="delete-checkbox">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="delete_images[]" value="<?= $image['image_id'] ?>" 
                                                       id="delete-<?= $image['image_id'] ?>">
                                                <label class="form-check-label" for="delete-<?= $image['image_id'] ?>">
                                                    <i class="material-icons text-danger">delete</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="category-select">
                                            <select class="form-select form-select-sm" 
                                                    name="update_categories[<?= $image['image_id'] ?>]">
                                                <option value="General" <?= $image['category'] === 'General' ? 'selected' : '' ?>>General</option>
                                                <option value="Portrait" <?= $image['category'] === 'Portrait' ? 'selected' : '' ?>>Portrait</option>
                                                <option value="Landscape" <?= $image['category'] === 'Landscape' ? 'selected' : '' ?>>Landscape</option>
                                                <option value="Events" <?= $image['category'] === 'Events' ? 'selected' : '' ?>>Events</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>

                    <!-- New Images -->
                    <div class="col-12">
                        <h5>Add New Images</h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Category for New Images</label>
                                <select name="new_image_category" class="form-select">
                                    <option value="General">General</option>
                                    <option value="Portrait">Portrait</option>
                                    <option value="Landscape">Landscape</option>
                                    <option value="Events">Events</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <input type="file" name="gallery_images[]" 
                                       class="form-control" multiple accept="image/*" 
                                       onchange="previewNewImages(event)">
                            </div>
                            <div class="col-12">
                                <div class="row row-cols-2 row-cols-md-4 g-4" id="new-images-preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">Save Changes</button>
        <a href="clubs.php" class="btn btn-secondary w-100 mt-3">Cancel</a>
    </form>
</div>

<script>
// Admission Steps Management
function addStep() {
    const container = document.getElementById('steps-container');
    const newStep = document.createElement('div');
    newStep.className = 'step-group mb-3';
    newStep.innerHTML = `
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="step_titles[]" 
                       class="form-control" placeholder="Step Title" required>
            </div>
            <div class="col-md-7">
                <textarea name="step_descriptions[]" 
                          class="form-control" placeholder="Step Description" 
                          rows="2" required></textarea>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger h-100 w-100" 
                        onclick="removeStep(this)">
                    <i class="material-icons">delete</i>
                </button>
            </div>
        </div>`;
    container.appendChild(newStep);
}

function removeStep(button) {
    button.closest('.step-group').remove();
}

// New Images Preview
function previewNewImages(event) {
    const preview = document.getElementById('new-images-preview');
    preview.innerHTML = '';
    const category = document.querySelector('[name="new_image_category"]').value;

    Array.from(event.target.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'col';
            div.innerHTML = `
                <div class="card preview-card">
                    <div class="position-relative">
                        <img src="${e.target.result}" 
                             class="gallery-thumbnail">
                        <div class="category-select">
                            <span class="badge bg-primary">${category}</span>
                        </div>
                    </div>
                </div>`;
            preview.appendChild(div);
        }
        reader.readAsDataURL(file);
    });
}
</script>
