<?php
include 'db.php';

$query = "SELECT name, date FROM moji_proizvodi";
$result = mysqli_query($con, $query);
$itemNames = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>book</title>
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

<div class="heading" style="background:url(images/book_bg.jpg) no-repeat">
    <h1>book now</h1>
</div>

<section class="booking">
    <h1 class="heading-title">Book your trip!</h1>
    <form action="book-form.php" method="post" class="book-form" id="myForm">
        <div class="flex">
            <div class="inputBox">
                <span>name:</span>
                <input type="text" placeholder="enter your name" name="name" required>
            </div>

            <div class="inputBox">
                <span>email:</span>
                <input type="email" placeholder="enter your email" name="email" required>
            </div>

            <div class="inputBox">
                <span>phone:</span>
                <input type="number" placeholder="enter your number" name="phone" required>
            </div>

            <div class="inputBox">
                <span>address:</span>
                <input type="text" placeholder="enter your address" name="address" required>
            </div>

            <div class="inputBox">
                <span>where to:</span>
                <select name="location" required id="locationSelect">
                <?php foreach ($itemNames as $item) : ?>
                        <option value="<?php echo $item['name']; ?>" data-date="<?php echo $item['date']; ?>"><?php echo $item['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="inputBox">
                <span>how many:</span>
                <input type="number" placeholder="number of guests" name="guests" required>
            </div>

            <div class="inputBox">
                <span>arrivals:</span>
                <input type="date" name="arrivals" id="arrivingDate" required min="<?php echo date('Y-m-d'); ?>">
            </div>

            <div class="inputBox">
                <span>leaving:</span>
                <input type="date" name="leaving" id="leavingDate" required>
            </div>
        </div>

        <input type="submit" value="submit" class="btn" name="send">
    </form>
    <div id="error-message"></div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>






<script>
const form = document.getElementById('myForm');
const errorMessage = document.getElementById('error-message');

const locationSelect = document.getElementById('locationSelect');
const arrivingDateInput = document.getElementById('arrivingDate');
const leavingDateInput = document.getElementById('leavingDate');





form.addEventListener('submit', (e) => {
    e.preventDefault();

    if (form.checkValidity() === false) {
        errorMessage.textContent = 'Please fill in all the fields before submitting the form.';
        
    } else {
        
        form.submit();
        
    }
});


locationSelect.addEventListener('change', () => {
    const selectedOption = locationSelect.options[locationSelect.selectedIndex];
    const date = selectedOption.getAttribute('data-date');

    arrivingDateInput.max = date;
   

});

arrivingDateInput.addEventListener('change', () => {
    leavingDateInput.min = arrivingDateInput.value;
});


</script>





</body>
</html>
