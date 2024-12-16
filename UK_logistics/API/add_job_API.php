<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["goodName"]) && isset($_POST["weight"]) && isset($_POST["size"]) && isset($_POST["quantity"]) && isset($_POST["startDate"]) && isset($_POST["dueDate"]) && isset($_POST["fromSite"]) && isset($_POST["toSite"])  && isset($_POST["classification"]) && isset($_POST["vehicleType"])) {
        require_once 'db_info.php';

        $name = htmlspecialchars($_POST['goodName']);
        $weight = htmlspecialchars($_POST['weight']);
        $size = htmlspecialchars($_POST['size']);
        $quantity = htmlspecialchars($_POST['quantity']);
        $start_date = htmlspecialchars($_POST['startDate']);
        $due_date = htmlspecialchars($_POST['dueDate']);
        $from_site = htmlspecialchars($_POST['fromSite']);
        $to_site = htmlspecialchars($_POST['toSite']);
        $vehicle = htmlspecialchars($_POST['vehicleType']);
        $classification = htmlspecialchars($_POST['classification']);
    
        $stmt = $conn->prepare("SELECT vehicle_id FROM vehicle WHERE type = ? AND home_site = ?");
        $stmt->bind_param("ss", $vehicle, $from_site);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($vehicle_id);
            $stmt->fetch();
        }
        
        $stmt->close();
        
        $status = 'Outstanding';
    
        $query = "INSERT INTO job(good_name, weight, size, quantity, from_site, to_site, from_date, due_date, vehicle_id, status, classification) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($query);
        $insert_stmt->bind_param("siiissssiss", $name, $weight, $size, $quantity, $from_site, $to_site, $start_date, $due_date, $vehicle_id, $status, $classification);
        $insert_stmt->execute();
       
        if($insert_stmt->affected_rows > 0) {
            echo json_encode("Create job successfully!");
        } else {
            echo json_encode("Error creating job!");
        }
        $insert_stmt->close();
        
        $conn->close();
    }
}
?>
