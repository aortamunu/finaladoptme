<?php
include "./includes/function.php";
include "./includes/authentication_required.php";

// function createPetDonation($title = NULL, $description = NULL, $location = NULL, $contact = NULL, $category = NULL, $active = NULL)
// {
//     // File upload path
//     $targetDir = "uploads";
//     $fileName = basename($_FILES["petImage"]["name"]);
//     $tempname = basename($_FILES["petImage"]["tmp_name"]);
//     $targetFilePath = $targetDir . "/" . $fileName;
//     $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

//     // echo ("<br>targetDir   " . $targetDir);
//     // echo ("<br>fileName   " . $fileName);
//     // echo ("<br>tempname   " . $tempname);
//     // echo ("<br>targetFilePath   " . $targetFilePath);
//     // echo ("<br>fileType   " . $fileType);

//     // exit();



//     // Allow certain file formats

//     global $conn;
//     $sql = $conn->prepare('INSERT INTO pets (title, description, location, contact, helper_id, category, active, image) VALUES (?, ?, ?, ?, ? , ?, ?, ?)');

//     $MESSAGES = [
//         UPLOAD_ERR_OK => 'File uploaded successfully',
//         UPLOAD_ERR_INI_SIZE => 'File is too big to upload',
//         UPLOAD_ERR_FORM_SIZE => 'File is too big to upload',
//         UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
//         UPLOAD_ERR_NO_FILE => 'No file was uploaded',
//         UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder on the server',
//         UPLOAD_ERR_CANT_WRITE => 'File is failed to save to disk.',
//         UPLOAD_ERR_EXTENSION => 'File is not allowed to upload to this server',
//     ];

//     if (!empty($fileName)) {
//         $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
//         if (in_array($fileType, $allowTypes)) {
//             // Upload file to server
//             if (move_uploaded_file($tempname, $targetFilePath)) {

//                 // Insert image file name into database
//                 $sql->bind_param('sssiiiis', $title, $description, $location, $contact, $_SESSION['user']['id'], $category, $active, $fileName);

//                 $sql->execute();
//                 if ($sql->affected_rows > 0) {
//                     $_SESSION['message'] = array('type' => 'success', 'msg' => 'You have created new pet donation!');
//                 }
//             } else {
//                 $error_msg = "Not uploaded because of error #" . $_FILES['petImage']["error"];
//                 $error_msg = $MESSAGES[$_FILES['petImage']['error']];

//                 $_SESSION['message'] = array('type' => 'danger', 'msg' => $error_msg);
//             }
//         } else {
//             $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Please upload valid pet image!');
//         }
//     } else {
//         $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Pet image not provided!');
//     }

//     header('Location: /my-helps.php');
//     $sql->close();
//     exit();
// }


if (isset($_POST['post_help'])) :
    $title = $_POST['title'];
    $description = $_POST['description'];;
    $location = $_POST['location'];
    $contact = $_POST['contact'];
    $category = $_POST['category'];
    $active = isset($_POST['active']) ? 1 : 0;
    $image = $_FILES["petImage"];
    createPetDonation(
        $title,
        $description,
        $location,
        $contact,
        $category,
        $active,
        $image
    );
endif;
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
    <title>Adopt Me |New Post </title>
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
            <h1> Create Post</h1>
        </div>
        <div class="data-section">
            <div class="render-section">
                <div class="">
                    <div class='help-item help-item-card'>
                        <div class='help-title'>Fill form to see how it looks.🙂</div>
                        <div class='help-description'></div>
                        <div class='help-meta help-meta-location'></div>
                    </div>
                    <div class='help-item'>
                        <div class='help-title'>
                        </div>
                        <div class='help-description'>
                        </div>
                        <div class='help-meta help-meta-category'>
                        </div>
                        <div class='help-meta help-meta-contact'>
                        </div>
                        <div class='help-meta help-meta-location'>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-section">
                <form class="help-item" method="post" action="./new-help.php" id='createHelpForm' name='createHelpForm' enctype="multipart/form-data">
                    <label for="create-help-title">Name</label><br>
                    <input type="text" placeholder="" id='create-help-title' class='' name="title" required><br>

                    <label for="create-help-image">Image</label><br>
                    <input type="file" id="create-help-image" name="petImage" required />


                    <label for="create-help-category">Post Category:</label><br>
                    <select id='create-help-category' class='input' name="category" required>
                        <?php
                        $categories = getCategories();
                        while ($category = mysqli_fetch_array($categories)) {
                        ?>
                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                        <?php
                        }
                        ?>
                    </select><br>

                    <label for="create-help-description">Description:</label><br>
                    <textarea id="create-help-description" placeholder="Description about pet..." name='description' class='textarea' required></textarea><br>
                    <div id="ckeditor"></div>

                    <label for="create-help-location">Location</label><br>
                    <input type="text" placeholder="Location" id='create-help-location' class='' name="location" required><br>

                    <label for="create-help-contact">Contact</label><br>
                    <input type="number" placeholder="Contact number" id='create-help-contact' class='' name="contact" required><br>

                    <label for="create-help-active">Available</label><br>
                    <input type="checkbox" id='create-help-active' class='' value="1" name="active"><br>

                    <button type="submit" value="submit" name="post_help" class="btn btn-login">POST</button>
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