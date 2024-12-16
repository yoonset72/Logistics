<?php
header('Content-Type: application/json');


    require_once 'db_info.php';

    $names = ['Product A', 'Product B', 'Product C', 'Product D', 'Product E', 'Product F', 'Product G', 'Product H', 'Product I', 'Product J'];
    $randomName = $names[array_rand($names)];

    $weight = rand(1, 7500);

    $size = rand(1, 4);

    $quantity = rand(1, 10);

    $startDate = date('Y-m-d');

    function formatDate($date) {
        return date('Y-m-d', strtotime($date));
    }

    function getRandomDate($startDate, $endDate) {
        $randomTimestamp = mt_rand(strtotime($startDate), strtotime($endDate));
        return date('Y-m-d', $randomTimestamp);
    }

    $today = date('Y-m-d');
    $endOfMonth = date('Y-m-d', strtotime('last day of this month'));

    $endDate = getRandomDate($today, $endOfMonth);

    $sites = ['Express Logistics', 'Prime Center', 'Rapid Cargo', 'Swift Solutions', 'Speedy Transport'];
    $randomFromSite = $sites[array_rand($sites)];

    do {
        $randomToSite = $sites[array_rand($sites)];
    } while ($randomToSite === $randomFromSite);

    $classification = ['Hazardous', 'Non-hazardous'][rand(0, 1)];

    $types = ['Box Truck', 'Container Truck', 'HGV', 'Luton Van', 'Parcel Delivery Van'];
    $randomType = $types[array_rand($types)];

    $stmt = $conn->prepare("SELECT vehicle_id FROM vehicle WHERE type = ? AND home_site = ?");
    $stmt->bind_param("ss", $randomType, $randomFromSite);
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
    $insert_stmt->bind_param("siiissssiss", $randomName, $weight, $size, $quantity, $randomFromSite, $randomToSite, $startDate, $endDate, $vehicle_id, $status, $classification);
    $insert_stmt->execute();

    if($insert_stmt->affected_rows > 0) {
        echo json_encode("Create job successfully!");
    } else {
        echo json_encode("Error creating job!");
    }
    $insert_stmt->close();

    $conn->close();

?>
