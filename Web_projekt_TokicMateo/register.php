<?php
session_start();

include("db.php");
include("functions.php");

// Establish a database connection
$connection = spojiSeNaBazu();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $user_name = $_POST['user_name'];
    $user_lastname = $_POST['user_lastname'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($user_lastname) && !empty($password) && !is_numeric($user_name)) {
        // Generate a random user_id
        $user_id = random_num(20)+1;

        // Create the SQL query with placeholders to prevent SQL injection
        $query = "INSERT INTO users1 (user_id, user_name, user_lastname, password) VALUES (?, ?, ?, ?)";

        // Prepare the statement
        $stmt = mysqli_prepare($connection, $query);

        if ($stmt) {
            // Bind parameters and execute the query
            mysqli_stmt_bind_param($stmt, "ssss", $user_id, $user_name, $user_lastname, $password);
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to the login page upon successful registration
                header("Location: index.php");
                die;
            } else {
               // echo "Error executing the query: " . mysqli_error($connection);
            }
        } else {
            echo "Error preparing the statement: " . mysqli_error($connection);
        }
    } else {
        echo "Please enter some valid information!";
    }
}

// Close the database connection when you're done
zatvoriVezuNaBazu($connection);
?>



<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>

    <style>
        #box {
    background-color: #f4f4f4;
    margin: auto;
    width: 300px;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
}

#text {
    height: 25px;
    border-radius: 5px;
    padding: 4px;
    border: solid thin #aaa;
    width: 100%;
    margin-bottom: 10px;
}

#button {
    padding: 10px;
    width: 100px;
    color: white;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#button:hover {
    background-color: #0056b3;
}

a {
    text-decoration: none;
    color: #007bff;
}

a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>

    

    <div id="box">
        
        <form method="post">
            <p>REGISTER</p>
            <input id="text" type="text" name="user_name">first name<br><br>
            <input id="text" type="text" name="user_lastname">last name<br><br>
            <input id="text" type="password" name="password">password<br><br>

            <input id="button" type="submit" value="Signup"><br><br>

            <a href="login1.php">Login</a><br><br>
        </form>
    </div>
</body>
</html>