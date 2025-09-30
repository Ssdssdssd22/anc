<?php require "../includes/header.php";

// Fetch real data from database
$adminCount = Database::search("SELECT COUNT(*) AS count FROM admins")->fetch_assoc()['count'];
$staffCount = Database::search("SELECT COUNT(*) AS count FROM staff")->fetch_assoc()['count'];
$eventCount = Database::search("SELECT COUNT(*) AS count FROM events")->fetch_assoc()['count'];
$newsCount = Database::search("SELECT COUNT(*) AS count FROM news")->fetch_assoc()['count'];

// Get recent events
$recentEvents = Database::search(
    "SELECT e.*, it.type 
     FROM events e
     JOIN image_type it ON e.image_type = it.type_id
     ORDER BY e.date DESC LIMIT 5"
);

// Get event status statistics
$eventStatus = Database::search(
    "SELECT 
        SUM(CASE WHEN date >= CURDATE() THEN 1 ELSE 0 END) AS upcoming,
        SUM(CASE WHEN date < CURDATE() THEN 1 ELSE 0 END) AS past
     FROM events"
)->fetch_assoc();

// Get recent news
$recentNews = Database::search(
    "SELECT news_id, title, publish_date 
     FROM news 
     ORDER BY publish_date DESC LIMIT 5"
);
?>

<div class="container-fluid py-4">
  <div class="row">
    <!-- Weather Widget -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">thermostat</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Kalutara Weather</p>
            <h4 class="mb-0" id="weather">
              <?php
              $apiKey = '9aa7764c4e1978a72b96a55e8f4c69c3';
              $city = 'Kalutara';
              $url = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&units=metric";
              $response = file_get_contents($url);
              if ($response !== false) {
                  $weatherData = json_decode($response, true);
                  echo htmlspecialchars($weatherData['main']['temp'] ?? 'N/A') . ' °C';
              } else {
                  echo "Unavailable";
              }
              ?>
            </h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
          <p class="mb-0">
            <?php if(isset($weatherData)): ?>
            <span class="text-success text-sm font-weight-bolder">
              <?= htmlspecialchars($weatherData['wind']['speed'] ?? 'N/A') ?> m/s
            </span>
            <?= htmlspecialchars($weatherData['weather'][0]['description'] ?? '') ?>
            <?php endif; ?>
          </p>
        </div>
      </div>
    </div>

    <!-- Admins Card -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">admin_panel_settings</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">System Admins</p>
            <h4 class="mb-0"><?= $adminCount ?></h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
          <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Active</span> Administrators</p>
        </div>
      </div>
    </div>

    <!-- Staff Card -->
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">groups</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Teaching Staff</p>
            <h4 class="mb-0"><?= $staffCount ?></h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
          <p class="mb-0"><span class="text-success text-sm font-weight-bolder">Active</span> Faculty Members</p>
        </div>
      </div>
    </div>

    <!-- Events Card -->
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">event</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Total Events</p>
            <h4 class="mb-0"><?= $eventCount ?></h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
          <p class="mb-0">
            <span class="text-success text-sm font-weight-bolder"><?= $eventStatus['upcoming'] ?> upcoming</span>, 
            <span class="text-secondary"><?= $eventStatus['past'] ?> past</span>
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <!-- Events Table -->
    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-lg-6 col-7">
              <h6>Recent Events</h6>
              <p class="text-sm mb-0">
                <i class="fa fa-calendar-check text-info" aria-hidden="true"></i>
                <span class="font-weight-bold ms-1"><?= $eventCount ?> total</span> events
              </p>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Event</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Details</th>
                </tr>
              </thead>
              <tbody>
                <?php while($event = $recentEvents->fetch_assoc()): 
                  $eventDate = new DateTime($event['date']);
                  $isPast = $eventDate < new DateTime();
                ?>
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm"><?= htmlspecialchars($event['topic']) ?></h6>
                        <p class="text-xs text-secondary mb-0"><?= htmlspecialchars($event['caption']) ?></p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0"><?= $eventDate->format('M j, Y') ?></p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm <?= $isPast ? 'bg-gradient-secondary' : 'bg-gradient-success' ?>">
                      <?= $isPast ? 'Completed' : 'Upcoming' ?>
                    </span>
                  </td>
                  <td class="align-middle text-center">
                    <a href="evnts.php?id=<?= $event['event_id'] ?>" class="btn btn-sm btn-outline-info">
                      View Details
                    </a>
                  </td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent News Timeline -->
    <div class="col-lg-4 col-md-6">
      <div class="card h-100">
        <div class="card-header pb-0">
          <h6>Latest News</h6>
          <p class="text-sm">
            <i class="fa fa-newspaper text-success" aria-hidden="true"></i>
            <span class="font-weight-bold"><?= $newsCount ?></span> news articles
          </p>
        </div>
        <div class="card-body p-3">
          <div class="timeline timeline-one-side">
            <?php while($news = $recentNews->fetch_assoc()): 
              $newsDate = new DateTime($news['publish_date']);
            ?>
            <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="material-icons text-info text-gradient">article</i>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">
                  <a href="news.php?id=<?= $news['news_id'] ?>" class="text-dark">
                    <?= htmlspecialchars($news['title']) ?>
                  </a>
                </h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                  <?= $newsDate->format('M j, Y') ?>
                </p>
              </div>
            </div>
            <?php endwhile; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer py-4">
    <div class="container-fluid">
      <div class="row align-items-center justify-content-lg-between">
        <div class="col-lg-6 mb-lg-0 mb-4">
          <div class="copyright text-center text-sm text-muted text-lg-start">
            © <script>document.write(new Date().getFullYear())</script>,
            Kalutara Vidyalaya - School Management System
          </div>
        </div>
        <div class="col-lg-6">
          <ul class="nav nav-footer justify-content-center justify-content-lg-end">
            <li class="nav-item">
              <a href="/dashboard" class="nav-link text-muted">Dashboard</a>
            </li>
            <li class="nav-item">
              <a href="/events" class="nav-link text-muted">Events</a>
            </li>
            <li class="nav-item">
              <a href="/news" class="nav-link text-muted">News</a>
            </li>
            <li class="nav-item">
              <a href="/staff" class="nav-link pe-0 text-muted">Staff</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
</div>

<?php require "../includes/setting.php" ?>
<!-- Remainder of JS files -->
</body>
</html>