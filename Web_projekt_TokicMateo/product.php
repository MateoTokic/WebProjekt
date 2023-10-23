<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $date = $_POST['date'];

    // Provjera postojanja slike i premještanje na odredište
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['tmp_name'];

        // Kreiraj putanju za spremanje slike
        $targetPath = 'images/' . basename($_FILES['image']['name']);

        // Premjesti sliku na odredišnu lokaciju
        if (move_uploaded_file($image, $targetPath)) {
            // Slika uspješno premještena, nastavi s unosom u bazu
            $query = "INSERT INTO moji_proizvodi (name, price, date, image) VALUES ('$name', '$price', '$date', '$targetPath')";
            mysqli_query($con, $query);
            echo "Destination is successfully added.";
        } else {
            echo "Greška pri premještanju slike.";
        }
    } else {
        echo "Image input error.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add destination</title>
    <style>

h2{
text-align: center;
}
form {
    max-width: 400px;
    margin: 0 auto;
}

label {
    display: block;
    margin-bottom: 10px;
}

input[type="text"],
input[type="number"],
input[type="file"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: #8e44ad;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #4c056a;
}

a{
    
    background-color: #8e44ad;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
a:hover{
    background-color: #4c056a;
}

form{
    background: rgba(177, 177, 177, 0.7);
    padding-left: 100px;
    padding-right: 100px;
    padding-top: 50px;
    padding-bottom: 50px;
    border-radius: 5em;
}
</style>

</head>

<body>
    <h2>Add new destination</h2>

    <form action="product.php" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" required>


        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required>

        <label for="date">Available until:</label>
        <input type="date" name="date" required>

        <label for="image">Image:</label>
        <input type="file" name="image" required>

        <button type="submit" name="submit">Submit</button>
    </form>

    <a href="add_products.php">Back to items</a>

</body>

</html>

