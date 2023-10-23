<?php
include 'db2.php';

$query = "SELECT * FROM reviews";
$result = mysqli_query($con, $query);

if ($result) {
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Error fetching data']);
}

mysqli_close($con);
?>
