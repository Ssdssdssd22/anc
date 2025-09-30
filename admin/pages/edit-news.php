<?php
require "../includes/header.php";

if (!isset($_GET['id'])) {
    header("Location: news.php");
    exit();
}

$news_id = $_GET['id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_news'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $publish_date = $_POST['publish_date'];
        $is_published = $_POST['is_published'];

        // Handle main image update
        $main_image_path = $_POST['existing_main_image'];
        if (!empty($_FILES['main_image']['name'])) {
            // Delete old image
            if ($main_image_path && file_exists("../" . $main_image_path)) {
                unlink("../" . $main_image_path);
            }

            // Upload new image
            $image_name = uniqid() . '_' . basename($_FILES['main_image']['name']);
            $target_path = "../../images/news/" . $image_name;
            move_uploaded_file($_FILES['main_image']['tmp_name'], $target_path);
            $main_image_path = 'images/news/' . $image_name;
        }

        // Update news in database
        Database::iud(
            "UPDATE news SET 
                      title = ?, 
                      content = ?, 
                      main_image = ?, 
                      publish_date = ?, 
                      is_published = ?
                      WHERE news_id = ?",
            [$title, $content, $main_image_path, $publish_date, $is_published, $news_id]
        );

        // Handle additional images upload
        if (!empty($_FILES['images']['name'][0])) {
            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                $image_name = uniqid() . '_' . basename($_FILES['images']['name'][$key]);
                $target_path = "../../images/news/" . $image_name;
                move_uploaded_file($tmp_name, $target_path);
                Database::iud(
                    "INSERT INTO news_images (news_id, image_path) VALUES (?, ?)",
                    [$news_id, 'images/news/' . $image_name]
                );
            }
        }

        // Handle image deletions
        if (!empty($_POST['delete_images'])) {
            foreach ($_POST['delete_images'] as $image_id) {
                $image = Database::search("SELECT image_path FROM news_images WHERE image_id = ?", [$image_id])->fetch_assoc();
                if (file_exists("../../" . $image['image_path'])) {
                    unlink("../../" . $image['image_path']);
                }
                Database::iud("DELETE FROM news_images WHERE image_id = ?", [$image_id]);
            }
        }

        echo "<script>window.location.href = 'edit-news.php?id=" . $_GET['id'] . "';</script>";
            exit();
    }
}

// Fetch news data
$news_item = Database::search("SELECT * FROM news WHERE news_id = ?", [$news_id])->fetch_assoc();
$images = Database::search("SELECT * FROM news_images WHERE news_id = ?", [$news_id]);
$types = Database::search("SELECT * FROM image_type");
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Edit News Article</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="container">
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="existing_main_image" value="<?= $news_item['main_image'] ?>">

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control"
                                            value="<?= htmlspecialchars($news_item['title']) ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Content <span class="text-danger">*</span></label>
                                        <textarea name="content" class="form-control" rows="8" required><?=
                                                                                                        htmlspecialchars($news_item['content']) ?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card shadow-lg">
                                        <div class="card-header bg-gradient-success text-white">
                                            <h6 class="mb-0">News Details</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label class="form-label">Publish Date <span class="text-danger">*</span></label>
                                                <input type="date" name="publish_date" class="form-control"
                                                    value="<?= $news_item['publish_date'] ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select name="is_published" class="form-select">
                                                    <option value="1" <?= $news_item['is_published'] ? 'selected' : '' ?>>Published</option>
                                                    <option value="0" <?= !$news_item['is_published'] ? 'selected' : '' ?>>Draft</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Main Image</label>
                                                <?php if ($news_item['main_image']): ?>
                                                    <img src="../../<?= $news_item['main_image'] ?>" class="img-thumbnail mb-2"
                                                        style="max-height: 200px; object-fit: cover;">
                                                <?php endif; ?>
                                                <input type="file" name="main_image" class="form-control" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-4 shadow-lg">
                                <div class="card-header bg-gradient-success text-white">
                                    <h6 class="mb-0">Additional Images</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <?php while ($image = $images->fetch_assoc()): ?>
                                            <div class="col-md-3 mb-3">
                                                <div class="image-item position-relative">
                                                    <img src="../../<?= $image['image_path'] ?>" class="img-thumbnail"
                                                        style="height: 150px; object-fit: cover;">
                                                    <div class="form-check position-absolute top-0 start-0 m-1">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="delete_images[]" value="<?= $image['image_id'] ?>">
                                                        <label class="form-check-label text-danger bg-white px-1 rounded">Delete</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Add More Images</label>
                                        <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" name="update_news" class="btn btn-success">
                                    <i class="material-icons">save</i> Update News
                                </button>
                                <a href="news.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>