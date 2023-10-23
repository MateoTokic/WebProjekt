<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Dodajte ostale head elemente ovisno o vašim potrebama -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <h2>Registracija</h2>

    <div id="error-message"></div>

    <form id="register-form">
        <label for="username">Korisničko ime:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="email">Email:</label>
<input type="email" id="email" name="email" required><br><br>


        <label for="password">Lozinka:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="confirm-password">Potvrdi lozinku:</label>
<input type="password" id="confirm-password" name="confirm-password" required><br><br>




        <input type="submit" value="Registriraj se">
    </form>

    <script>
        $(document).ready(function() {
            $('#register-form').submit(function(e) {
                e.preventDefault();

                var username = $('#username').val();
                var password = $('#password').val();

                $.ajax({
                    type: 'POST',
                    url: 'register.php',
                    data: {username: username, password: password},
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            window.location.href = 'home.php'; // Stranica za uspješnu registraciju
                        } else {
                            $('#error-message').text(response.message);
                        }
                    },
                    error: function() {
                        alert('Došlo je do pogreške prilikom slanja zahtjeva.');
                    }
                });
            });
        });
    </script>

</body>
</html>
