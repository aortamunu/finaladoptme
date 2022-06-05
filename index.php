<?php
include './includes/function.php';
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
    
            <!-- <img src = "pizap.jpg"> -->

            <div class="">
    <form class="mainss">
    <?php
    $input_value = isset($_GET['search']) ? $_GET['search'] : "";
    ?>
    <!-- <label for='search'></label> -->
    <input type='text' name='search' class='mainsearch' placeholder='Find you a PET <3' value="<?= $input_value ?>">
        
    
    <!-- <label for='category'>Select Category:</label> -->
<select id='create-help-category' class='mainsearch' name='category'>
    <option value=''>All Categories</option>
    <?php
    $categories = getCategories();
    while ($category = $categories->fetch_assoc()) {
        $selected = (isset($_GET['category']) && $category['id'] == $_GET['category']) ? "selected" : "";
    ?>
        <option value="<?= $category['id'] ?>" <?= $selected ?>><?= ($category['name']) ?></option>
    <?php
    }
    ?>
</select>


        <button class=" btns searchbtn">
            Search
        </button>
    </form>
        </div>
        <?php include './partials/message.php'; ?>
        <!-- <div class="youtube title">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/wWw0iQF5Za8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div> -->
    </div>


    <script src="./scripts/nav.js"></script>
</body>

</html>