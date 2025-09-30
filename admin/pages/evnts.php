<?php
require "../includes/header.php";

// Initialize error/success messages
$formError = null;
$successMessage = null;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['add_event'])) {
    // Validate required fields
    if (empty($_POST['topic']) || empty($_POST['caption']) || empty($_POST['description'])) {
      $formError = "Please fill in all required fields";
    } else {
      try {
        // Add new event
        $topic = $_POST['topic'];
        $caption = $_POST['caption'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $image_type = $_POST['image_type'];

        // Handle main image upload
        $main_image_path = '';
        if (!empty($_FILES['main_image']['name'])) {
          $main_image_name = uniqid() . '_' . basename($_FILES['main_image']['name']);
          $target_path = "../../images/events/" . $main_image_name;
          move_uploaded_file($_FILES['main_image']['tmp_name'], $target_path);
          $main_image_path = 'images/events/' . $main_image_name;
        }

        Database::iud(
          "INSERT INTO events (topic, caption, Description, image, image_type, date) 
                              VALUES (?, ?, ?, ?, ?, ?)",
          [$topic, $caption, $description, $main_image_path, $image_type, $date]
        );

        // Get last inserted ID
        $event_id = Database::$connection->insert_id;

        // Handle additional images upload
        if (!empty($_FILES['images']['name'][0])) {
          foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $image_name = uniqid() . '_' . basename($_FILES['images']['name'][$key]);
            $target_path = "../../images/events/" . $image_name;

            if (move_uploaded_file($tmp_name, $target_path)) {
              Database::iud(
                "INSERT INTO event_images (event_id, image_path) VALUES (?, ?)",
                [$event_id, 'images/events/' . $image_name]
              );
            }
          }
        }

        $successMessage = "Event added successfully!";
      } catch (Exception $e) {
        $formError = "Error adding event: " . $e->getMessage();
      }
    }
    echo "<script>window.location.href = 'evnts.php';</script>";
            exit();
  }

  if (isset($_POST['delete_event'])) {
    $event_id = $_POST['event_id'];
    try {
      // Start transaction
      // Database::$connection->begin_transaction();

      // First, get all images to delete the files
      $images = Database::search("SELECT image_path FROM event_images WHERE event_id = ?", [$event_id]);
      while ($image = $images->fetch_assoc()) {
        $image_path = "../../" . $image['image_path'];
        if (file_exists($image_path)) {
          unlink($image_path); // Delete the physical file
        }
      }

      // Delete the main event image
      $event = Database::search("SELECT image FROM events WHERE event_id = ?", [$event_id])->fetch_assoc();
      if ($event['image']) {
        $main_image_path = "../../" . $event['image'];
        if (file_exists($main_image_path)) {
          unlink($main_image_path);
        }
      }

      // Delete all related images from event_images table first
      Database::iud("DELETE FROM event_images WHERE event_id = ?", [$event_id]);

      // Then delete the event
      Database::iud("DELETE FROM events WHERE event_id = ?", [$event_id]);

      // Commit transaction
      Database::$connection->commit();

      $successMessage = "Event deleted successfully!";
    } catch (Exception $e) {
      // Rollback transaction on error
      Database::$connection->rollback();
      $formError = "Error deleting event: " . $e->getMessage();
    }
  }
}

// Fetch all events with their image types
$events = Database::search("SELECT e.*, it.type 
                           FROM events e 
                           JOIN image_type it ON e.image_type = it.type_id 
                           ORDER BY e.event_id DESC");
?>

<!-- Add this after your header section -->
<?php if ($successMessage): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo $successMessage; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<?php if ($formError): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?php echo $formError; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Events Management</h6>
            <button type="button" class="btn btn-light btn-sm float-end me-3" data-bs-toggle="modal" data-bs-target="#addEventModal">
              <i class="material-icons">add</i> Add New Event
            </button>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-3">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Event Title</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Date</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Image Type</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($event = $events->fetch_assoc()): ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <?php if ($event['image']): ?>
                          <div>
                            <img src="../../<?= htmlspecialchars($event['image']) ?>"
                              class="avatar avatar-sm me-3 border-radius-lg" alt="event-image" style="max-height: 100px; width: auto;">
                          </div>
                        <?php endif; ?>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= htmlspecialchars($event['topic']) ?></h6>
                          <p class="text-xs text-secondary mb-0"><?= substr(htmlspecialchars($event['Description']), 0, 50) ?>...</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $event['date'] ?? 'N/A' ?></p>
                    </td>
                    <td>
                      <span class="badge badge-sm bg-gradient-success"><?= strtoupper($event['type']) ?></span>
                    </td>
                    <td class="align-middle text-center">
                      <a href="edit-event.php?id=<?= $event['event_id'] ?>" class="btn btn-success btn-sm me-1">
                        <i class="material-icons">edit</i>
                      </a>
                      <form method="POST" class="d-inline">
                        <input type="hidden" name="event_id" value="<?= $event['event_id'] ?>">
                        <button type="submit" name="delete_event" class="btn btn-danger btn-sm"
                          onclick="return confirm('Are you sure you want to delete this event?')">
                          <i class="material-icons">delete</i>
                        </button>
                      </form>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add Event Modal -->
<div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-success">
        <h5 class="modal-title text-white" id="addEventModalLabel">Add New Event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Event Title</label>
                <input type="text" name="topic" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Caption</label>
                <input type="text" name="caption" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Date</label>
                <input type="date" name="date" class="form-control">
              </div>
              <div class="mb-3">
                <label class="form-label">Image Type</label>
                <select name="image_type" class="form-select" required>
                  <?php
                  $types = Database::search("SELECT * FROM image_type");
                  while ($type = $types->fetch_assoc()): ?>
                    <option value="<?= $type['type_id'] ?>"><?= strtoupper($type['type']) ?></option>
                  <?php endwhile; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Main Image</label>
                <input type="file" name="main_image" class="form-control" accept="image/*">
              </div>
              <div class="mb-3">
                <label class="form-label">Additional Images</label>
                <input type="file" name="images[]" class="form-control" multiple accept="image/*">
              </div>
              <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4" required></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="add_event" class="btn btn-success">Save Event</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Add this before closing </body> tag -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize all modals
    var modals = document.querySelectorAll('.modal');
    modals.forEach(function(modal) {
      new bootstrap.Modal(modal);
    });

    // Optional: Show modal if there was a form error
    <?php if (isset($formError)): ?>
      var addEventModal = new bootstrap.Modal(document.getElementById('addEventModal'));
      addEventModal.show();
    <?php endif; ?>
  });
</script>