<?php 
require "../includes/header.php";

$error = '';
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $code = $_POST['code'] ?? '';
        $password = $_POST['password'] ?? '';
        $name = $_POST['name'] ?? '';
        $image = '';

        // Validate inputs
        if (empty($code) || empty($password) || empty($name)) {
            throw new Exception("All fields are required");
        }

        // Check if admin code exists
        $existing = Database::search("SELECT admin_id FROM admins WHERE code = ?", [$code]);
        if ($existing->num_rows > 0) {
            throw new Exception("Admin code already exists");
        }

        // Handle image upload
        if (!empty($_FILES['image']['name'])) {
            $uploadDir = '../images/';
            
            // Create directory if not exists
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
            $targetPath = $uploadDir . $fileName;
            
            // Check image validity
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $fileType = mime_content_type($_FILES['image']['tmp_name']);
            
            if (!in_array($fileType, $allowedTypes)) {
                throw new Exception("Only JPG, PNG, and GIF files are allowed");
            }

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                throw new Exception("Failed to upload image");
            }
            
            $image = $fileName;
        }

        // Hash password
        $hashedPassword = $password;

        // Insert admin
        Database::iud(
            "INSERT INTO admins (code, pass, name, image) VALUES (?, ?, ?, ?)",
            [$code, $hashedPassword, $name, $image]
        );

        $success = "Admin added successfully!";
        echo "<script>window.location.href = 'add-admin.php';</script>";
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
                        <h6 class="text-white text-capitalize ps-3">Add New Admin</h6>
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

                        <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Admin Code <span class="text-danger">*</span></label>
                                        <input type="text" name="code" class="form-control" required
                                            pattern="[A-Za-z0-9]{4,20}" 
                                            title="4-20 alphanumeric characters">
                                        <div class="invalid-feedback">
                                            Please enter a valid admin code (4-20 alphanumeric characters)
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control" required
                                            minlength="8"
                                            pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                                            title="Minimum 8 characters with at least 1 letter and 1 number">
                                        <div class="invalid-feedback">
                                            Password must be at least 8 characters with letters and numbers
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Please enter the admin's full name
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Profile Image</label>
                                        <div class="file-upload-wrapper">
                                            <input type="file" name="image" class="form-control" 
                                                accept="image/jpeg, image/png, image/gif">
                                            <small class="form-text text-muted">
                                                Recommended size: 300x300 pixels (JPG, PNG, GIF) (If you Get error, Try with recomend image sizes )
                                            </small>
                                        </div>
                                        <div class="preview-container mt-3">
                                            <img id="imagePreview" src="#" alt="Image preview" 
                                                class="img-thumbnail d-none" 
                                                style="max-width: 200px; max-height: 200px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-info">Add Admin</button>
                                <a href="admins.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Image preview functionality
document.querySelector('input[name="image"]').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    const file = e.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        }
        
        reader.readAsDataURL(file);
    } else {
        preview.src = '#';
        preview.classList.add('d-none');
    }
});

// Form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>

<style>
.file-upload-wrapper {
    position: relative;
    overflow: hidden;
    display: inline-block;
}

.file-upload-wrapper input[type=file] {
    font-size: 100px;
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
}

.preview-container {
    border: 2px dashed #dee2e6;
    padding: 15px;
    border-radius: 5px;
    text-align: center;
}
</style>
