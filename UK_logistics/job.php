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
            <div class="col-auto">
              <button class="btn btn-primary btn-sm  align-items-center" data-bs-toggle="modal" data-bs-target="#addJobModal">
                <span class="d-none d-sm-inline">Add New Job</span>
                <span class="d-inline d-sm-none"><i class="fas fa-plus"></i></span>
              </button>
              <!-- <button class="btn btn-primary btn-sm align-items-center" id="createJobBtn">
                <span class="d-none d-sm-inline">Auto Generate Job</span>
                <span class="d-inline d-sm-none"><i class="fas fa-plus"></i> Auto</span>
              </button> -->
            </div>
            <div class="col-auto">
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

  <div class="modal fade" id="addJobModal" tabindex="-1" aria-labelledby="addJobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addJobModalLabel">Add New Job</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Add Job Form -->
          <form id="addJobForm">
            <div class="row mb-3">
              <div class="col">
                <label for="add_name" class="form-label">Good Name</label>
                <input type="text" class="form-control" id="add_name" placeholder="Enter Good Name">
              </div>
              <div class="col">
                <label for="add_quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="add_quantity" placeholder="Enter Qty">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="add_weight" class="form-label">Weight in kg</label>
                <input type="number" class="form-control" id="add_weight" placeholder="Enter Weight">
              </div>
              <div class="col">
                <label for="add_size" class="form-label">Size in m</label>
                <input type="number" class="form-control" id="add_size" placeholder="Enter Size">
              </div>
              <div>
                <small style="color: red">CargoHub only transports under 45000kg and 10 meters loaded parcel!</small>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="add_start_date" class="form-label">Start Date</label>
                <input type="text" class="form-control" id="add_start_date" placeholder="Enter start date">
              </div>
              <div class="col">
                <label for="add_due_date" class="form-label">Due Date</label>
                <input type="text" class="form-control" id="add_due_date" placeholder="Enter due date">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="add_from_site" class="form-label">From Site</label>
                <select class="form-select" aria-label="From Site" id="add_from_site">
                </select>
              </div>
              <div class="col">
                <label for="add_to_site" class="form-label">To Site</label>
                <select class="form-select" aria-label="To Site" id="add_to_site">
                </select>
              </div>
              <div class="site_error"></div>
            </div>
            <div class="mb-3">
              <label class="form-label">Classification of Good</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="add_types_of_good" id="add_hazardous" checked value="Hazardous">
                <label class="form-check-label" for="add_hazardous">
                  Hazardous
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="add_types_of_good" id="add_non_hazardous" value="Non-hazardous">
                <label class="form-check-label" for="add_non_hazardous">
                  Non-hazardous
                </label>
              </div>
            </div>
            <div class="mb-3">
              <label for="add_vehicle" class="form-label">Vehicle Type</label>
              <select class="form-select" aria-label="Vehicle Type" id="add_vehicle">
              </select>
            </div>
            <div class="mb-3">
              <div id="add_result" class="text-center"></div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="addJobBtn">Add Job</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for Confirming Deletion -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this job?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for Editing Job -->
  <div class="modal fade" id="editJobModal" tabindex="-1" aria-labelledby="editJobModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editJobModalLabel">Edit Job</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Edit Job Form -->
          <form id="editJobForm">
            <div class="row mb-3">
              <div class="col">
                <label for="edit_good_id" class="form-label">Good ID</label>
                <input type="number" class="form-control" id="edit_good_id" placeholder="Enter Good ID" disabled>
              </div>
              <div class="col">
                <label for="edit_name" class="form-label">Good Name</label>
                <input type="text" class="form-control" id="edit_name" placeholder="Enter Good Name">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="edit_weight" class="form-label">Weight in kg</label>
                <input type="number" class="form-control" id="edit_weight" placeholder="Enter Weight">
              </div>
              <div class="col">
                <label for="edit_size" class="form-label">Size in m</label>
                <input type="number" class="form-control" id="edit_size" placeholder="Enter Size">
              </div>
              <div class="col">
                <label for="edit_quantity" class="form-label">Qty</label>
                <input type="number" class="form-control" id="edit_quantity" placeholder="Enter quantity">
              </div>
              <div>
                <small style="color: red">CargoHub only transports under 45000kg and 10 meters loaded parcel!</small>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col">
                <label for="edit_start_date" class="form-label">Start Date:</label>
                <input type="text" class="form-control" id="edit_start_date">
              </div>
              <div class="col">
                <label for="edit_due_date" class="form-label">Due Date</label>
                <input type="text" class="form-control" id="edit_due_date">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="edit_from_site" class="form-label">From Site</label>
                <select class="form-select" aria-label="From Site ID" id="edit_from_site">
                </select>
              </div>
              <div class="col">
                <label for="edit_to_site" class="form-label">To Site</label>
                <select class="form-select" aria-label="To Site ID" id="edit_to_site">
                </select>
              </div>
              <div class="site_error"></div>
            </div>
            <div class="mb-3">
              <label class="form-label">Classification of Good</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="edit_types_of_good" id="edit_hazardous" checked value="Hazardous">
                <label class="form-check-label" for="edit_hazardous">
                  Hazardous
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="edit_types_of_good" id="edit_non_hazardous" value="Non-hazardous">
                <label class="form-check-label" for="edit_non_hazardous">
                  Non-hazardous
                </label>
              </div>
            </div>
            <div class="mb-3">
              <div id="jobVehicle"></div>
              <label for="edit_vehicle" class="form-label">Vehicle Type</label>
              <select class="form-select" aria-label="Vehicle Type" id="edit_vehicle">
              </select>
            </div>
            <div class="mb-3">
              <div id="edit_result"></div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="saveChangesBtn">Save Changes</button>
        </div>
      </div>
    </div>
  </div>


  <script>
    $(document).ready(function() {

      function fetchJobs() {
        $.ajax({
          method: "GET",
          url: "API/list_jobs_API.php",
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
                                <th>Action</th>
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
                                <td>
                                  ${value.status === 'Outstanding' ? '<button class="btn btn-primary btn-sm change-status" data-job-id="' + value.job_id + '">Mark as Delivered</button>' : value.status}
                                </td>
                                <td>
                                    <button type='button' class='btn btn-primary rounded-start-1 btn-sm bg-gradient edit_job' data-id='${value.job_id}' data-name='${value.good_name}' data-weight='${value.weight}' data-size='${value.size}' data-quantity='${value.quantity}' data-from-site='${value.from_site}' data-to-site='${value.to_site}' data-from-date='${value.from_date}' data-to-date='${value.due_date}' data-vehicle-id='${value.vehicle_id}' data-status='${value.status}' data-classification='${value.classification}'><i class="fas fa-pen"></i></button>
                                    <button type='button' class='btn btn-danger rounded-end-1 btn-sm bg-gradient delete_job' data-id='${value.job_id}'><i class="fas fa-trash"></i></button>

                                </td>
                            </tr>`;
          });

          result += "</tbody></table>";

          $('#listJobs').html(result);
          $('#myJobDataTable').DataTable({
            fixedHeader: true,
            responsive: true,
          });
        });


        $("#add_start_date, #edit_start_date").datepicker({
          minDate: 0
        });
        $("#add_due_date, #edit_due_date").datepicker({
          minDate: "+1D"
        });
      }

      fetchJobs();

      //job_status btn
      $(document).on('click', '.change-status', function() {
        var jobId = $(this).data('job-id');

        $.ajax({
          method: "POST",
          url: "API/update_job_status.php",
          data: {
            jobId: jobId
          },
          dataType: "json"
        }).done(function(response) {
          if (response.success) {
            alert("Job has successfully delivered!")
            fetchJobs();
          } else {
            alert(response.message);
          }
        }).fail(function(jqXHR, textStatus, errorThrown) {
          console.error("Error:", textStatus, errorThrown);
          alert("Error occurred while updating job status. Please try again.");
        });
      });

      //dynamic siteName select box
      function populateSelectBoxes() {
        $.ajax({
            method: "GET",
            url: "API/sites_API.php",
            dataType: "JSON"
          })
          .done(function(data) {
            var option = '<option selected disabled>Select Site</option>';
            $.each(data, function(key, value) {
              option += '<option>' + value.name + '</option>';
            });
            $('#add_from_site, #edit_from_site').html(option);
            $('#add_to_site, #edit_to_site').html(option);
          })
      }

      populateSelectBoxes();

      $('#add_weight, #add_size, #add_from_site').change(function() {
        var weight = $('#add_weight').val();
        var size = $('#add_size').val();
        var from_site = $('#add_from_site').val();

        if (weight) {
          $.ajax({
              method: 'POST',
              url: 'API/vehicle_type_API.php',
              data: {
                weight: weight,
                size: size,
                from_site: from_site
              },
              dataType: 'json'
            })
            .done(function(data) {

              var result = '<option selected disabled>Select Vehicle Type</option>';
              if (data.length > 0) {
                $.each(data, function(key, value) {
                  result += "<option>" + value.type + "</option>";
                });
                $('#add_result').text('').css('color', ''); // Clear error message
              } else {
                result += "<option>No suitable vehicle type found</option>";
                $('#add_result').text('Please input valid weight so that suitable vehicle type will display!').css('color', 'red');
              }
              $('#add_vehicle').html(result);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
              console.error("Error:", textStatus, errorThrown);
              $('#add_result').text('Error occurred while fetching vehicle types. Please try again.').css('color', 'red');
              $('#add_vehicle').html('<option selected disabled>Error</option>');
            });
        }
      });

      function validateSiteSelection(homeSite, toSite) {
        if (homeSite === toSite) {
          $('.site_error').text('Home site and to site cannot be the same').css('color', 'red');
          return false;
        } else {
          $('.site_error').text('').css('color', ''); // Clear error message
          return true;
        }
      }
      $('#add_to_site').change(function() {
        validateSiteSelection($('#add_from_site').val(), $('#add_to_site').val());
      });

      $('#edit_to_site').change(function() {
        validateSiteSelection($('#edit_from_site').val(), $('#edit_to_site').val());
      });


      // Function to handle weight change for edit modal
      $('#edit_weight, #edit_size, #edit_from_site').change(function() {
        var weight = $('#edit_weight').val();
        var size = $('#edit_size').val();
        var from_site = $('#edit_from_site').val();

        if (weight) {
          $.ajax({
              method: 'POST',
              url: 'API/vehicle_type_API.php',
              data: {
                weight: weight,
                size: size,
                from_site: from_site
              },
              dataType: 'json'
            })
            .done(function(data) {

              var result = '<option selected disabled>Select Vehicle Type</option>';
              if (data.length > 0) {
                $.each(data, function(key, value) {
                  result += "<option value='" + value.vehicle_id + "'>" + value.type + "</option>";
                });
                $('#edit_result').text('').css('color', ''); // Clear error message
              } else {
                result += "<option>No suitable vehicle type found</option>";
                $('#edit_result').text('Please input valid weight so that suitable vehicle type will display!').css('color', 'red');
              }
              $('#edit_vehicle').html(result);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
              console.error("Error:", textStatus, errorThrown);
              $('#edit_result').text('Error occurred while fetching vehicle types. Please try again.').css('color', 'red');
              $('#edit_vehicle').html('<option selected disabled>Error</option>');
            });
        }
      });

      $(document).on('click', '.edit_job', function() {
        var jobId = $(this).data('id');

        $('#edit_good_id').val(jobId);
        $('#edit_name').val($(this).data('name'));
        $('#edit_weight').val($(this).data('weight'));
        $('#edit_size').val($(this).data('size'));
        $('#edit_quantity').val($(this).data('quantity'));
        $('#edit_start_date').val($(this).data('from-date'));
        $('#edit_due_date').val($(this).data('to-date'));
        $('#edit_from_site').val($(this).data('from-site'));
        $('#edit_to_site').val($(this).data('to-site'));
        $('input[name="edit_types_of_good"][value="' + $(this).data('classification') + '"]').prop('checked', true);

        // Fetch suitable vehicle types based on weight and from site
        fetchSuitableVehicleTypes($(this).data('weight'), $(this).data('size'), $(this).data('from-site'), $(this).data('id'));

        // Open edit job modal
        $('#editJobModal').modal('show');
      });


      function fetchSuitableVehicleTypes(weight, size, from_site, jobId) {
        $.ajax({
            method: 'POST',
            url: 'API/vehicle_type_API.php',
            data: {
              weight: weight,
              size: size,
              from_site: from_site
            },
            dataType: 'json'
          })
          .done(function(data) {

            var result = '<option selected disabled>Select Vehicle Type</option>';
            if (data.length > 0) {
              $.each(data, function(key, value) {
                result += "<option value='" + value.vehicle_id + "'>" + value.type + "</option>";
              });
              $('#edit_result').text('').css('color', ''); // Clear error message
            } else {
              result += "<option>No suitable vehicle type found</option>";
              $('#edit_result').text('Please input valid weight so that suitable vehicle type will display!').css('color', 'red');
            }
            $('#edit_vehicle').html(result);

            // Fetch job data
            $.ajax({
              method: 'POST',
              url: './API/list_jobs_API.php',
              data: {
                jobId: jobId
              },
              dataType: 'json'
            }).done(function(data) {
              var jobVehicle = data[0]['vehicle_id'];
              console.log(jobVehicle);
              $('#edit_vehicle').children().each(function(key, option) {
                console.log(option.value);
                if (jobVehicle == option.value) {
                  console.log('find one');
                  $('#edit_vehicle').val(option.value);
                }
              });
            })
          })
          .fail(function(jqXHR, textStatus, errorThrown) {
            console.error("Error:", textStatus, errorThrown);
            $('#edit_result').text('Error occurred while fetching vehicle types. Please try again.').css('color', 'red');
            $('#edit_vehicle').html('<option selected disabled>Error</option>');
          });
      }

      $('#saveChangesBtn').click(function() {
        var jobId = $('#edit_good_id').val();
        var jobName = $('#edit_name').val();
        var jobWeight = $('#edit_weight').val();
        var jobQty = $('#edit_quantity').val();
        var jobSize = $('#edit_size').val();

        var dateEdit = $('#edit_start_date').datepicker('getDate');
        var jobFromDate = $.datepicker.formatDate('yy-mm-dd', dateEdit);

        var dateEdit1 = $('#edit_due_date').datepicker('getDate');
        var jobToDate = $.datepicker.formatDate('yy-mm-dd', dateEdit1);

        var jobFromSite = $('#edit_from_site').val();
        var jobToSite = $('#edit_to_site').val();
        var jobVehicle = $('#edit_vehicle').val();
        var jobStatus = $('#edit_status').val();
        var jobClassification = $('input[name="edit_types_of_good"]:checked').val();

        // Send AJAX request to update job data
        $.ajax({
          method: "POST",
          url: "API/update_job_API.php",
          data: {
            jobId: jobId,
            jobName: jobName,
            jobWeight: jobWeight,
            jobSize: jobSize,
            jobQty: jobQty,
            jobFromDate: jobFromDate,
            jobToDate: jobToDate,
            jobFromSite: jobFromSite,
            jobToSite: jobToSite,
            jobStatus: jobStatus,
            jobClassification: jobClassification,
            jobVehicle: jobVehicle
          },
          dataType: "json",
          success: function(response) {
            if (response.success) {
              alert(response.message);
              $('#editJobModal').modal('hide');
              fetchJobs(); // Call the function to update job list
            } else {
              console.error(response.message);
            }
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
      });

      // Delete job function
      $(document).on('click', '.delete_job', function() {
        var jobId = $(this).data('id');
        $('#confirmDeleteBtn').attr('data-id', jobId);
        $('#deleteModal').modal('show');
      });

      $('#confirmDeleteBtn').click(function() {
        var jobId = $(this).data('id');
        console.log(jobId);
        $.ajax({
          method: "POST",
          url: "API/delete_job_API.php",
          data: {
            jobId: jobId
          },
          dataType: "json",
          success: function(response) {
            if (response.success) {
              console.log(response.message);
              fetchJobs();
              window.location.reload();
            } else {
              console.error(response.message);
            }
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
      });


      // Function to validate the add job form
      function validateAddJobForm() {
        var valid = true;

        // Check if any field is empty
        $('#addJobForm input, #addJobForm select').each(function() {
          if (!$(this).val()) {
            valid = false;
            return false;
          }
        });

        // Display error message if any field is empty
        if (!valid) {
          $('#add_result').text('All fields are required').css('color', 'red');
        } else {
          $('#add_result').text('').css('color', ''); // Clear error message
        }

        return valid;
      }
      // Handle form submission for adding new job
      $('#addJobBtn').click(function() {

        if (validateAddJobForm()) {
          var goodName = $('#add_name').val();
          var quantity = $('#add_quantity').val();
          var weight = $('#add_weight').val();
          var size = $('#add_size').val();
          var quantity = $('#add_quantity').val();

          var date = $('#add_start_date').datepicker('getDate');
          var startDate = $.datepicker.formatDate('yy-mm-dd', date);

          var date1 = $('#add_due_date').datepicker('getDate');
          var dueDate = $.datepicker.formatDate('yy-mm-dd', date);

          var fromSite = $('#add_from_site').val();
          var toSite = $('#add_to_site').val();
          var classification = $('input[name="add_types_of_good"]:checked').val();
          var vehicleType = $('#add_vehicle').val();

          // Send AJAX request to add new job
          $.ajax({
            method: "POST",
            url: "API/add_job_API.php",
            data: {

              goodName: goodName,
              weight: weight,
              size: size,
              quantity: quantity,
              startDate: startDate,
              dueDate: dueDate,
              fromSite: fromSite,
              toSite: toSite,
              classification: classification,
              vehicleType: vehicleType
            },
            dataType: "json"
          }).done(function(response) {
            if (response.includes('Create job successfully')) {
              alert('Create job successfully!');
              fetchJobs(); // Call the function to update job list
              window.location.reload(true);
            } else {
              console.error(response.message);
            }
          })
        }
      });

      /*
        $('#createJobBtn').click(function() {
        // Define the function to create a job
        function createJob() {
          var names = ['Product A', 'Product B', 'Product C', 'Product D', 'Product E', 'Product F', 'Product G', 'Product H', 'Product I', 'Product J'];
          var randomName = names[Math.floor(Math.random() * names.length)];

          var weight = Math.floor(Math.random() * (7500 - 1 + 1)) + 1;

          var size = Math.floor(Math.random() * 4) + 1;

          var quantity = Math.floor(Math.random() * 10) + 1;

          var date1 = new Date();
          var startDate = date1.toISOString().slice(0, 10);

          function formatDate(date) {
            var year = date.getFullYear();
            var month = (date.getMonth() + 1).toString().padStart(2, '0');
            var day = date.getDate().toString().padStart(2, '0');
            return `${year}-${month}-${day}`;
          }

          function getRandomDate(startDate, endDate) {
            return new Date(startDate.getTime() + Math.random() * (endDate.getTime() - startDate.getTime()));
          }

          var today = new Date();
          var endOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);

          var randomDate = getRandomDate(today, endOfMonth);
          var endDate = formatDate(randomDate);

          var sites = ['Express Logistics', 'Prime Center', 'Rapid Cargo', 'Swift Solutions', 'Speedy Transport'];
          var randomFromSite = sites[Math.floor(Math.random() * sites.length)];

          var randomToSite;
          do {
            randomToSite = sites[Math.floor(Math.random() * sites.length)];
          } while (randomToSite === randomFromSite);

          var classification = ['Hazardous', 'Non-hazardous'][Math.floor(Math.random() * 2)];

          var types = ['Box Truck', 'Container Truck', 'HGV', 'Luton Van', 'Parcel Delivery Van'];
          var randomType = types[Math.floor(Math.random() * types.length)];

          // Make the AJAX request to add the job
          $.ajax({
              method: 'POST',
              url: 'API/add_job_API.php',
              data: {
                goodName: randomName,
                weight: weight,
                size: size,
                quantity: quantity,
                startDate: startDate,
                dueDate: endDate,
                fromSite: randomFromSite,
                toSite: randomToSite,
                classification: classification,
                vehicleType: randomType
              },
              dataType: 'JSON'
            })
            .done(function(response) {
              if (response.includes('Create job successfully')) {
                console.log('Job created successfully');
                successfulInsertions++;
                if (successfulInsertions === totalJobs) {
                  alert("All jobs added: " + successfulInsertions);
                  window.location.reload(true);
                } else {
                  setTimeout(createJob, 1000); // Adjust the delay time for 1 s
                }
              } else {
                console.error(response.message);
              }
            });
        }

        var totalJobs = 2;
        var successfulInsertions = 0;

        // Start creating the jobs
        for (var i = 0; i < totalJobs; i++) {
          createJob();
        }
      });
*/

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