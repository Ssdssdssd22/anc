<?php
require "../includes/header.php";

if (!isset($_GET['id'])) {
    header("Location: staff.php");
    exit();
} else {
    $user_id = $_GET['id'];


    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['update_staff'])) {
            $name = $_POST['name'];
            $position = $_POST['position'];

            // Handle image update
            $image_path = $_POST['existing_image'];
            if (!empty($_FILES['image']['name'])) {
                // Delete old image
                if ($image_path && file_exists("../" . $image_path)) {
                    unlink("../../" . $image_path);
                }

                // Upload new image
                $image_name = uniqid() . '_' . basename($_FILES['image']['name']);
                $target_path = "../../images/staff/" . $image_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $target_path);
                $image_path = 'images/staff/' . $image_name;
            }

            Database::iud(
                "UPDATE staff SET 
                      name = ?, 
                      position = ?, 
                      image = ?
                      WHERE user_id = ?",
                [$name, $position, $image_path, $user_id]
            );

            echo "<script>window.location.href = 'edit-staff.php?id=" . $_GET['id'] . "';</script>";
            exit();
        }
        // exit();
    }
}





// Fetch staff data
$staff = Database::search("SELECT * FROM staff WHERE user_id = ?", [$user_id])->fetch_assoc();
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Edit Staff Member</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="container">
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="existing_image" value="<?= $staff['image'] ?>">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control"
                                            value="<?= htmlspecialchars($staff['name']) ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Position</label>
                                        <input type="text" name="position" class="form-control"
                                            value="<?= htmlspecialchars($staff['position']) ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card shadow-lg">
                                        <div class="card-header bg-gradient-success text-white">
                                            <h6 class="mb-0">Profile Image</h6>
                                        </div>
                                        <div class="card-body">
                                            <?php if ($staff['image']): ?>
                                                <img src="../../<?= $staff['image'] ?>" class="img-thumbnail mb-3"
                                                    style="max-width: 200px; display: block;">
                                            <?php endif; ?>
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" name="update_staff" class="btn btn-success">
                                    <i class="material-icons">save</i> Update Staff
                                </button>
                                <a href="staff.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>