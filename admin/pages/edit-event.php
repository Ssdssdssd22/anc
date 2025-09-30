<?php
// Start the session and include necessary files at the very top
// session_start();
include "../includes/header.php";
// require_once('../includes/connection.php');

// Perform all redirect logic before any HTML output
if (!isset($_GET['id'])) {
  header("Location: evnts.php");
  exit();
}

$event_id = $_GET['id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['update_event'])) {
    $topic = $_POST['topic'];
    $caption = $_POST['caption'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $image_type = $_POST['image_type'];

    // Update main image if provided
    $main_image_path = $_POST['existing_main_image'];
    if (!empty($_FILES['main_image']['name'])) {
      $image_name = uniqid() . '_' . basename($_FILES['main_image']['name']);
      $target_path = "../../images/events/" . $image_name;
      move_uploaded_file($_FILES['main_image']['tmp_name'], $target_path);
      $main_image_path = 'images/events/' . $image_name;
    }

    Database::iud(
      "UPDATE events SET 
                      topic = ?, 
                      caption = ?, 
                      Description = ?, 
                      image = ?, 
                      image_type = ?, 
                      date = ?
                      WHERE event_id = ?",
      [$topic, $caption, $description, $main_image_path, $image_type, $date, $event_id]
    );

    // Handle new additional images
    if (!empty($_FILES['images']['name'][0])) {
      foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        $image_name = uniqid() . '_' . basename($_FILES['images']['name'][$key]);
        $target_path = "../../images/events/" . $image_name;
        move_uploaded_file($tmp_name, $target_path);
        Database::iud(
          "INSERT INTO event_images (event_id, image_path) VALUES (?, ?)",
          [$event_id, 'images/events/' . $image_name]
        );
      }
    }

    // Handle image deletions
    if (!empty($_POST['delete_images'])) {
      foreach ($_POST['delete_images'] as $image_id) {
        $image = Database::search("SELECT image_path FROM event_images WHERE image_id = ?", [$image_id])->fetch_assoc();
        if (file_exists("../../" . $image['image_path'])) {
          unlink("../../" . $image['image_path']);
        }
        Database::iud("DELETE FROM event_images WHERE image_id = ?", [$image_id]);
      }
    }

    // Fix: Store success message in session instead of immediate redirect
    $_SESSION['success_message'] = "Event updated successfully";
    echo "<script>window.location.href = 'edit-event.php?id=" . $_GET['id'] . "';</script>";
            exit();
  }
}

// Include header AFTER all potential redirects

// Fetch event data
$event = Database::search("SELECT * FROM events WHERE event_id = ?", [$event_id])->fetch_assoc();
$images = Database::search("SELECT * FROM event_images WHERE event_id = ?", [$event_id]);
$types = Database::search("SELECT * FROM image_type");
?>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Edit Event</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="container">
            <form method="POST" enctype="multipart/form-data">
              <input type="hidden" name="existing_main_image" value="<?= $event['image'] ?>">

              <div class="row">
                <div class="col-md-8">
                  <div class="mb-3">
                    <label class="form-label">Event Title</label>
                    <input type="text" name="topic" class="form-control"
                      value="<?= htmlspecialchars($event['topic']) ?>" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Caption</label>
                    <input type="text" name="caption" class="form-control"
                      value="<?= htmlspecialchars($event['caption']) ?>" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="6" required><?=
                                                                                        htmlspecialchars($event['Description']) ?></textarea>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="card shadow-lg">
                    <div class="card-header bg-gradient-success text-white">
                      <h6 class="mb-0">Event Details</h6>
                    </div>
                    <div class="card-body">
                      <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-control"
                          value="<?= $event['date'] ?>">
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Image Type</label>
                        <select name="image_type" class="form-select" required>
                          <?php while ($type = $types->fetch_assoc()): ?>
                            <option value="<?= $type['type_id'] ?>"
                              <?= $type['type_id'] == $event['image_type'] ? 'selected' : '' ?>>
                              <?= strtoupper($type['type']) ?>
                            </option>
                          <?php endwhile; ?>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Main Image</label>
                        <?php if ($event['image']): ?>
                          <img src="../../<?= $event['image'] ?>" class="img-thumbnail mb-2"
                            style="height: 150px; object-fit: cover;">
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
                <button type="submit" name="update_event" class="btn btn-success">
                  <i class="material-icons">save</i> Update Event
                </button>
                <a href="evnts.php" class="btn btn-secondary">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>