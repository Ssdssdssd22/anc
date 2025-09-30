<?php
require "../includes/header.php";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['create_event'])) {
    // Get form data
    $topic = $_POST['topic'];
    $caption = $_POST['caption'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $image_type = $_POST['image_type'];

    // Handle main image upload
    $main_image_path = '';
    if (!empty($_FILES['main_image']['name'])) {
      $main_image_name = uniqid() . '_' . basename($_FILES['main_image']['name']);
      $target_path = "../images/events/" . $main_image_name;
      if (move_uploaded_file($_FILES['main_image']['tmp_name'], $target_path)) {
        $main_image_path = 'images/events/' . $main_image_name;
      }
    }

    // Insert event into database
    Database::iud(
      "INSERT INTO events (topic, caption, Description, image, image_type, date) 
                     VALUES (?, ?, ?, ?, ?, ?)",
      [$topic, $caption, $description, $main_image_path, $image_type, $date]
    );

    // Get new event ID
    $event_id = Database::$connection->insert_id;

    // Handle additional images upload
    if (!empty($_FILES['images']['name'][0])) {
      foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        $image_name = uniqid() . '_' . basename($_FILES['images']['name'][$key]);
        $target_path = "../images/events/" . $image_name;
        if (move_uploaded_file($tmp_name, $target_path)) {
          Database::iud(
            "INSERT INTO event_images (event_id, image_path) VALUES (?, ?)",
            [$event_id, 'images/events/' . $image_name]
          );
        }
      }
    }

    header("Location: events.php");
    exit();
  }
}

// Fetch image types for dropdown
$types = Database::search("SELECT * FROM image_type");
?>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Create New Event</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="container">
            <form method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-8">
                  <div class="mb-3">
                    <label class="form-label">Event Title <span class="text-danger">*</span></label>
                    <input type="text" name="topic" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Caption <span class="text-danger">*</span></label>
                    <input type="text" name="caption" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea name="description" class="form-control" rows="6" required></textarea>
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
                        <input type="date" name="date" class="form-control">
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Image Type <span class="text-danger">*</span></label>
                        <select name="image_type" class="form-select" required>
                          <?php while ($type = $types->fetch_assoc()): ?>
                            <option value="<?= $type['type_id'] ?>">
                              <?= strtoupper($type['type']) ?>
                            </option>
                          <?php endwhile; ?>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Main Image <span class="text-danger">*</span></label>
                        <input type="file" name="main_image" class="form-control" accept="image/*" required>
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
                  <div class="mb-3">
                    <label class="form-label">Upload Additional Images</label>
                    <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                  </div>
                </div>
              </div>

              <div class="text-center mt-4">
                <button type="submit" name="create_event" class="btn btn-success">
                  <i class="material-icons">save</i> Create Event
                </button>
                <a href="events.php" class="btn btn-secondary">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>