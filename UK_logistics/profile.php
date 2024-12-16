<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: http://localhost/UK_logistics/login.php");
}

// Check if email and password are stored in the session
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$password = isset($_SESSION['password']) ? $_SESSION['password'] : '';
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
         .main-wrapper {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    
</head>

<body style="font-size: 14px; height: 100%;">
    <div class="wrapper" style="height: 100%;">
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
          
            <main class="content px-3 py-4 col-sm-6 mx-auto mt-5">
    <div class="main-wrapper bg-light d-flex justify-content-center align-items-center border rounded">
        <div class="container ">
            <div class="row">
                <div class="col-sm-6 main-content mx-auto">
                    <div class="text-center mb-3">
                    <h3 class="mt-5">Admin</h3>
                    </div>
                    <div class="text-center mb-3"> 
                        <img src="images/icon.png" style="height: auto; width: 20%;" class="">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" placeholder="Email address" value="<?php echo $email; ?>">
                    </div>
                    <div class="input-group mb-5">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id='password' placeholder="Password" value="<?php echo $password; ?>">
                        <span class="input-group-text " id="togglePassword"><i class="fas fa-eye-slash"></i></span>
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
        const passwordInput = document.getElementById('password');
        const togglePasswordButton = document.getElementById('togglePassword');

        togglePasswordButton.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fas fa-eye');
        });
    </script>
</body>

</html>