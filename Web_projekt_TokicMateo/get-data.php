<?php
    $con = mysqli_connect('localhost', 'root', '', 'booking_db');

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    $query = "SELECT * FROM moji_proizvodi LIMIT 3";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo "Error executing query: " . mysqli_error($con);
        exit();
    }

    $data = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($data);

    mysqli_close($con);
?>
