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
    <title>home</title>



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
    <a href="index.php">Log out</a>
    <?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Ako korisnik nije prijavljen, možete ga preusmjeriti na stranicu za prijavu
    header('Location: login.php');
    exit();
}

// Ovdje dolazi sadržaj vaše stranice kojem samo prijavljeni korisnici mogu pristupiti
?>

</nav>

<div id="menu-btn" class="fas fa-bars"></div>
</section>

<!--header ends here-->



<section class="home">

<div class="swiper home-slider">
    <div class="swiper-wrapper">
        <div class="swiper-slide slide" style="background: url(images/slide-1.jpg);">
            <div class="content">
                <span>Explore, Discover, Travel</span>
                <h3>travel around Croatia</h3>
                <a href="package.php" class="btn">Discover more</a>

            </div>
        </div>


        <div class="swiper-slide slide" style="background: url(images/slide-2.jpg);">
            <div class="content">
                <span>Explore, Discover, Travel</span>
                <h3>Discover the new places</h3>
                <a href="package.php" class="btn">Discover more</a>

            </div>
        </div>


        <div class="swiper-slide slide" style="background: url(images/slide-3.jpg);">
            <div class="content">
                <span>Explore, Discover, Travel</span>
                <h3>make your tour worthwhile</h3>
                <a href="package.php" class="btn">Discover more</a>

            </div>
        </div>
    </div>

    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
</section>









<!--services begins here-->
<section class="services">
    <h1 class="heading-title">travel around Croatia</h1>
    <div class="box-container">
        <div class="box">
            <img src="images/mountain.png" alt="">
            <h3>adventure</h3>
        </div>

        <div class="box">
            <img src="images/position.png" alt="">
            <h3>tour guide</h3>
        </div>

        <div class="box">
            <img src="images/school-bag.png" alt="">
            <h3>trekking</h3>
        </div>

        <div class="box">
            <img src="images/fire.png" alt="">
            <h3>camp fire</h3>
        </div>

        <div class="box">
            <img src="images/street-sign.png" alt="">
            <h3>off road</h3>
        </div>

        <div class="box">
            <img src="images/camping-tent.png" alt="">
            <h3>camping</h3>
        </div>
    </div>
</section>






<section>
  <div class="home-about">
     <div class="image" ><img src="images/about_us.jpg" alt=""></div>
     <div class="content">
        <h3>About Croatia</h3>
        <p>Croatia: A Gem of the Adriatic

Nestled on the eastern coast of the Adriatic Sea, Croatia is a breathtakingly 
beautiful country that boasts a rich history, stunning landscapes, and a vibrant
cultural heritage. With a history dating back to ancient times, Croatia has been 
influenced by various civilizations, leaving behind an intriguing blend of traditions
and customs. Today, it stands as a modern European nation, attracting visitors from 
around the globe</p>
            <a href="about.php" class="btn">Read more</a>
     </div>
  </div>
</section>


 


<section>
    <div class="home-packages">
        <h1 class="heading-title">our packages</h1>
        <div class="box-container" id="output">
            <!-- Ovde će se ubaciti podaci AJAX-om -->
        </div>
    </div>

    <div class="load-more"><a href="package.php" class="btn">Load more</a></div>
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

<script >

document.addEventListener('DOMContentLoaded', function() {
    var xhr = new XMLHttpRequest();

    xhr.open('GET', 'get-data.php', true);

    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 400) {
            var data = JSON.parse(xhr.responseText);
            var outputContainer = document.getElementById('output');

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


