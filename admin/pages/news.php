<?php
require "../includes/header.php";
// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['add_news'])) {
    try {
      // Get form data
      $title = $_POST['title'];
      $content = $_POST['content'];
      $publish_date = $_POST['publish_date'];
      $is_published = isset($_POST['is_published']) ? 1 : 0;
      $image_type = $_POST['image_type'];

      // Handle main image upload
      $main_image_path = '';
      if (!empty($_FILES['main_image']['name'])) {
        $image_name = uniqid() . '_' . basename($_FILES['main_image']['name']);
        $target_path = "../../images/news/" . $image_name;
        if (move_uploaded_file($_FILES['main_image']['tmp_name'], $target_path)) {
          $main_image_path = 'images/news/' . $image_name;
        }
      }

      // Insert news into database
      Database::iud(
        "INSERT INTO news (title, content, main_image, image_type, publish_date, is_published) 
                         VALUES (?, ?, ?, ?, ?, ?)",
        [$title, $content, $main_image_path, $image_type, $publish_date, $is_published]
      );

      // Get new news ID
      $news_id = Database::$connection->insert_id;

      // Handle additional images upload
      if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
          $image_name = uniqid() . '_' . basename($_FILES['images']['name'][$key]);
          $target_path = "../../images/news/" . $image_name;
          if (move_uploaded_file($tmp_name, $target_path)) {
            Database::iud(
              "INSERT INTO news_images (news_id, image_path) VALUES (?, ?)",
              [$news_id, 'images/news/' . $image_name]
            );
          }
        }
      }

      $_SESSION['success'] = "News article added successfully!";
      // header("Location: news.php");
      // exit();

    } catch (Exception $e) {
      $_SESSION['error'] = "Error adding news: " . $e->getMessage();
      header("Location: news.php");
      exit();
    }
  }
  if (isset($_POST['delete_news'])) { // Remove extra closing parenthesis
    try {
      $news_id = $_POST['news_id'];

      // 1. Delete additional images first
      $images = Database::search("SELECT image_path FROM news_images WHERE news_id = ?", [$news_id]);
      while ($image = $images->fetch_assoc()) {
        if (file_exists("../" . $image['image_path'])) {
          unlink("../" . $image['image_path']);
        }
      }
      Database::iud("DELETE FROM news_images WHERE news_id = ?", [$news_id]);

      // 2. Delete main image and news entry
      $news = Database::search("SELECT main_image FROM news WHERE news_id = ?", [$news_id])->fetch_assoc();
      if ($news['main_image'] && file_exists("../" . $news['main_image'])) {
        unlink("../" . $news['main_image']);
      }
      Database::iud("DELETE FROM news WHERE news_id = ?", [$news_id]);

      $_SESSION['success'] = "News deleted successfully!";
    } catch (Exception $e) {
      $_SESSION['error'] = "Error deleting news: " . $e->getMessage();
    }
    echo "<script>window.location.href = 'news.php';</script>";
            exit();
  }
}

// Fetch all news
$news = Database::search("SELECT n.*, it.type 
                        FROM news n
                        JOIN image_type it ON n.image_type = it.type_id
                        ORDER BY n.publish_date DESC");
?>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">News Management</h6>
            <button class="btn btn-light btn-sm float-end me-3" data-bs-toggle="modal" data-bs-target="#addNewsModal">
              <i class="material-icons">add</i> Add New News
            </button>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-3">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Title</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Publish Date</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder">Status</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($item = $news->fetch_assoc()): ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <?php if ($item['main_image']): ?>
                          <div>
                            <img src="../../<?= htmlspecialchars($item['main_image']) ?>"
                              class="avatar avatar-sm me-3 border-radius-lg" alt="news-image">
                          </div>
                        <?php endif; ?>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= htmlspecialchars($item['title']) ?></h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0"><?= $item['publish_date'] ?></p>
                    </td>
                    <td>
                      <span class="badge badge-sm <?= $item['is_published'] ? 'bg-gradient-success' : 'bg-gradient-secondary' ?>">
                        <?= $item['is_published'] ? 'Published' : 'Draft' ?>
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      <a href="edit-news.php?id=<?= $item['news_id'] ?>" class="btn btn-success btn-sm me-1">
                        <i class="material-icons">edit</i>
                      </a>
                      <form method="POST" class="d-inline">
                        <input type="hidden" name="news_id" value="<?= $item['news_id'] ?>">
                        <button type="submit" name="delete_news" class="btn btn-danger btn-sm"
                          onclick="return confirm('Are you sure you want to delete this news item?')">
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

<!-- Add News Modal -->
<div class="modal fade" id="addNewsModal" tabindex="-1" role="dialog" aria-labelledby="addNewsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-success">
        <h5 class="modal-title text-white" id="addNewsModalLabel">Add News Article</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
            <?php unset($_SESSION['error']); ?>
          <?php endif; ?>

          <div class="row">
            <div class="col-md-8">
              <div class="mb-3">
                <label class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Content <span class="text-danger">*</span></label>
                <textarea name="content" class="form-control" rows="6" required></textarea>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card shadow-lg">
                <div class="card-header bg-gradient-success text-white">
                  <h6 class="mb-0">News Details</h6>
                </div>
                <div class="card-body">
                  <div class="mb-3">
                    <label class="form-label">Image Type <span class="text-danger">*</span></label>
                    <select name="image_type" class="form-select" required>
                      <?php
                      $types = Database::search("SELECT * FROM image_type");
                      while ($type = $types->fetch_assoc()): ?>
                        <option value="<?= $type['type_id'] ?>"><?= strtoupper($type['type']) ?></option>
                      <?php endwhile; ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Publish Date <span class="text-danger">*</span></label>
                    <input type="date" name="publish_date" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="is_published" id="is_published" checked>
                      <label class="form-check-label" for="is_published">
                        Publish Immediately
                      </label>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Main Image <span class="text-danger">*</span></label>
                    <input type="file" name="main_image" class="form-control" accept="image/*" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Additional Images</label>
                    <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="add_news" class="btn btn-success">Publish News</button>
        </div>
      </form>
    </div>
  </div>
</div>