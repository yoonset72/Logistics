<?php
    require_once 'db_info.php';
    $stmt = $conn->prepare("SELECT name FROM site");
    $stmt->execute();
    $sites = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    echo json_encode($sites);
?>
