<?php
include "./includes/function.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/nav.css">
    <link rel="stylesheet" href="./styles/list.css">
    <link rel="shortcut icon" href="./public/favicon.png" type="image/x-icon">
    <title>Adopt Me</title>
</head>

<body>
    
    <?php include("./partials/nav.php") ?>
    <div class="container">
        
    <?php include './partials/message.php'; ?>

    <div class="findpet">
    <h4>It's time to find perfect companion.</h4>
            <a href="./list.php" class='petfind'>
            <p>Let's go</p>
            </a>
        </div>

    
    <!-- <div class="image">
    <img src = "bestbuddy.jpg">
    </div> -->

    
            


    <script src="./scripts/nav.js"></script>
</body>

</html>