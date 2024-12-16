<?php
require_once 'db_info.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["vehicleId"]) && isset($_POST["vehicleType"]) && isset($_POST["vehicleHomeSite"])) {

        $vehicle_id = htmlspecialchars($_POST["vehicleId"]);
        $vehicle_type = htmlspecialchars($_POST["vehicleType"]);
        $vehicle_home_site = htmlspecialchars($_POST["vehicleHomeSite"]);

        $stmt = $conn->prepare("UPDATE vehicle SET type = ?, home_site = ? WHERE vehicle_id = ?");
        $stmt->bind_param("ssi", $vehicle_type, $vehicle_home_site, $vehicle_id);
        if ($stmt->execute()) {
            echo json_encode(array("success" => true, "message" => "Vehicle information updated successfully."));
            exit;
        } else {
            echo json_encode(array("success" => false, "message" => "Failed to update vehicle information."));
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
