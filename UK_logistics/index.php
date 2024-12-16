<?php 
  session_start();
  if(!isset($_SESSION['email'])){
    header("Location: http://localhost/UK_logistics/login.php");
  }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CargoHub</title>
  <link rel="icon" type="image/png" href="images/icon.png">
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
  <style>
    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
    }
</style>
</head>

<body style="font-size: 14px;">
  <div class="wrapper">
    <aside id="sidebar" class="expand">
      <div class="d-flex">
        <button class="toggle-btn" type="button">
          <i class="lni lni-grid-alt"></i>
        </button>
        <div class="sidebar-logo">
          <a href="#">Admin</a>
        </div>
      </div>
      <ul class="sidebar-nav">
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="sidebar-item">
                    <a href="site.php" class="sidebar-link">
                        <i class="nav-icon fas fa-building"></i>
                        <span>Sites</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="job.php" class="sidebar-link">
                        <i class="nav-icon fas fa-boxes"></i>
                        <span>Jobs</span>
                    </a>
                </li>
                <li class="sidebar-item">
          <a href="vehicles.php" class="sidebar-link">
            <i class="nav-icon fas fa-truck"></i>
            <span>Vehicles</span>
          </a>
        </li>
      </ul>
      <div class="sidebar-footer">
        <a href="profile.php" class="sidebar-link">
          <i class="nav-icon fas fa-user"></i>
          <span>Profile</span>
        </a>
      </div>
      <div class="sidebar-footer">
        <a href="API/logout.php" class="sidebar-link">
          <i class="lni lni-exit"></i>
          <span>Logout</span>
        </a>
      </div>
    </aside>
    <div class="main">
      <nav class="navbar navbar-expand px-4 py-3" style="background-color: #a7b1b8;">
        <div class="navbar-collapse collapse">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
              <img src="images/icon.png" width="30" height="30">
              <span>Logistics Management System</span>
            </li>
          </ul>
        </div>
      </nav>
      <main class="content px-3 py-4">
        <div class="container-fluid">
          <div class="mb-3">
            <h3 class="fw-bold fs-4 mb-3">Home</h3>
            <hr>
            <div class="container">
              <div class="row">
                <div class="container">
                  <div class="row">
                    <div class="col-md-4 col-sm-6 mt-5 mb-3">
                      <a href="site.php">
                      <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                          <div>
                          <?php
                              require_once 'API/db_info.php';
                              $query = "SELECT COUNT(*) AS total_site FROM site";
                              $result = $conn->query($query);
                              $row = mysqli_fetch_assoc($result);
                              echo "<h5 class='card-title'>" . $row['total_site'] . "</h5>"; // Display the count
                              ?>
                            <p class="card-text">Total Sites</p>
                          </div>
                          <i class="fas fa-building fa-3x"></i>
                        </div>
                      </div>
                      </a>
                    </div>
                    <div class="col-md-4 col-sm-6 mt-5 mb-3">
                    <a href="job.php">
                      <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                          <div>
                          <?php
                              $query = "SELECT COUNT(*) AS total_job FROM job";
                              $result = $conn->query($query);
                              $row = mysqli_fetch_assoc($result);
                              echo "<h5 class='card-title'>" . $row['total_job'] . "</h5>"; // Display the count
                              ?>
                            <p class="card-text">Total Jobs</p>
                          </div>
                          <i class="fas fa-boxes fa-3x"></i>
                        </div>
                      </div>
                      </a>
                    </div>
                    <div class=" col-md-4  col-sm-6 mt-5 mb-3">
                      <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                          <div>
                              <?php
                              $query = "SELECT COUNT(*) AS total_staff FROM userinfo";
                              $result = $conn->query($query);
                              $row = mysqli_fetch_assoc($result);
                              echo "<h5 class='card-title'>" . $row['total_staff'] . "</h5>"; // Display the count
                              ?>
                            <p class="card-text">Total Staff</p>
                          </div>
                          <i class="fas fa-users fa-3x"></i>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-6 mt-5">
                      <a href="outstanding_jobs.php">
                      <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                          <div>
                          <?php
                              $query = "SELECT COUNT(*) AS total_out FROM job WHERE status='outstanding'";
                              $result = $conn->query($query);
                              $row = mysqli_fetch_assoc($result);
                              echo "<h5 class='card-title'>" . $row['total_out'] . "</h5>"; // Display the count
                              ?>
                            <p class="card-text">Outstanding Jobs</p>
                          </div>
                          <i class="fas fa-boxes fa-3x"></i>
                        </div>
                      </div>
                    </a>
                    </div>
                    <div class=" col-md-4 col-sm-6 mt-5">
                      <a href="completed_jobs.php">
                      <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                          <div>
                          <?php
                              $query = "SELECT COUNT(*) AS total_com FROM job WHERE status='completed'";
                              $result = $conn->query($query);
                              $row = mysqli_fetch_assoc($result);
                              echo "<h5 class='card-title'>" . $row['total_com'] . "</h5>"; // Display the count
                              ?>
                            <p class="card-text">Completed Jobs</p>
                          </div>
                          <i class="fas fa-boxes fa-3x"></i>
                        </div>
                      </div>
                      </a>
                    </div>
                    
                     <div class="col-md-4 col-sm-6 mt-5 mb-5">
                     <a href="vehicles.php">
                      <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                          <div>
                          <?php
                              $query = "SELECT COUNT(*) AS total_veh FROM vehicle";
                              $result = $conn->query($query);
                              $row = mysqli_fetch_assoc($result);
                              echo "<h5 class='card-title'>" . $row['total_veh'] . "</h5>"; // Display the count
                              $conn->close();
                              ?>
                            <p class="card-text">Total Vehicles</p>
                          </div>
                          <i class="fas fa-truck fa-3x"></i>
                        </div>
                      </div>
                     </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </main>
      <footer class="footer">
        <div class="container-fluid">
          <div class="row text-body-secondary">
            <div class="col-6 me-0">
              <span>Copyright © 2024</span>
              <a class="text-body-secondary" href=" #">
                <strong>cargohub.com</strong>
              </a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script>
  const hamBurger = document.querySelector(".toggle-btn");
  const sidebar = document.querySelector("#sidebar");

  function toggleSidebar() {
    sidebar.classList.toggle("expand");
  }

  hamBurger.addEventListener("click", function() {
    toggleSidebar();
  });

  window.addEventListener("load", function() {
    if (window.innerWidth <= 992) {
      sidebar.classList.remove("expand");
    } else {
      sidebar.classList.add("expand");
    }
  });
  window.addEventListener("resize", function() {
  const sidebar = document.getElementById("sidebar");
  if (window.innerWidth <= 768) {
    sidebar.classList.remove("expand");
  } else {
    sidebar.classList.add("expand");
  }
});
</script>
</body>

</html>