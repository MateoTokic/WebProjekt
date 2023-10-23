<?php
include 'db.php';

$query = "SELECT * FROM moji_proizvodi";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
    echo json_encode(['success' => true, 'products' => $products]);
} else {
    echo json_encode(['success' => false, 'message' => 'No available destinations.']);
}

mysqli_close($con);
?>
