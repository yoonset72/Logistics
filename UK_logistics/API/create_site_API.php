<?php
require_once 'db_info.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["name"]) && isset($_POST["address"])) {
        $siteName = htmlspecialchars($_POST['name']);
        $siteAddress = htmlspecialchars($_POST['address']);

        $query = "INSERT INTO site(name, address) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $siteName, $siteAddress);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(array("message" => "Create site successfully", "status" => "success"));
        } else {
            echo json_encode(array("message" => "Error creating site", "status" => "error"));
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(array("message" => "Missing parameters", "status" => "error"));
    }
} else {
    echo json_encode(array("message" => "Invalid request method", "status" => "error"));
}
?>
