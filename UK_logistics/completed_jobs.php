<?php
session_start();
if (!isset($_SESSION['email'])) {
  header("Location: http://localhost/UK_logistics/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CargoHub</title>
  <link rel="icon" type="image/png" href="images/icon.png">

  <!-- Bootstrap CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

  <!-- DataTables CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.bootstrap5.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">

  <!-- jQuery -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">

  <!-- DataTables JS -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>

  <!-- LineIcons -->
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles.css">
</head>


<body style="font-size: 12px;">
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
          <a href="index.php" class="sidebar-link">
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
        <a href="login.php" class="sidebar-link">
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
        <div class="row d-flex justify-content-between align-items-center mb-3">
            <div class="col-auto ms-auto">
                <button class="btn btn-primary btn-sm">
                    <a href="index.php" class="text-white">
                        <span class="d-none d-sm-inline">Dashboard</span>
                        <span class="d-inline d-sm-none"><i class="fas fa-home"></i></span>
                    </a>
                </button>
            </div>
        </div>
    </div>
    <div id="listJobs" class="mb-5"></div>
</main>
<footer class="footer">
        <div class="container-fluid">
          <div class="row text-body-secondary">
            <div class="col-6 text-end ">
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
  <script>
    $(document).ready(function() {
        $.ajax({
          method: "GET",
          url: "API/completed_jobs_API.php",
          datatype: "json"
        }).done(function(data) {
          var result;
          var response = JSON.parse(data);
          result = `<table class="table table-striped table-hover nowrap table-sm mx-auto my-5" style="width:100%" id="myJobDataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Weight</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>From Site</th>
                                <th>To Site</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Vehicle ID</th>
                                <th>Classification</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>`;

          $.each(response, function(key, value) {
            result += `
                            <tr>
                                <td class="text-center">${value.job_id}</td>
                                <td>${value.good_name}</td>
                                <td>${value.weight}</td>
                                <td>${value.size}</td>
                                <td>${value.quantity}</td>
                                <td>${value.from_site}</td>
                                <td>${value.to_site}</td>
                                <td>${value.from_date}</td>
                                <td>${value.due_date}</td>
                                <td>${value.vehicle_id}</td>
                                <td>${value.classification}</td>
                                <td>${value.status}</td>
                            </tr>`;
          });

          result += "</tbody></table>";

          $('#listJobs').html(result);
          $('#myJobDataTable').DataTable({
            fixedHeader: true,
            responsive: true,
          });
        });

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
      })
    });

  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>