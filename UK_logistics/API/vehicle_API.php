<?php
require_once 'db_info.php';

$query = "SELECT v.vehicle_id, v.type, v.home_site, vh.max_weight, vh.max_space FROM vehicle v INNER JOIN `vehicle type` vh ON v.type = vh.type ORDER BY home_site";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $all_rows = [];
    while ($row = $result->fetch_assoc()) {
        $all_rows[] = $row;
    }
    $json_string = json_encode($all_rows, JSON_UNESCAPED_UNICODE);
    echo $json_string;
} else {
    echo json_encode("No results.");
}

$conn->close();
?>
