<?php
include 'db.php';



$query = "SELECT * FROM moji_proizvodi";
$result = mysqli_query($con, $query);
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>packages</title>



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
  
<section class="header">
<a href="home.php" class="logo">Croatia</a>
<nav class="navbar">
    <a href="home.php">Home</a>
    <a href="about.php">About</a>
    <a href="package.php">Package</a>
    <a href="book.php">Book</a>
    <?php
    // Check if the admin is logged in
    if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
        echo '<a href="add_products.php">Add Products</a>';
    } else {
        echo '<a href="admin.php">Admin</a>';
    }
    ?>


</nav>

<div id="menu-btn" class="fas fa-bars"></div>
</section>





<div class="heading"style="background:url(images/packages-bg.jpg);">
    <h1>Packages</h1>
</div>


<section >
    <div class="home-packages">
    <h1 class="heading-title">our packages</h1>

    <div class="box-container">
        
    </div>

    </div>
</section>


















<!--footer starts here-->
<section class="footer">
<div class="box-container">


        <div class="box">
            <h3>quick links</h3>
            <a href="home.php"> <i class="fas fa-angle-right"></i> home</a>
            <a href="about.php"><i class="fas fa-angle-right"></i>about</a>
            <a href="package.php"><i class="fas fa-angle-right"></i>package</a>
            <a href="book.php"><i class="fas fa-angle-right"></i>book</a>
        </div>


        <div class="box">
            <h3>extra links</h3>
            <a href="#"><i class="fas fa-angle-right"></i> ask questions</a>
            <a href="#"><i class="fas fa-angle-right"></i> about us</a>
            <a href="#"><i class="fas fa-angle-right"></i> privacy policy</a>
            <a href="#"><i class="fas fa-angle-right"></i> terms of use</a>
        </div>


        <div class="box">
            <h3>contact info</h3>
            <a href="#"><i class="fas fa-phone"></i> +111-111-1111</a>
            <a href="#"><i class="fas fa-phone"></i> +222-222-2222</a>
            <a href="#"><i class="fas fa-envelope"></i >mateo.tokic1@gmail.com </a>
            <a href="#"><i class="fas fa-map"></i>osijek, croatia - 31000</a>
        </div>

        <div class="box">
            <h3>follow us</h3>
            <a href="#"><i class="fab fa-facebook-f"></i>facebook</a>
            <a href="#"><i class="fab fa-twitter"></i>twitter</a>
            <a href="#"><i class="fab fa-instagram"></i>instagram</a>
            <a href="#"><i class="fab fa-linkedin"></i>linkedin</a>

        </div>

</div>


</section>
<!--footer ends here-->




<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script src="script.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get-data2.php', true);

    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 400) {
            var data = JSON.parse(xhr.responseText);
            var outputContainer = document.querySelector('.box-container');

            data.forEach(function(item) {
                var box = document.createElement('div');
                box.classList.add('box');

                box.innerHTML = `
                    <div class="image">
                        <img src="${item.image}" alt="">
                    </div>
                    <div class="content">
                        <h3>${item.name}</h3>
                        <p style="color: green; font-weight: bold;">Price: $${item.price}</p>
                        <p>Available until: ${item.date}</p>
                        <a href="book.php" class="btn">book now</a>
                    </div>
                `;

                outputContainer.appendChild(box);
            });
        } else {
            console.error('Error fetching data. Status:', xhr.status);
        }
    };

    xhr.onerror = function() {
        console.error('Network error');
    };

    xhr.send();
});


    </script>
</body>
</html>