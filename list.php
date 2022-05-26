<?php
include './includes/function.php';
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
    <link rel="stylesheet" href="./styles/list.css">
    <title>Adopt Me | Donations - Search</title>
</head>

<body>
    <?php include("./partials/nav.php") ?>
    <div class="container">
        <?php include './partials/message.php'; ?>
        <div class="title">
            <h1>All posts</h1>
        </div>
        <div class="data-section">
            <div class="sidebar">
                <?php
                include("partials/search_sidebar.php");
                ?>
            </div>
            <div class="helplist-container" autofocus>
                <?php
                $limit = (isset($_GET['limit']) && $_GET['limit'] != null) ? $_GET['limit'] : 10;
                $offset = (isset($_GET['offset']) && $_GET['offset'] != null) ? $_GET['offset'] : 0;
                $category = (isset($_GET['category']) && $_GET['category'] != null) ? $_GET['category'] : NULL;
                $search = (isset($_GET['search']) && $_GET['search'] != null) ? $_GET['search'] : "";
                $donations = getDonations($limit, $offset, $search, $category);
                // echo $donations;
                // exit();
                while ($donation = mysqli_fetch_array($donations['results'])) {
                ?>
                    <div class='help-item'>
                        <div class='help-title'>
                            <h3><?= $donation['title'] ?></h3>
                        </div>
                        <div class='help-description'>
                            <p><?= $donation['description'] ?></p>
                        </div>
                        <div class='help-meta'> -<?= $donation['location'] ?></div>
                        <div class="view-more"><a href="./help-detail.php?help_id=<?= $donation['id'] ?>" class="">Detail&rarr;</a></div>
                    </div>
                <?php
                }
                $count = $donations['count'];
                ?>

                <?= paginate($limit, $offset, $count, $category, $search); ?>
            </div>
        </div>
    </div>

    <script src="./scripts/nav.js"></script>
</body>

</html>