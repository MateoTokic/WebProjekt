<?php
include 'db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ovdje biste trebali provjeriti je li korisničko ime i lozinka točni
    // Ako jesu, postavite $_SESSION['logged_in'] na true

    if ($username === 'korisnik' && $password === 'lozinka') {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;

        echo json_encode(['success' => true]);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Neuspješna prijava']);
        exit();
    }
};
?>
