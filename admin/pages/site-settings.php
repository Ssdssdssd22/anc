<?php
require "../includes/header.php";

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_settings'])) {
        $site_name = $_POST['site_name'];
        $site_description = $_POST['site_description'];
        $contact_email = $_POST['contact_email'];
        $contact_phone = $_POST['contact_phone'];
        $address = $_POST['address'];
        $facebook = $_POST['facebook_url'];
        $twitter = $_POST['twitter_url'];
        $instagram = $_POST['instagram_url'];
        
        // Handle logo upload
        $logo_path = $_POST['existing_logo'];
        if (!empty($_FILES['logo']['name'])) {
            $logo_name = uniqid() . '_' . basename($_FILES['logo']['name']);
            $target_path = "../../images/site/" . $logo_name;
            if (move_uploaded_file($_FILES['logo']['tmp_name'], $target_path)) {
                // Delete old logo if exists
                if ($logo_path && file_exists("../../" . $logo_path)) {
                    unlink("../../" . $logo_path);
                }
                $logo_path = 'images/site/' . $logo_name;
            }
        }

        // Update settings in database
        Database::iud(
            "UPDATE site_settings SET 
            site_name = ?,
            site_description = ?,
            logo = ?,
            contact_email = ?,
            contact_phone = ?,
            address = ?,
            facebook_url = ?,
            twitter_url = ?,
            instagram_url = ?
            WHERE id = 1",
            [
                $site_name,
                $site_description, 
                $logo_path,
                $contact_email,
                $contact_phone,
                $address,
                $facebook,
                $twitter,
                $instagram
            ]
        );
    }
}

// Fetch current settings
$settings = Database::search("SELECT * FROM site_settings WHERE id = 1")->fetch_assoc();
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Site Settings</h6>
                    </div>
                </div>
                <div class="card-body px-4">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card shadow-lg">
                                    <div class="card-header bg-gradient-success text-white">
                                        <h6 class="mb-0">General Settings</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Site Name</label>
                                            <input type="text" name="site_name" class="form-control" 
                                                value="<?= htmlspecialchars($settings['site_name'] ?? '') ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Site Description</label>
                                            <textarea name="site_description" class="form-control" rows="4" 
                                                required><?= htmlspecialchars($settings['site_description'] ?? '') ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Contact Email</label>
                                            <input type="email" name="contact_email" class="form-control" 
                                                value="<?= htmlspecialchars($settings['contact_email'] ?? '') ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Contact Phone</label>
                                            <input type="tel" name="contact_phone" class="form-control" 
                                                value="<?= htmlspecialchars($settings['contact_phone'] ?? '') ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <textarea name="address" class="form-control" rows="3" 
                                                required><?= htmlspecialchars($settings['address'] ?? '') ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card shadow-lg mb-4">
                                    <div class="card-header bg-gradient-success text-white">
                                        <h6 class="mb-0">Site Logo</h6>
                                    </div>
                                    <div class="card-body">
                                        <?php if (!empty($settings['logo'])): ?>
                                            <img src="../../<?= htmlspecialchars($settings['logo']) ?>" 
                                                class="img-fluid mb-3" alt="Current Logo">
                                        <?php endif; ?>
                                        <input type="hidden" name="existing_logo" 
                                            value="<?= htmlspecialchars($settings['logo'] ?? '') ?>">
                                        <input type="file" name="logo" class="form-control" accept="image/*">
                                        <small class="text-muted">Leave empty to keep current logo</small>
                                    </div>
                                </div>

                                <div class="card shadow-lg">
                                    <div class="card-header bg-gradient-success text-white">
                                        <h6 class="mb-0">Social Media Links</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Facebook URL</label>
                                            <input type="url" name="facebook_url" class="form-control" 
                                                value="<?= htmlspecialchars($settings['facebook_url'] ?? '') ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Twitter URL</label>
                                            <input type="url" name="twitter_url" class="form-control" 
                                                value="<?= htmlspecialchars($settings['twitter_url'] ?? '') ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Instagram URL</label>
                                            <input type="url" name="instagram_url" class="form-control" 
                                                value="<?= htmlspecialchars($settings['instagram_url'] ?? '') ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" name="update_settings" class="btn btn-success">
                                <i class="material-icons">save</i> Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
