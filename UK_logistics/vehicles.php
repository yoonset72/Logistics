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
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <!-- DataTables JS -->
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
                <a href="API/logout.php" class="sidebar-link">
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
                        <button class="btn btn-primary btn-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addVehicleModal">
                            <span class="d-none d-sm-inline">Add New Vehicle</span>
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
                <div id="listvehicles" class="mb-5"></div>
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
    <!-- Modal for Editing Vehicle -->
    <div class="modal fade" id="editVehicleModal" tabindex="-1" aria-labelledby="editVehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editVehicleModalLabel">Edit Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editVehicleForm">
                        <div class="mb-3">
                            <label for="editVehicleId" class="form-label">Vehicle ID</label>
                            <input type="text" class="form-control" id="editVehicleId" name="editVehicleId" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="editVehicleType" class="form-label">Vehicle Type</label>
                            <select class="form-select" aria-label="Vehicle Type" id="editVehicleType"></select>
                        </div>
                        <div class="mb-3">
                            <label for="editVehicleHomeSite" class="form-label">Home Site ID</label>
                            <select class="form-select" aria-label="Home Site ID" id="editVehicleHomeSite"></select>
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
    <div class="modal fade" id="deleteVehicleModal" tabindex="-1" aria-labelledby="deleteVehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteVehicleModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this vehicle?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Add New Vehicle -->
    <div class="modal fade" id="addVehicleModal" tabindex="-1" aria-labelledby="addVehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVehicleModalLabel">Add New Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addVehicleForm">
                        <div class="mb-3">
                            <label for="addVehicleType" class="form-label">Vehicle Type</label>
                            <select class="form-select" aria-label="Vehicle Type" id="addVehicleType">
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="addVehicleHomeSite" class="form-label">Home Site ID</label>
                            <select class="form-select" aria-label="Home Site ID" id="addVehicleHomeSite">
                            </select>
                        </div>
                        <div class="mb-3 text-center text-danger" id="addVehicleError"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="addVehicleBtn">Add Vehicle</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Viewing Details -->
