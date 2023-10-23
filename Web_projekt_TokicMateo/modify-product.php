<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['id'];
    $newName = $_POST['name'];
    $newPrice = $_POST['price'];
    $newDate = $_POST['date'];

    $query = "UPDATE moji_proizvodi SET name='$newName', price='$newPrice', date='$newDate' WHERE id='$productId'";

    if (mysqli_query($con, $query)) {
        echo json_encode(['success' => true, 'message' => 'Product modified successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error modifying product.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

mysqli_close($con);
?>
