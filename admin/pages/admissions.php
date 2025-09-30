<?php
require "../includes/header.php";

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_admission'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $download_link = $_POST['download_link'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $is_active = isset($_POST['is_active']) ? 1 : 0;

        Database::iud(
            "INSERT INTO admissions (title, description, download_link, start_date, end_date, is_active) 
            VALUES (?, ?, ?, ?, ?, ?)",
            [$title, $description, $download_link, $start_date, $end_date, $is_active]
        );
    }

    if (isset($_POST['delete_admission'])) {
        $admission_id = $_POST['admission_id'];
        Database::iud("DELETE FROM admissions WHERE admission_id = ?", [$admission_id]);
    }
}

// Fetch all admissions
$admissions = Database::search("SELECT * FROM admissions ORDER BY start_date DESC");
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header bg-gradient-success">
                    <h6 class="text-white">Admissions Management</h6>
                    <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addAdmissionModal">
                        Add New Admission
                    </button>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Dates</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($admission = $admissions->fetch_assoc()): ?>
                            <tr>
                                <td><?= $admission['title'] ?></td>
                                <td><?= $admission['start_date'] ?> to <?= $admission['end_date'] ?></td>
                                <td><?= $admission['is_active'] ? 'Active' : 'Inactive' ?></td>
                                <td>
                                    <a href="edit-admission.php?id=<?= $admission['admission_id'] ?>" class="btn btn-sm btn-success">Edit</a>
                                    <form method="POST" class="d-inline">
                                        <input type="hidden" name="admission_id" value="<?= $admission['admission_id'] ?>">
                                        <button type="submit" name="delete_admission" class="btn btn-sm btn-danger">Delete</button>
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

<!-- Add Admission Modal -->
<div class="modal fade" id="addAdmissionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header bg-gradient-success text-white">
                    <h5 class="modal-title">Add New Admission</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Download Link</label>
                        <input type="text" name="download_link" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Start Date</label>
                            <input type="date" name="start_date" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>End Date</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>
                    </div>
                    <div class="mt-3 form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="isActive">
                        <label class="form-check-label" for="isActive">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add_admission" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
