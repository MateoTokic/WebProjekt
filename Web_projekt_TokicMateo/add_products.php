<?php
include 'db.php';

session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // If the user is not logged in, redirect them to admin.php
    header("Location: admin.php");
    exit;
}

if(isset($_GET['logout']) && $_GET['logout'] === 'true') {
    // Obrišite sesiju i kolačić za prijavu
    session_unset();
    session_destroy();
    setcookie('admin_login', '', time() - 3600, "/");
  
    // Preusmjerite na login stranicu
    header("Location: home.php");
    exit;
  }



if (isset($_GET['update'])) {
    $productId = $_GET['update'];

    $query = "SELECT * FROM moji_proizvodi WHERE id = '$productId'";
    $result = mysqli_query($con, $query);
    $product = mysqli_fetch_assoc($result);
}

if (isset($_GET['delete'])) {
    $productId = $_GET['delete'];

    $query = "DELETE FROM moji_proizvodi WHERE id = '$productId'";
    mysqli_query($con, $query);
    echo "Destination deleted.";
}

$query = "SELECT * FROM moji_proizvodi";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Proizvodi</title>
    <style>
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

.dashboard-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

h2 {
  text-align: center;
}

.product-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  grid-gap: 20px;
  margin-top: 60px;
  margin-bottom: 60px;
}

.product {
  border: 1px solid #ccc;
  padding: 20px;
  text-align: center;
}

.product img {
  width: 100%;
  max-height: 200px;
  object-fit: cover;
}

.btn-update {
  display: block;
  margin-top: 10px;
  text-decoration: none;
  background-color: #8e44ad;
  color: #fff;
  padding: 8px 16px;
  border-radius: 4px;
}

.btn-update:hover{
  background-color: #4c056a;
}



.add-product-btn {
  display: inline-block;
  text-decoration: none;
  background-color: #8e44ad;
  color: #fff;
  padding: 12px 24px;
  border-radius: 4px;
  cursor: pointer;
  position: fixed;
  bottom: 20px; /* Adjust as needed */
  left: 50%;
  transform: translateX(-50%);
}


.add-product-btn:hover{
  background-color: #4c056a;
}

.flex-btn{
    display: flex;

}

.add {
    transform: translateX(-50%);
    left: 50%;
    align-items: flex-end;
    margin-top: 10px;
    position: fixed;
    background-color: #8e44ad;
    color: #fff;
    border-radius: 4px;
    padding: 12px 24px;
    text-decoration: none;
}
.add:hover{
  background-color: #4c056a;
}



.logout-button{
    
    position: fixed;
    background-color: #b70707;
    color: #fff;
    border-radius: 4px;
    padding: 12px 24px;
    text-decoration: none;
}

.logout-button:hover{
  background-color: #d40012;
}



.product button {
    display: block;
    margin-top: 10px;
    text-decoration: none;
    background-color: #8e44ad;
    color: #fff;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
  }
  
  .product button:hover {
    background-color: #4c056a;
  }
  
  .product .modify-button {
    background-color: #8e44ad;
    color: #fff;
  }
  
  .product .modify-button:hover {
    background-color: #4c056a;
    color: #fff;
  }
  
  .product .delete-button {
    background-color: #b70707;
    color: #fff;
  }
  
  .product .delete-button:hover {
    background-color: #d40012;
    color: #fff;
  }
  








    </style>
</head>
<body>
    <div class="flex-btn">
    <a href="home.php" class="add">Go back</a>
    <a href="add_products.php?logout=true" class="logout-button">Logout</a>
    </div>
    
    <div class="dashboard-container">
        <div class="product-container">
            
        </div>

        <a href="product.php" class="add-product-btn">Add destination</a>
       
    </div>


    <script>
document.addEventListener('DOMContentLoaded', function() {
    var productsContainer = document.querySelector('.product-container');

    // Function to fetch products
    function getProducts() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get-products.php', true);

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 400) {
                var response = JSON.parse(xhr.responseText);

                if (response.success) {
                    var products = response.products;

                    productsContainer.innerHTML = '';
                    products.forEach(function(product) {
                        var productDiv = document.createElement('div');
                        productDiv.classList.add('product');

                        var img = document.createElement('img');
                        img.src = product.image;
                        img.alt = product.name;

                        var h3 = document.createElement('h3');
                        h3.textContent = product.name;

                        var priceP = document.createElement('p');
                        priceP.textContent = 'Price: $' + product.price;

                        var dateP = document.createElement('p');
                        dateP.textContent = 'Available until: ' + product.date;

                        var deleteButton = document.createElement('button');
                        deleteButton.textContent = 'Delete';
                        deleteButton.classList.add('delete-button');
                        deleteButton.addEventListener('click', function() {
                            deleteProduct(product.id);
                        });
                        var modifyButton = document.createElement('button');
                        modifyButton.textContent = 'Modify';
                        modifyButton.classList.add('modify-button');
                        modifyButton.addEventListener('click', function() {
                            var newName = prompt('Enter new name:');
                            var newPrice = prompt('Enter new price:');
                            var newDate = prompt('Enter new date (YYYY-MM-DD):');

                            if (newName && newPrice && newDate) {
                                modifyProduct(product.id, newName, newPrice, newDate);
                            } else {
                                alert('Invalid input. Please try again.');
                            }
                        });

                        productDiv.appendChild(img);
                        productDiv.appendChild(h3);
                        productDiv.appendChild(priceP);
                        productDiv.appendChild(dateP);
                        productDiv.appendChild(deleteButton);
                        productDiv.appendChild(modifyButton);
                        

                        productsContainer.appendChild(productDiv);
                    });
                } else {
                    productsContainer.innerHTML = '<p>' + response.message + '</p>';
                }
            } else {
                console.error('Error fetching data. Status:', xhr.status);
            }
        };

        xhr.onerror = function() {
            console.error('Network error');
        };

        xhr.send();
    }

    // Function to delete a product
    function deleteProduct(productId) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete-products.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 400) {
                var response = JSON.parse(xhr.responseText);

                if (response.success) {
                    alert(response.message);
                    getProducts();
                } else {
                    alert(response.message);
                }
            } else {
                console.error('Error deleting product. Status:', xhr.status);
            }
        };

        xhr.onerror = function() {
            console.error('Network error');
        };

        xhr.send('id=' + productId);
    }

    function modifyProduct(productId, newName, newPrice, newDate) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'modify-product.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 400) {
            var response = JSON.parse(xhr.responseText);

            if (response.success) {
                alert(response.message);
                getProducts();
            } else {
                alert(response.message);
            }
        } else {
            console.error('Error modifying product. Status:', xhr.status);
        }
    };

    xhr.onerror = function() {
        console.error('Network error');
    };

    xhr.send('id=' + productId + '&name=' + newName + '&price=' + newPrice + '&date=' + newDate);
}

    // Initial fetch of products
    getProducts();
});


    </script>
</body>
</html>
