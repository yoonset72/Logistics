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
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


    <!-- DataTables JS -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
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
                <a href="login.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-4 py-3 " style="background-color: #a7b1b8;">
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
                <div class="container-fluid d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <button class="btn btn-primary btn-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addSiteModal">
                            <span class="d-none d-sm-inline">Add New Site</span>
                            <span class="d-inline d-sm-none"><i class="fas fa-plus"></i></span>
                        </button>
                    </div>
                    <div>
                        <button class="btn btn-primary btn-sm d-flex align-items-center">
                            <a href="index.php" class="text-white">
                                <span class="d-none d-sm-inline">Dashboard</span>
                                <span class="d-inline d-sm-none"><i class="fas fa-home"></i></span>
                            </a>
                        </button>
                    </div>
                </div>
                <div id="listsites" class="mb-5"></div>

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
    <!-- Modal for Editing Sites -->
    <div class="modal fade" id="editSiteModal" tabindex="-1" aria-labelledby="editSiteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSiteModalLabel">Edit Site</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editSiteForm">
                        <div class="mb-3">
                            <label for="editSiteId" class="form-label">Site ID</label>
                            <input type="text" class="form-control" id="editSiteId" name="editSiteId" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="editSiteName" class="form-label">Site Name</label>
                            <input type="text" class="form-control" id="editSiteName" name="editSiteName">
                        </div>
                        <div class="mb-3">
                            <label for="editSiteAddress" class="form-label">Site Address</label>
                            <input type="text" class="form-control" id="editSiteAddress" name="editSiteAddress">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveChangesBtn">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Confirming Deletion -->
    <div class="modal fade" id="deleteSiteModal" tabindex="-1" aria-labelledby="deleteSiteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSiteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this site?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Add New Site -->
    <div class="modal fade" id="addSiteModal" tabindex="-1" aria-labelledby="addSiteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSiteModalLabel">Add New Site</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addSiteForm">
                        <div class="mb-3">
                            <label for="addSiteName" class="form-label">Site Name</label>
                            <input type="text" class="form-control" id="addSiteName" name="addSiteName" required>
                        </div>
                        <div class="mb-3">
                            <label for="addSiteAddress" class="form-label">Site Address</label>
                            <input type="text" class="form-control" id="addSiteAddress" name="addSiteAddress" required>
                        </div>
                        <div class="mb-3 text-center text-danger" id="addSiteError"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="addSiteBtn">Add Site</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Script for Deleting Site -->
    <script>
        $(document).ready(function() {
            function fetchSites() {
                $.ajax({
                        method: "GET",
                        url: "API/list_sites_API.php",
                        datatype: "json"
                    })
                    .done(function(data) {
                        var result;
                        var response = JSON.parse(data);
                        result = `<table class="table table-striped table-hover nowrap table-sm  mx-auto my-5" id="myDataTable" style="width: 100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>`;

                        $.each(response, function(key, value) {
                            result += `
            <tr>
              <td class="text-center">${value.site_id}</td>
              <td>${value.name}</td>
              <td>${value.address}</td>
              <td>  
              <button type='button' class='btn btn-primary rounded-start-1 btn-sm bg-gradient edit_site' data-id='${value.site_id}' data-name='${value.name}' data-address='${value.address}'><i class="fas fa-pen"></i></button>

                <button type='button' class='btn btn-danger rounded-end-1 btn-sm bg-gradient delete_site' data-id='${value.site_id}'><i class="fas fa-trash"></i></button>
              </td>
            </tr>
          `;
                        });
                        result += "</tbody></table>";

                        $('#listsites').html(result);
                        $('#myDataTable').DataTable({
                            fixedHeader: true,
                            responsive: true
                        });
                    });
            }
            fetchSites();

            // Edit site function
            $(document).on('click', '.edit_site', function() {
                var siteId = $(this).data('id');
                var siteName = $(this).data('name');
                var siteAddress = $(this).data('address');

                // Populate modal fields with site data
                $('#editSiteId').val(siteId);
                $('#editSiteID').val(siteId);
                $('#editSiteName').val(siteName);
                $('#editSiteAddress').val(siteAddress);

                // Open edit site modal
                $('#editSiteModal').modal('show');
            });

            // Handle form submission
            $('#saveChangesBtn').click(function() {
                var siteId = $('#editSiteId').val();
                var siteName = $('#editSiteName').val();
                var siteAddress = $('#editSiteAddress').val();

                // Send AJAX request to update site data
                $.ajax({
                    method: "POST",
                    url: "API/update_site_API.php",
                    data: {
                        siteId: siteId,
                        siteName: siteName,
                        siteAddress: siteAddress
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            $('#editSiteModal').modal('hide');
                            fetchSites();
                        } else {
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Delete site function
            $(document).on('click', '.delete_site', function() {
                var siteId = $(this).data('id');
                $('#confirmDeleteBtn').attr('data-id', siteId);
                $('#deleteSiteModal').modal('show');
            });

            $('#confirmDeleteBtn').click(function() {
                var siteId = $(this).data('id');
                console.log(siteId);
                $.ajax({
                    method: "POST",
                    url: "API/delete_site_API.php",
                    data: {
                        siteId: siteId
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            console.log(response.message);
                            fetchSites();
                            window.location.reload(true);
                        } else {
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Function to validate form fields
            function validateForm() {
                var siteName = $('#addSiteName').val().trim();
                var siteAddress = $('#addSiteAddress').val().trim();

                // Check if any field is empty
                if (siteName === '' || siteAddress === '') {
                    $('#addSiteError').text('All fields are required!');
                    return false;
                } else {
                    $('#addSiteError').text('');
                    return true;
                }
            }


            // Handle form submission for adding new site
            $('#addSiteBtn').click(function() {

                // Validate the form
                if (!validateForm()) {
                    return;
                }

                var siteName = $('#addSiteName').val();
                var siteAddress = $('#addSiteAddress').val();

                // Send AJAX request to create new site
                $.ajax({
                    method: "POST",
                    url: "API/create_site_API.php",
                    data: {
                        name: siteName,
                        address: siteAddress
                    },
                    dataType: "json"
                }).done(function(data) {
                    if (data.message.includes('Create site successfully')) {
                        fetchSites(); 
                        alert(data.message);
                        window.location.reload(true);
                    } else {
                        console.error(data.message);
                    }
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
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>