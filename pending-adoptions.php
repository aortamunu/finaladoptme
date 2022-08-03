<?php
include './includes/function.php';
include "./includes/authentication_required.php";
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
    <title>Adopt Me | Pending Adoptions</title>
</head>

<body>
    <?php include("./partials/nav.php") ?>
    <div class="container">
        <?php include './partials/message.php'; ?>
        <div class="title">
            <h1>Pending Adoptions</h1>
        </div>
        <div class="data-section">
            <div class="sidebar">
                <?php
                include("partials/search_sidebar.php");
                ?>
            </div>
            <div class="helplist-container" autofocus>
                <?php
                $requests = myPendingRequests();
                while ($request = mysqli_fetch_array($requests)) {
                ?>
                    <div class='help-item'>
                        <div class='help-title'>
                            <h3><?= $request['email'] ?></h3>
                        </div>
                        <div class='help-description'>
                            <p><?= $request['message'] ?></p>
                        </div>
                        <div class='help-description'>
                            <?php if ($request['status'] == 0) : ?>
                                Request Pending
                            <?php elseif ($request['status'] == 1) : ?>
                                Request Approved Call Now!
                            <?php else : ?>
                                Request Denied!
                            <?php endif ?>
                        </div>
                        <div class="view-more"><a href="./help-detail.php?help_id=<?= $request['pet'] ?>" class="">Detail&rarr;</a></div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <script src="./scripts/nav.js"></script>
</body>

</html>