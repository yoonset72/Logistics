<?php
header('Content-Type: application/json');

ob_start();

if(isset($_POST['weight']) && isset($_POST['from_site']) && isset($_POST['size'])){
    require_once 'db_info.php';
    $weight = $_POST['weight'];
    $home_site = $_POST['from_site'];
    $size = $_POST['size'];
    
    
    $stmt = $conn->prepare("SELECT distinct vt.type, vehicle.vehicle_id FROM vehicle 
    INNER JOIN `vehicle type` vt ON vehicle.type = vt.type
    WHERE vt.max_space >= ? AND vt.max_weight >= ? AND vehicle.home_site = ?;");
    $stmt->bind_param('iis', $size, $weight, $home_site); 
    
    if (!$stmt->execute()) {
        die("Error in executing statement: " . $stmt->error);
    }
    
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $all_rows = $result->fetch_all(MYSQLI_ASSOC);
        $json_string = json_encode($all_rows, JSON_UNESCAPED_UNICODE);
        echo $json_string; 
    } else {
        // Return an empty array if no suitable vehicle types are found
        echo json_encode([]);
    }
}
ob_end_flush();
