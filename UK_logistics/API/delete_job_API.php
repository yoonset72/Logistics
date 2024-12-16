<?php
require_once 'db_info.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["jobId"])) {
        $jobId = $_POST["jobId"];

        $stmt = $conn->prepare("DELETE FROM job WHERE job_id = ?");
        $stmt->bind_param("i", $jobId);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(array("success" => true, "message" => "Site deleted successfully."));
            } else {
                echo json_encode(array("success" => false, "message" => "No site found with the provided ID."));
            }
        } else {
            
            echo json_encode(array("success" => false, "message" => "Failed to execute SQL statement: " . $stmt->error));
        }

        $stmt->close();
    } else {
        echo json_encode(array("success" => false, "message" => "Missing siteId parameter."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Invalid request method."));
}
?>