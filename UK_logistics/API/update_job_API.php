<?php
require_once 'db_info.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["jobId"]) && isset($_POST["jobName"]) && isset($_POST["jobWeight"]) && isset($_POST["jobSize"]) && isset($_POST["jobQty"]) && isset($_POST["jobFromDate"]) && isset($_POST["jobToDate"]) && isset($_POST["jobFromSite"]) && isset($_POST["jobToSite"])  && isset($_POST["jobClassification"]) && isset($_POST["jobVehicle"])) {

        $jobId = htmlspecialchars($_POST["jobId"]);
        $jobName = htmlspecialchars($_POST["jobName"]);
        $jobWeight = htmlspecialchars($_POST["jobWeight"]);
        $jobSize = htmlspecialchars($_POST["jobSize"]);
        $jobQty = htmlspecialchars($_POST['jobQty']);
        $jobFromDate = htmlspecialchars($_POST["jobFromDate"]);
        $jobToDate = htmlspecialchars($_POST["jobToDate"]);
        $jobFromSite = htmlspecialchars($_POST["jobFromSite"]);
        $jobToSite = htmlspecialchars($_POST["jobToSite"]);
        $jobClassification = htmlspecialchars($_POST["jobClassification"]);
        $jobVehicle = htmlspecialchars($_POST["jobVehicle"]);

//         $stmt = $conn->prepare("SELECT vehicle_id FROM vehicle WHERE type = ? AND home_site = ?");
// $stmt->bind_param("ss", $jobVehicle, $jobFromSite);
// $stmt->execute();
// $stmt->store_result();

// if ($stmt->num_rows > 0) {
//     $stmt->bind_result($jobVehicleId);
//     $stmt->fetch();
// } else {
//     echo json_encode(array("success" => false, "message" => "No matching vehicle found."));
//     exit;
// }

        // Update the job information with the retrieved vehicle_id
        $stmt = $conn->prepare("UPDATE job SET good_name = ?, weight = ?, size = ?, quantity = ?,  from_site = ?, to_site =?, from_date = ?, due_date = ?, classification = ?, vehicle_id = ? WHERE job_id = ?");
        $stmt->bind_param("siiisssssii", $jobName, $jobWeight, $jobSize, $jobQty, $jobFromSite, $jobToSite, $jobFromDate, $jobToDate, $jobClassification, $jobVehicle, $jobId);
        if ($stmt->execute()) {
            echo json_encode(array("success" => true, "message" => "Job information updated successfully."));
            exit;
        } else {
            echo json_encode(array("success" => false, "message" => "Failed to update job information."));
            exit;
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Missing required parameters."));
        exit;
    }
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
    exit;
}
?>