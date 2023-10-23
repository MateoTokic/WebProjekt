<?php
// Uspostavljamo vezu s bazom podataka
$con = mysqli_connect('localhost', 'root', '', 'booking_db');

// Provjeravamo je li veza uspješno uspostavljena
if (mysqli_connect_errno()) {
    echo json_encode(array('success' => false, 'error' => 'Failed to connect to MySQL: ' . mysqli_connect_error()));
    exit();
}

// Podaci koje ste dobili iz forme
$name = $_POST['name'];
$email = $_POST['email'];
$text = $_POST['comment'];
$stars = $_POST['stars'];

// Pripremamo SQL upit za unos podataka
$query = "INSERT INTO reviews (name, email, text, stars) VALUES ('$name', '$email', '$text', $stars)";

// Izvršavamo upit
if (mysqli_query($con, $query)) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false, 'error' => 'Error executing query: ' . mysqli_error($con)));
}

// Zatvaramo vezu s bazom podataka
mysqli_close($con);
?>
