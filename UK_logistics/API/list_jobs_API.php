<?php
require_once 'db_info.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $query = "SELECT * FROM job";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $all_rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $json_string = json_encode($all_rows, JSON_UNESCAPED_UNICODE);
        echo $json_string;
    } else {
        echo json_encode("No results.");
    }
} else if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $jobId = $_POST['jobId'];
    $query = "SELECT * FROM job WHERE job_id = $jobId";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $all_rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $json_string = json_encode($all_rows, JSON_UNESCAPED_UNICODE);
        echo $json_string;
    } else {
        echo json_encode("No results.");
    }
}
$conn->close();
?>
