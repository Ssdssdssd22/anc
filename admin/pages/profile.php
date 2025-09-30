<?php
require "../includes/header.php";

// Check admin authentication
if (!isset($_SESSION["u"])) {
  header("Location: login.php");
  exit();
}

$admin = $_SESSION["u"];
$error = '';
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $name = $_POST['name'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Verify current password
    $check = Database::search(
      "SELECT * FROM admins WHERE admin_id = ? AND pass = ?",
      [$admin['admin_id'], $current_password]
    );

    if ($check->num_rows !== 1) {
      throw new Exception("Current password is incorrect");
    }

    // Prepare update data
    $update_fields = [];
    $params = [];
    $types = '';

    // Update name
    if (!empty($name) && $name !== $admin['name']) {
      $update_fields[] = "name = ?";
      $params[] = $name;
      $types .= 's';
    }

    // Update password if provided
    if (!empty($new_password)) {
      if ($new_password !== $confirm_password) {
        throw new Exception("New passwords do not match");
      }
      $update_fields[] = "pass = ?";
      $params[] = $new_password;
      $types .= 's';
    }

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
      $image = $_FILES['image'];

      // Validate image
      $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
      if (!in_array($image['type'], $allowed_types)) {
        throw new Exception("Only JPG, PNG, and GIF images are allowed");
      }

      // Delete old image
      if (!empty($admin['image']) && file_exists("../images/" . $admin['image'])) {
        unlink("../images/" . $admin['image']);
      }

      // Upload new image
      $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
      $filename = "admin_" . $admin['admin_id'] . "_" . time() . ".$ext";
      $target_path = "../images/" . $filename;

      if (!move_uploaded_file($image['tmp_name'], $target_path)) {
        throw new Exception("Failed to upload image");
      }

      $update_fields[] = "image = ?";
      $params[] = $filename;
      $types .= 's';
    }

    // Perform update if any fields changed
    if (!empty($update_fields)) {
      $params[] = $admin['admin_id'];
      $types .= 'i';

      $query = "UPDATE admins SET " . implode(', ', $update_fields) . " WHERE admin_id = ?";
      Database::iud($query, $params);

      // Refresh session data
      $updated_admin = Database::search(
        "SELECT * FROM admins WHERE admin_id = ?",
        [$admin['admin_id']]
      )->fetch_assoc();
      $_SESSION["u"] = $updated_admin;
      $admin = $_SESSION["u"];

      $success = "Profile updated successfully!";
    }
    echo "<script>window.location.href = 'profile.php';</script>";
            exit();
  } catch (Exception $e) {
    $error = $e->getMessage();
  }
}
?>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Admin Profile Management</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="container">
            <?php if ($error): ?>
              <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <?php if ($success): ?>
              <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Admin Code</label>
                    <input type="text" class="form-control"
                      value="<?= htmlspecialchars($admin['code']) ?>" disabled>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control"
                      value="<?= htmlspecialchars($admin['name']) ?>" required>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Current Password</label>
                    <input type="password" name="current_password"
                      class="form-control" required>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" name="new_password"
                      class="form-control">
                    <small class="text-muted">Leave blank to keep current password</small>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" name="confirm_password"
                      class="form-control">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="card shadow-lg">
                    <div class="card-header bg-gradient-info text-white">
                      <h6 class="mb-0">Profile Image</h6>
                    </div>
                    <div class="card-body text-center">
                      <?php if (!empty($admin['image'])): ?>
                        <img src="../images/<?= htmlspecialchars($admin['image']) ?>"
                          class="img-thumbnail mb-3"
                          style="width: 200px; height: 200px; object-fit: cover;">
                      <?php endif; ?>
                      <input type="file" name="image" class="form-control"
                        accept="image/*">
                    </div>
                  </div>
                </div>
              </div>

              <div class="text-center mt-4">
                <button type="submit" class="btn btn-info">Update Profile</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>