<div class="modal fade" id="viewDetailsModal" tabindex="-1" aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDetailsModalLabel">Vehicle Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                <label for="viewVehicleId" class="form-label">Vehicle ID</label>
                    <input type="text" class="form-control" id="viewVehicleId" name="viewVehicleId" disabled>
                </div>
                <div class="mb-3">
                <label for="viewVehicleType" class="form-label">Type</label>
                    <input type="text" class="form-control" id="viewVehicleType" name="viewVehicleType" disabled>
                </div>
                <div class="mb-3">
                <label for="viewVehicleMaxWeight" class="form-label">Maximum Weight in kg</label>
                    <input type="text" class="form-control" id="viewVehicleMaxWeight" name="viewVehicleMaxweight" disabled>
                </div>
                <div class="mb-3">
                <label for="viewVehicleMaxSpace" class="form-label">Maximum Space in m</label>
                    <input type="text" class="form-control" id="viewVehicleMaxSpace" name="viewVehicleMaxSpace" disabled>
                </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>



    <!-- Script for Deleting Site -->
    <script>
        $(document).ready(function() {
            function fetchVehicles() {
                $.ajax({
                        method: "GET",
                        url: "API/vehicle_API.php",
                        datatype: "json"
                    })
                    .done(function(data) {
                        var result;
                        var response = JSON.parse(data);
                        result = `<table class="table table-striped table-hover nowrap table-sm  mx-auto my-5" id="myDataTable" style="width: 100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Home Site</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>`;

                        $.each(response, function(key, value) {
                            result += `
            <tr>
              <td class="text-center">${value.vehicle_id}</td>
              <td>${value.type}</td>
              <td>${value.home_site}</td>
              <td>  
              <button type='button' class='btn btn-info rounded-end-1 btn-sm bg-gradient view_details' data-id='${value.vehicle_id}' data-type='${value.type}' data-max_weight='${value.max_weight}' data-max_space='${value.max_space}'><i class="fas fa-eye"></i></button>
              <button type='button' class='btn btn-primary rounded-start-1 btn-sm bg-gradient edit_vehicle' data-id='${value.vehicle_id}' data-type='${value.type}' data-home_site='${value.home_site}'><i class="fas fa-pen"></i></button>
                <button type='button' class='btn btn-danger rounded-end-1 btn-sm bg-gradient delete_vehicle' data-id='${value.vehicle_id}'><i class="fas fa-trash"></i></button>
                
            </td>
              </td>
            </tr>
          `;
                        });
                        result += "</tbody></table>";

                        $('#listvehicles').html(result);
                        $('#myDataTable').DataTable({
                            fixedHeader: true,
                            responsive: true
                        });
                    });
            }
            fetchVehicles();

            function populateSelectBoxes() {
                $.ajax({
                        method: "GET",
                        url: "API/sites_API.php",
                        dataType: "JSON"
                    })
                    .done(function(data) {
                        var option = '<option selected disabled>Select Home Site</option>';
                        $.each(data, function(key, value) {
                            option += '<option>' + value.name + '</option>';
                        });
                        $('#addVehicleHomeSite, #editVehicleHomeSite').html(option);
                    })
            }

            populateSelectBoxes();

            function populateSelectBoxesType() {
                $.ajax({
                        method: "GET",
                        url: "API/vehicleType_API.php",
                        dataType: "JSON"
                    })
                    .done(function(data) {
                        var option = '<option selected disabled>Select Vehicle Type</option>';
                        $.each(data, function(key, value) {
                            option += '<option>' + value.type + '</option>';
                        });
                        $('#addVehicleType, #editVehicleType').html(option);
                    })
            }
            populateSelectBoxesType();

             // vehicle detail function
             $(document).on('click', '.view_details', function() {
                var vehicleId = $(this).data('id');
                var type = $(this).data('type');
                var max_weight = $(this).data('max_weight');
                var max_space = $(this).data('max_space');

                // Populate modal fields with vehicle data
                $('#viewVehicleId').val(vehicleId);
                $('#viewVehicleType').val(type);
                $('#viewVehicleMaxWeight').val(max_weight);
                $('#viewVehicleMaxSpace').val(max_space);

                // Open edit vehicle modal
                $('#viewDetailsModal').modal('show');
            });



            // Edit vehicle function
            $(document).on('click', '.edit_vehicle', function() {
                var vehicleId = $(this).data('id');
                var vehicleType = $(this).data('type');
                var vehicleHomeSite = $(this).data('home_site');

                // Populate modal fields with vehicle data
                $('#editVehicleId').val(vehicleId);
                $('#editVehicleType').val(vehicleType);
                $('#editVehicleHomeSite').val(vehicleHomeSite);

                // Open edit vehicle modal
                $('#editVehicleModal').modal('show');
            });

            // Handle form submission
            $('#saveChangesBtn').click(function() {
                var vehicleId = $('#editVehicleId').val();
                var vehicleType = $('#editVehicleType').val();
                var vehicleHomeSite = $('#editVehicleHomeSite').val();

                // Send AJAX request to update site data
                $.ajax({
                    method: "POST",
                    url: "API/update_vehicle_API.php",
                    data: {
                        vehicleId: vehicleId,
                        vehicleType: vehicleType,
                        vehicleHomeSite: vehicleHomeSite
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            $('#editVehicleModal').modal('hide');
                            fetchVehicles();
                        } else {
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Delete vehicle function
            $(document).on('click', '.delete_vehicle', function() {
                var vehicleId = $(this).data('id');
                $('#confirmDeleteBtn').attr('data-id', vehicleId);
                $('#deleteVehicleModal').modal('show');
            });

            $('#confirmDeleteBtn').click(function() {
                var vehicleId = $(this).data('id');
                console.log(vehicleId);
                $.ajax({
                    method: "POST",
                    url: "API/delete_vehicle_API.php",
                    data: {
                        vehicleId: vehicleId
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            console.log(response.message);
                            fetchVehicles();
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

            // Handle form submission for adding new vehicle
            $('#addVehicleBtn').click(function() {

                // Extract form data
                var vehicleType = $('#addVehicleType').val();
                var vehicleHomeSite = $('#addVehicleHomeSite').val();

                // AJAX request to create new vehicle
                $.ajax({
                        method: "POST",
                        url: "API/create_vehicle_API.php",
                        data: {
                            vehicleType: vehicleType,
                            vehicleHomeSite: vehicleHomeSite
                        },
                        dataType: "json"
                    })
                    .done(function(data) {
                        if (data.status === "success") {
                            alert("Vehicle added successfully!")
                            fetchVehicles(); 
                            window.location.reload('true');
                        } else {
                            $('#addVehicleError').text(data.message); // Display error message
                        }
                    })
                    .fail(function(xhr, status, error) {
                        console.error(xhr.responseText);
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