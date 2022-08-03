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
    <title>Adopt Me | All Requests</title>
</head>

<body>
    <?php include("./partials/nav.php") ?>
    <div class="container">
        <?php include './partials/message.php'; ?>
        <div class="title">
            <h1>All Requests</h1>
        </div>
        <div class="data-section">
            <div class="sidebar">
                <?php
                include("partials/search_sidebar.php");
                ?>
            </div>
            <div class="helplist-container" autofocus>
                <?php
                $requests = adoptionRequests();
                while ($request = mysqli_fetch_array($requests)) {
                    // var_dump($request);
                    // exit();
                ?>
                    <div class='help-item'>
                        <div class='help-title'>
                            <h3><?= $request['email'] ?></h3>
                        </div>
                        <div class='help-description'>
                            <p><?= $request['message'] ?></p>
                        </div>
                        <div class='help-description'>
                            <a href="./help-detail.php?help_id=<?= $request['pet'] ?>" class="">PetDetail: <?= $request['title'] ?></a>
                        </div>
                        <?php if ($request["status"] == 0) : ?>
                            <form action="./setAdoptionStatus.php" method="POST">
                                <input type="hidden" name="status" value="1">
                                <input type="hidden" name="request_id" value="<?= $request['request_id'] ?>">
                                <button class="btn" type="submit" name="setAdoptionStatusBtn" >Accept</button>
                            </form>
                            <form action="./setAdoptionStatus.php" method="POST">
                                <input type="hidden" name="status" value="2">
                                <input type="hidden" name="request_id" value="<?= $request['request_id'] ?>">
                                <button class="btn" type="submit" name="setAdoptionStatusBtn" >Reject</button>
                            </form>
                        <?php elseif ($request["status"] == 1) : ?>
                            Request Accepted!
                        <?php else : ?>
                            Request Denied!
                        <?php endif ?>

                     
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