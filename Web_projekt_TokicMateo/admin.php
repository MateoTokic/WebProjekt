<?php
session_start();

$adminEmail = 'mateo.tokic1@admin.com'; // Replace with the actual admin email

// Check if the user is already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    // If the user is already logged in and clicks logout, redirect them to admin.php
    if (isset($_GET['logout'])) {
        // Unset and destroy the session
        session_unset();
        session_destroy();

        // Redirect to admin.php after logging out
        header("Location: admin.php");
        exit;
    }

    // Redirect to add_products.php if the user is already logged in
    header("Location: add_products.php");
    exit;
}

if (isset($_GET['logout'])) {
    // Unset and destroy the session
    session_unset();
    session_destroy();

    // Redirect to admin.php after logging out
    header("Location: admin.php");
    exit;
}

// Check if the user submitted the login form
if (isset($_POST['email']) && isset($_POST['password'])) {
    // Pretpostavljamo da imate predefinirane podatke za administratora
    $adminPassword = 'Mateo2509';

    // Provjerite je li uneseni e-mail i lozinka ispravni
    if ($_POST['email'] === $adminEmail && $_POST['password'] === $adminPassword) {
        // Prijavite korisnika
        $_SESSION['admin_logged_in'] = true;

        // Postavite kolačić za automatsko prijavljivanje
        $cookieName = 'admin_login';
        $cookieValue = base64_encode($adminEmail);
        setcookie($cookieName, $cookieValue, time() + (86400 * 30), "/"); // Kolačić traje 30 dana

        // Preusmjerite korisnika na add_products.php
        header("Location: add_products.php");
        exit;
    } else {
        // Pogrešan e-mail ili lozinka, prikažite poruku o grešci
        $error = "Pogrešan e-mail ili lozinka";
    }
}

// Provjerite je li postavljen kolačić za automatsko prijavljivanje
if (isset($_COOKIE['admin_login'])) {
    // Dekodirajte kolačić i provjerite je li vrijednost ispravna
    $decodedValue = base64_decode($_COOKIE['admin_login']);
    if ($decodedValue === $adminEmail) {
        // Prijavite korisnika
        $_SESSION['admin_logged_in'] = true;

        // Preusmjerite korisnika na add_products.php
        header("Location: add_products.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if (isset($error)) : ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" required><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
