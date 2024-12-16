<?php
require_once 'db_info.php';

$query = "SELECT * FROM site";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    $all_rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $json_string = json_encode($all_rows, JSON_UNESCAPED_UNICODE);
    echo $json_string;
} else {
    echo json_encode("No results.");
}
$conn->close();
?>
