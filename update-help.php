<?php
include "./includes/function.php";
include "./includes/authentication_required.php";
if (isset($_GET['help_id'])) :
    $help_id = $_GET['help_id'];
    $help_res = getPetById($help_id, $_SESSION['user']['id']);
    if ($help_res->num_rows != 0) :
        while ($row = $help_res->fetch_object()) {
            $help = $row;
        }
    else :
        $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Help not found!');
        header('Location: /list.php');
        exit();
    endif;
else :
    $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Help not found!');
    header('Location: /list.php');
    exit();
endif;
if (isset($_POST['update_help'])) :
    $title = $_POST['title'];
    $description = $_POST['description'];;
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $category = $_POST['category'];
    $active = isset($_POST['active']) ? 1 : 0;
    updatePetDonation(
        $help_id,
        $title,
        $description,
        $location,
        $contact,
        $category,
        $active
    );
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
    <link rel="stylesheet" href="./styles/list.css">
    <title>Adopt Me | Edit Help</title>
    <style>
        #create-help-description {
            display: none;
        }
    </style>
</head>

<body>
    <?php include("./partials/nav.php") ?>
    <div class="container">
        <?php include './partials/message.php'; ?>
        <div class="title">
            <h1>Edit Post <?= $help->title ?></h1>
        </div>
        <div class="data-section">
            <div class="render-section">
                <div class="">
                    <div class='help-item help-item-card'>
                        <div class='help-title'>
                            <h3><?= $help->title ?></h3>
                        </div>
                        <div class='help-description'>
                            <p><?= $help->description ?></p>
                        </div>
                        <div class='help-meta help-meta-location'><?= $help->location ?></div>
                    </div>
                    <div class='help-item'>
                        <div class='help-title'>
                            <h3><?= $help->title ?></h3>
                        </div>
                        <div class='help-description'>
                            <p><?= $help->description ?></p>
                        </div>
                        <div class='help-meta help-meta-category'>
                            Category: <?php echoCategoryName($help->category); ?>
                        </div>
                        <div class='help-meta help-meta-contact'>
                            Contact: <?= $help->contact ?>
                        </div>
                        <div class='help-meta help-meta-location'>
                            Address: <?= $help->location ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-section">
                <form class="help-item" method="post" action="./update-help.php?help_id=<?= $help_id ?>" id='createHelpForm' name='createHelpForm'>
                    <label for="create-help-title">Name</label><br>
                    <input type="text" placeholder="Name" id='create-help-title' class='' name="title" value="<?= $help->title ?>" required><br>

                    <label for="create-help-category">Category:</label><br>
                    <select id='create-post-category' class='input' name="category" required>
                        <?php
                        $categories = getCategories();
                        while ($category = mysqli_fetch_array($categories)) {
                        ?>
                            <option value="<?= $category['id'] ?>" <?php
                                                                    if ($help->category == $category['id']) {
                                                                        echo "selected";
                                                                    } ?>>
                                <?= $category['name'] ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select><br>

                    <label for="create-help-description">Description</label><br>
                    <textarea id="create-help-description" placeholder="Description about post..." name='description' class='textarea' required><?= $help->description ?></textarea><br>
                    <div id="ckeditor"> <?= $help->description ?></div>


                    <label for="create-help-location">Location</label><br>
                    <input type="text" placeholder="Location" id='create-help-location' class='' name="location" required value="<?= $help->location ?>"><br>

                    <label for="create-help-contact">Contact</label><br>
                    <input type="number" placeholder="Contact number" id='create-help-contact' class='' name="contact" required value="<?= $help->contact ?>"><br>

                    <label for="create-help-active">Available</label><br>
                    <?php
                    $selected = $help->active == 1 ? "checked" : ""
                    ?>
                    <input type="checkbox" id='create-help-active' class='' name="active" value="1" <?= $selected ?>><br>

                    <button type="submit" value="submit" name="update_help" class="btn btn-edit">Update Help</button>
                </form>
            </div>
        </div>

    </div>

    <script src="./scripts/nav.js"></script>
    <script src="./scripts/ckeditor.js"></script>
    <script src="./scripts/newck.js"></script>
    <script src="./scripts/inputRender.js"></script>
</body>

</html>