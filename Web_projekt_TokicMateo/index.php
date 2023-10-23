

<?php
session_start();

include("db.php"); // Include the database connection code

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_name = $_POST['user_name'];
    $user_lastname = $_POST['user_lastname'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($user_lastname) && !empty($password) && !is_numeric($user_name)) {

        // čitanje iz baze podataka
        $query = "SELECT * FROM users1 WHERE user_name = '$user_name' AND user_lastname = '$user_lastname' LIMIT 1";
        $result = izvrsiUpit(spojiSeNaBazu(), $query); // Use the spojiSeNaBazu function to establish a connection

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {

                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['password'] === $password) {

                    $_SESSION['user_id'] = $user_data['user_id'];
                    $_SESSION['user_name'] = $user_data['user_name'];
                    $_SESSION['user_lastname'] = $user_data['user_lastname'];

                    header("Location: home.php");
                    die;
                }
            }
        }

        echo "Pogrešno korisničko ime ili lozinka!";
    } else {
        echo "Molimo unesite ispravne informacije!";
    }
}


?>





<!DOCTYPE html>
<html>
<head>
    <title>Login</title>


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
            <p>LOGIN</p>

            <input id="text" type="text" name="user_name">first name<br><br>
            <input id="text" type="text" name="user_lastname">last name<br><br>
            <input id="text" type="password" name="password">password<br><br>

            <input id="button" type="submit" value="Login"><br><br>

            <a href="register.php">Resgister</a><br><br>
        </form>
    </div>
</body>
</html>