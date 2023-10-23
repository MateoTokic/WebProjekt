<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['id'];

    $query = "DELETE FROM moji_proizvodi WHERE id = '$productId'";
    if (mysqli_query($con, $query)) {
        echo json_encode(['success' => true, 'message' => 'Destination deleted.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting destination.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

mysqli_close($con);
?>
