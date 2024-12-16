<?php
require_once 'db_info.php';

if (isset($_POST['jobId'])) {
    $jobId = $_POST['jobId'];

    $sql = "UPDATE job SET status = 'Completed' WHERE job_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $jobId);

    if ($stmt->execute()) {
        $response = array("success" => true, "message" => "Job status updated successfully.");
        echo json_encode($response);
    } else {
        $response = array("success" => false, "message" => "Failed to update job status.");
        echo json_encode($response);
    }

    $stmt->close();
} else {
    $response = array("success" => false, "message" => "Missing jobId parameter.");
    echo json_encode($response);
}

$conn->close();
?>
