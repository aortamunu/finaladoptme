<?php
include './includes/function.php';
if (isset($_POST['loginBtn'])) :
    $email = $_POST['email'];
    $password = $_POST['password'];
    authenticate($email, $password);
endif;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./public/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/nav.css">
    <title>Adopt Me | Login</title>
</head>

<body>
    <?php include("./partials/nav.php") ?>
    <div class="container">
        <?php include './partials/message.php'; ?>

        <div class="form-container">
            <div class="form-center-on-container">
                <h2>Login</h2>
                <hr><br>
                <form action="./login.php" method="post" class="">
                    <div class="form-item">
                        <label for="email">Username</label><br>
                        <input class='' type="text" name="email" id="email" placeholder="your username" autofocus><br>
                        <!-- <small class='text-error'>Email not verified!</small> -->
                    </div><br>
                    <div class="form-item">
                        <label for="password">Password</label><br>
                        <input type="password" name="password" id="password" placeholder="your password"><br>
                        <small id='password-error'></small>
                    </div><br>
                    <div class="form-item">
                        <br><button type="submit" class="btn btn-login" name='loginBtn'>Login</button>
                    </div>
                    <div class="notyet">
                    <br><small><a href="./register.php">Not registered yet?</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="./scripts/nav.js"></script>
</body>

</html>