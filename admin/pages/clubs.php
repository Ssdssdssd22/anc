<?php
require "../includes/header.php";

// Handle club deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_club'])) {
    $club_id = $_POST['club_id'];
    Database::iud("DELETE FROM clubs WHERE club_id = ?", [$club_id]);
    Database::iud("DELETE FROM club_admission_steps WHERE club_id = ?", [$club_id]);
    Database::iud("DELETE FROM club_gallery WHERE club_id = ?", [$club_id]);
}

// Fetch all clubs
$clubs = Database::search("SELECT * FROM clubs ORDER BY club_id DESC");
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header bg-gradient-success">
                    <h6 class="text-white">Clubs Management</h6>
                    <a href="edit-club.php" class="btn btn-light btn-sm">Add New Club</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Club Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($club = $clubs->fetch_assoc()): ?>
                            <tr>
                                <td><?= $club['name'] ?></td>
                                <td>
                                    <a href="edit-club.php?id=<?= $club['club_id'] ?>" class="btn btn-sm btn-success">Edit</a>
                                    <form method="POST" class="d-inline">
                                        <input type="hidden" name="club_id" value="<?= $club['club_id'] ?>">
                                        <button type="submit" name="delete_club" class="btn btn-sm btn-danger">Delete</button>
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
