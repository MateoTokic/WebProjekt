<?php
include 'db.php';


if (isset($_GET['id'])) {
    $productId = $_GET['id'];

   
    $query = "SELECT * FROM moji_proizvodi WHERE id = '$productId'";
    $result = mysqli_query($con, $query);
    $product = mysqli_fetch_assoc($result);
}


if (isset($_POST['update'])) {
   
    $newName = $_POST['name'];
    $newPrice = $_POST['price'];
    $newDate = $_POST['date'];
    

 
    $query = "UPDATE moji_proizvodi SET name='$newName', price='$newPrice', date='$newDate' WHERE id='$productId'";
    mysqli_query($con, $query);

    header('Location: add_products.php');
    exit();
}


if (isset($_POST['delete'])) {
  
    $query = "DELETE FROM moji_proizvodi WHERE id = '$productId'";
    mysqli_query($con, $query);

    
    header('Location: add_products.php');
    exit();
}
?>
<html>
     <head>
        <title>Update</title>
        <style>
         

body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
  margin: 0;
  padding: 20px;
}

h2 {
  margin-top: 0;
}

form {
  background-color: #ffffff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
input[type="number"] {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

button {
  margin-top: 10px;
  padding: 8px 16px;
  background-color: #8e44ad;
  color: #ffffff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #4c056a;
}

a {
  color: #8e44ad;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

        </style>

     </head>
        <body>
            
        </body>
</html>

<h2>Update destination</h2>

<form action="update.php?id=<?php echo $productId; ?>" method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo $product['name']; ?>" required>

    <label for="price">Price:</label>
    <input type="number" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>

    <label for="code">Date:</label>
    <input type="date" name="date" value="<?php echo $product['date']; ?>" required>

    <button type="submit" name="update"> Update destination</button>
    <button type="submit" name="delete">Delete destination</button>
</form>

<a href="add_products.php">Back to list</a>