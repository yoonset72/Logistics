<?php
require_once 'db_info.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["siteId"]) && isset($_POST["siteName"]) && isset($_POST["siteAddress"])) {

        $siteId = htmlspecialchars($_POST["siteId"]);
        $siteName = htmlspecialchars($_POST["siteName"]);
        $siteAddress = htmlspecialchars($_POST["siteAddress"]);

        $stmt = $conn->prepare("UPDATE site SET name = ?, address = ? WHERE site_id = ?");
        $stmt->bind_param("ssi", $siteName, $siteAddress, $siteId);
        if ($stmt->execute()) {
            echo json_encode(array("success" => true, "message" => "Site information updated successfully."));
            exit;
        } else {
            echo json_encode(array("success" => false, "message" => "Failed to update site information."));
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
