<?php
include "../includes/header.php";

// Redirect if no ID parameter
if (!isset($_GET['id'])) {
    header("Location: admissions.php");
    exit();
}

$admission_id = $_GET['id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_admission'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $download_link = $_POST['download_link'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $is_active = isset($_POST['is_active']) ? 1 : 0;

        try {
            Database::iud(
                "UPDATE admissions SET 
                title = ?, 
                description = ?, 
                download_link = ?, 
                start_date = ?, 
                end_date = ?, 
                is_active = ? 
                WHERE admission_id = ?",
                [$title, $description, $download_link, $start_date, $end_date, $is_active, $admission_id]
            );
            
            $_SESSION['success_message'] = "Admission updated successfully";
            echo "<script>window.location.href = 'edit-admission.php?id=".$admission_id."';</script>";
            exit();
        } catch (Exception $e) {
            $formError = "Error updating admission: ".$e->getMessage();
        }
    }

    if (isset($_POST['delete_admission'])) {
        Database::iud("DELETE FROM admissions WHERE admission_id = ?", [$admission_id]);
        $_SESSION['success_message'] = "Admission deleted successfully";
        echo "<script>window.location.href = 'admissions.php';</script>";
            exit();
    }
}

// Fetch admission data
$admission = Database::search(
    "SELECT * FROM admissions WHERE admission_id = ?", 
    [$admission_id]
)->fetch_assoc();
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header bg-gradient-success text-white">
                    <h6 class="mb-0">Edit Admission</h6>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['success_message'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $_SESSION['success_message'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['success_message']); ?>
                    <?php endif; ?>

                    <?php if (isset($formError)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $formError ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" 
                                        value="<?= htmlspecialchars($admission['title']) ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="5" required>
                                        <?= htmlspecialchars($admission['description']) ?>
                                    </textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Download Link</label>
                                    <input type="url" name="download_link" class="form-control" 
                                        value="<?= htmlspecialchars($admission['download_link']) ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card shadow-lg">
                                    <div class="card-header bg-gradient-success text-white">
                                        <h6 class="mb-0">Dates & Status</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Start Date</label>
                                            <input type="date" name="start_date" class="form-control" 
                                                value="<?= $admission['start_date'] ?>">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label">End Date</label>
                                            <input type="date" name="end_date" class="form-control" 
                                                value="<?= $admission['end_date'] ?>">
                                        </div>
                                        
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_active" 
                                                id="isActive" <?= $admission['is_active'] ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="isActive">Active</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <button type="submit" name="update_admission" class="btn btn-success">
                                <i class="material-icons">save</i> Update Admission
                            </button>
                            <button type="button" class="btn btn-danger" 
                                onclick="confirmDelete()">
                                <i class="material-icons">delete</i> Delete Admission
                            </button>
                            <a href="admissions.php" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                    
                    <!-- Hidden delete form -->
                    <form method="POST" id="deleteForm" style="display: none;">
                        <input type="hidden" name="admission_id" value="<?= $admission_id ?>">
                        <button type="submit" name="delete_admission"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete() {
    if (confirm('Are you sure you want to delete this admission? This action cannot be undone.')) {
        document.getElementById('deleteForm').submit();
    }
}
</script>
