<?php
require "../includes/header.php";

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['add_staff'])) {
    $name = $_POST['name'];
    $position = $_POST['position'];

    // Handle image upload
    $image_path = '';
    if (!empty($_FILES['image']['name'])) {
      $image_name = uniqid() . '_' . basename($_FILES['image']['name']);
      $target_path = "../../images/staff/" . $image_name;
      move_uploaded_file($_FILES['image']['tmp_name'], $target_path);
      $image_path = 'images/staff/' . $image_name;
    }

    Database::iud(
      "INSERT INTO staff (name, position, image) VALUES (?, ?, ?)",
      [$name, $position, $image_path]
    );
    echo "<script>window.location.href = 'staff.php';</script>";
            exit();
  }

  if (isset($_POST['delete_staff'])) {
    $user_id = $_POST['user_id'];
    // Delete staff and image
    $staff = Database::search("SELECT image FROM staff WHERE user_id = ?", [$user_id])->fetch_assoc();
    if ($staff['image'] && file_exists("../" . $staff['image'])) {
      unlink("../../" . $staff['image']);
    }
    Database::iud("DELETE FROM staff WHERE user_id = ?", [$user_id]);
  }
}

// Fetch all staff
$staff = Database::search("SELECT * FROM staff ORDER BY user_id DESC");
?>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Staff Management</h6>
            <button class="btn btn-light btn-sm float-end me-3" data-bs-toggle="modal" data-bs-target="#addStaffModal">
              <i class="material-icons">add</i> Add New Staff
            </button>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-3">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Staff Member</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Position</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($member = $staff->fetch_assoc()): ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <?php if ($member['image']): ?>
                          <div>
                            <img src="../../<?= htmlspecialchars($member['image']) ?>"
                              class="avatar avatar-sm me-3 border-radius-lg" alt="staff-image">
                          </div>
                        <?php endif; ?>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= htmlspecialchars($member['name']) ?></h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= htmlspecialchars($member['position']) ?></p>
                    </td>
                    <td class="align-middle text-center">
                      <a href="edit-staff.php?id=<?= $member['user_id'] ?>" class="btn btn-success btn-sm me-1">
                        <i class="material-icons">edit</i>
                      </a>
                      <form method="POST" class="d-inline">
                        <input type="hidden" name="user_id" value="<?= $member['user_id'] ?>">
                        <button type="submit" name="delete_staff" class="btn btn-danger btn-sm"
                          onclick="return confirm('Are you sure you want to delete this staff member?')">
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

<!-- Add Staff Modal -->
<div class="modal fade" id="addStaffModal" tabindex="-1" role="dialog" aria-labelledby="addStaffModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-success">
        <h5 class="modal-title text-white" id="addStaffModalLabel">Add New Staff Member</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Position</label>
            <input type="text" name="position" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Profile Image</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="add_staff" class="btn btn-success">Add Staff</button>
        </div>
      </form>
    </div>
  </div>
</div>