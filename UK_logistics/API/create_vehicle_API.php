<?php
require_once 'db_info.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["vehicleType"]) && isset($_POST["vehicleHomeSite"])) {
        require_once 'db_info.php'; 

    $vehicle_type = htmlspecialchars($_POST['vehicleType']);
    $vehicle_home_site = htmlspecialchars($_POST['vehicleHomeSite']);

        $query = "INSERT INTO vehicle(type, home_site) VALUES ( ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $vehicle_type, $vehicle_home_site);
        $stmt->execute();
       
        if($stmt->affected_rows > 0) {
            echo json_encode(array("message" => "Create site successfully", "status" => "success"));
        } else {
            echo json_encode(array("message" => "Error creating site", "status" => "error"));
        }
        $stmt->close();
        
        $conn->close();

    }
}

