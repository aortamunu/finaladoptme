<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
// ini_set("file_uploads", 1);

require_once('database.php');
session_start();

/* register function */
function createUser($email = NULL, $password = NULL)
{
    global $conn;
    $sql = $conn->prepare('SELECT * FROM user WHERE email = ?');
    $sql->bind_param('s', $email);
    $sql->execute();
    $result = $sql->get_result();
    if ($result->num_rows !== 0) :
        $_SESSION['message'] = array('type' => 'danger', 'msg' => 'The email you chose is already registered.');
    else :
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = $conn->prepare('INSERT INTO user (email, password) VALUES (?, ?)');
        $sql->bind_param('ss', $email, $password);
        $sql->execute();
        $sql->close();
        if (isset($_SESSION['user'])) :
            $_SESSION['message'] = array('type' => 'success', 'msg' => 'Successfully added a new user');
        else :
            $_SESSION['message'] = array('type' => 'success', 'msg' => 'You have successfully create a new user, once approved you can log in here.');
            header('Location: /login.php');
        endif;
        exit();
    endif;
}
/* login function */
function authenticate($email = NULL, $password = NULL)
{
    global $conn;
    $sql = $conn->prepare("SELECT * FROM user WHERE email = ? AND active = 1");
    $sql->bind_param('s', $email);
    $sql->execute();
    $result = $sql->get_result();
    if ($result->num_rows === 0) :
        $_SESSION['message'] = array('type' => 'danger', 'msg' => 'User with given email not found.');
    else :
        while ($row = $result->fetch_assoc()) {
            $hash = $row['password'];
            if (password_verify($password, $hash)) :
                $_SESSION['user']['id'] = $row['id'];
                $_SESSION['user']['email'] = $row['email'];
                $_SESSION['user']['role'] = $row['role'];
                $_SESSION['message'] = array('type' => 'success', 'msg' => 'You are authenticated.');
                Header('Location: /list.php');
            else :
                $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Your email or password is incorrect. Please try again.');
            endif;
        }
    endif;
    $sql->close();
}
/* logout function */
function logout()
{
    unset($_SESSION['user']);
    $_SESSION['message'] = array('type' => 'danger', 'msg' => 'You have been logged out.');
    header('Location: /');
    exit();
}

// check if user is logged in
function isAuthenticated()
{
    return isset($_SESSION['user']);
}

// check if user is logged in
function isAdminUser()
{
    if (isset($_SESSION['user'])) :
        return $_SESSION['user']['role'] === 0;
    else :
        return false;
    endif;
}

function getCategories()
{
    global $conn;
    $sql = $conn->prepare('SELECT * from pets_category');
    $sql->execute();
    $categories = $sql->get_result();
    $sql->close();
    return $categories;
}

function getDonations($limit = NULL, $offset = NULL, $search = NULL, $category = NULL)
{
    global $conn;
    $lim = $limit !== NULL ? $limit : 10;
    $off = $offset !== NULL ? $offset : 0;
    $active = 1;
    $search = "%" . $search . "%";
    if ($category !== "" && $category !== NULL && $category !== 0) {
        $sql = $conn->prepare("SELECT id, location, title, description FROM `pets` WHERE `active` = ? AND `category` = ? AND CONCAT_WS('',`title`,`description`) LIKE ? ORDER BY `id` DESC LIMIT ? OFFSET ?");
        $sql->bind_param('iisii', $active, $category, $search, $lim, $off);
        $count_sql = $conn->prepare("SELECT COUNT(id) as total FROM `pets` WHERE `active` = ? AND `category` = ? AND CONCAT_WS('',`title`,`description`) LIKE ?");
        $count_sql->bind_param('iis', $active, $category, $search);
    } else {
        $sql = $conn->prepare("SELECT id, location, title, description FROM `pets` WHERE `active` = ? AND CONCAT_WS('',`title`,`description`) LIKE ? ORDER BY `id` DESC LIMIT ? OFFSET ?");
        $sql->bind_param('isii', $active, $search, $lim, $off);
        $count_sql = $conn->prepare("SELECT COUNT(id) as total FROM `pets` WHERE `active` = ? AND CONCAT_WS('',`title`,`description`) LIKE ?");
        $count_sql->bind_param('is', $active, $search);
    }
    $count_sql->execute();
    $count = $count_sql->get_result()->fetch_object();
    $count_sql->close();
    $sql->execute();
    $pets = $sql->get_result();
    $sql->close();
    $data = array('count' => $count->total, 'results' => $pets);
    return $data;
}

function getPetById($pet_id = NULL, $owner = NULL)
{
    global $conn;
    if ($pet_id !== "" && $pet_id !== NULL && $pet_id !== 0) {
        if ($owner == NULL) {
            $sql = $conn->prepare("SELECT * FROM `pets` WHERE `id` = ?");
            $sql->bind_param('i', $pet_id);
        } else {
            $sql = $conn->prepare("SELECT * FROM `pets` WHERE `id` = ? AND `helper_id` = ?");
            $sql->bind_param('ii', $pet_id, $owner);
        }
        $sql->execute();
        $help = $sql->get_result();
        $sql->close();
        return $help;
    } else {
        return NULL;
    }
}


/* create pet donation */
function createPetDonation($title = NULL, $description = NULL, $location = NULL, $contact = NULL, $category = NULL, $active = NULL, $image = NULL)
{
    // File upload path
    $targetDir = "uploads/";
    $fileName = $image["name"];
    $tempname = $image["tmp_name"];
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Allow certain file formats

    global $conn;

    $MESSAGES = [
        UPLOAD_ERR_OK => 'File uploaded successfully',
        UPLOAD_ERR_INI_SIZE => 'File is too big to upload',
        UPLOAD_ERR_FORM_SIZE => 'File is too big to upload',
        UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
        UPLOAD_ERR_NO_FILE => 'No file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder on the server',
        UPLOAD_ERR_CANT_WRITE => 'File is failed to save to disk.',
        UPLOAD_ERR_EXTENSION => 'File is not allowed to upload to this server',
    ];

    if (!empty($fileName)) {
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($tempname, $targetFilePath)) {
                $sql = $conn->prepare('INSERT INTO pets (title, description, location, contact, helper_id, category, active, image) VALUES (?, ?, ?, ?, ? , ?, ?, ?)');
                // Insert image file name into database
                $sql->bind_param('sssiiiis', $title, $description, $location, $contact, $_SESSION['user']['id'], $category, $active, $targetFilePath);

                $sql->execute();
                if ($sql->affected_rows > 0) {
                    $_SESSION['message'] = array('type' => 'success', 'msg' => 'You have created new pet donation!');
                }
            } else {
                $error_msg = "Not uploaded because of error #" . $image["error"];
                $error_msg = $MESSAGES[$image['error']];

                $_SESSION['message'] = array('type' => 'danger', 'msg' => $error_msg);
            }
        } else {
            $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Please upload valid pet image!');
        }
    } else {
        $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Pet image not provided!');
    }

    header('Location: /my-helps.php');
    $sql->close();
    exit();
}

/* update help */
function updatePetDonation($id = NULL, $title = NULL, $description = NULL, $location = NULL, $contact = NULL, $category = NULL, $active = NULL)
{
    global $conn;
    $sql = $conn->prepare('UPDATE `pets` SET title= ?, description= ?, location= ?, contact= ?, category= ?, active = ? WHERE id= ?');
    $sql->bind_param('sssiiii', $title, $description, $location, $contact, $category, $active, $id);
    $sql->execute();
    if ($sql->affected_rows === 0) :
        $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Error updating pet donation!');
    else :
        $_SESSION['message'] = array('type' => 'success', 'msg' => 'Successfully update the selected pet donation.');
    endif;
    $sql->close();
    header('Location: /update-help.php?help_id=' . $id);
    exit();
}
function deletePetDonation($id = NULL)
{
    global $conn;
    $sql = $conn->prepare('DELETE FROM `pets` WHERE id= ?');
    $sql->bind_param('i', $id);
    $sql->execute();
    if ($sql->affected_rows === 0) :
        $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Error deleting pet donation!');
    else :
        $_SESSION['message'] = array('type' => 'success', 'msg' => 'Successfully deleted the selected pet donation.');
    endif;
    $sql->close();
    header('Location: /my-helps.php');
    // header('Location: update.php?id=' . $mysqli->insert_id);
    exit();
}

function paginate($limit, $offset, $count, $category, $search)
{
    $next_icon = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-chevron-right' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z' /></svg>";
    $prev_icon = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-chevron-left' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z' /></svg>";
    echo "<div class='pagination-container'>";
    $static_query = "&limit=" . $limit . "&category=" . $category . "&search=" . $search;
    if ($offset > 0) :
        $prev_offset = $offset - $limit;
        echo "<a class='pagination-btn' href='/list.php?offset=" . $prev_offset . $static_query . "' >" . $prev_icon . " </a>";
    endif;
    if ($limit + $offset < $count) :
        $next_offset = $offset + $limit;
        echo "<a class='pagination-btn' href='/list.php?offset=" . $next_offset . $static_query . "'>" . $next_icon . "</a>";
    endif;
}

/* login function */
function changePassword($user_id, $old_password, $password1, $password2)
{
    global $conn;
    if ($password1 !== $password2) {
        $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Both password do not match!');
        return;
    }
    $sql = $conn->prepare("SELECT * FROM user WHERE id = ? AND active = 1");
    $sql->bind_param('i', $user_id);
    $sql->execute();
    $result = $sql->get_result();
    $sql->close();
    if ($result->num_rows !== 0) :
        while ($row = $result->fetch_assoc()) {
            $hash = $row['password'];
            if (password_verify($old_password, $hash) == true) :
                $password_change_sql = $conn->prepare("UPDATE user SET `password`=? WHERE id=? ");
                $password_change_sql->bind_param("si", password_hash($password1, PASSWORD_DEFAULT), $user_id);
                $password_change_sql->execute();
                if ($password_change_sql->affected_rows === 0) :
                    $_SESSION['message'] = array('type' => 'danger', 'msg' => 'An unknown error occoured. Please try again later.');
                else :
                    $_SESSION['message'] = array('type' => 'success', 'msg' => 'User password successfully changed!');
                endif;
                $password_change_sql->close();
            else :
                $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Your old password is incorrect. Please try again.');
            endif;
        }
    endif;
}

function echoCategoryName($id = NULL)
{
    global $conn;
    $sql = $conn->prepare("SELECT `name` FROM pets_category WHERE id = ?");
    $sql->bind_param('i', $id);
    $sql->execute();
    $res = $sql->get_result();
    if ($res->num_rows !== 0) {
        while ($cat_name = $res->fetch_assoc()) {
            echo $cat_name['name'];
        }
    } else {
        echo $id;
    }
    $sql->close();
}

function getRelatedDonations($cat = NULL, $cur_help_id = NULL)
{
    $result = array();
    global $conn;
    $sql = $conn->prepare("SELECT * FROM pets WHERE category = ? AND active = 1 ORDER BY `pets`.`id` DESC LIMIT 10 ");
    $sql->bind_param("i", $cat);
    $sql->execute();
    $rows = $sql->get_result();
    $sql->close();
    while ($row = $rows->fetch_array()) {
        if ($row['id'] == $cur_help_id) {
            continue;
        }
        array_push($result, $row);
    }
    if ($rows->num_rows < 8) {
        $sql = $conn->prepare("SELECT * FROM pets WHERE active = 1 ORDER BY `pets`.`id` DESC LIMIT 7");
        $sql->execute();
        $new_res = $sql->get_result();
        while ($row = $new_res->fetch_array()) {
            if ($row['id'] == $cur_help_id || in_array($row, $result)) {
                continue;
            }
            array_push($result, $row);
        }
        $sql->close();
    }
    return $result;
}


function getDonationsByUser($limit = NULL, $offset = NULL, $search = NULL, $category = NULL, $user_id = NULL, $active = NULL)
{
    if (!isset($user_id)) {
        try {
            $user_id = $_SESSION['user']['id'];
        } catch (Throwable $throwable) {
            $_SESSION['message'] = array('type' => 'danger', 'msg' => 'No users Provided!😟');
            header("Location: /");
            exit();
        }
    }
    global $conn;
    $lim = $limit !== NULL ? $limit : 10;
    $off = $offset !== NULL ? $offset : 0;
    $search = $conn->real_escape_string($search);
    $category = $conn->real_escape_string($category);
    $active = $conn->real_escape_string($active);
    $frm_q = "FROM `pets` WHERE `helper_id`= $user_id ";
    $order_q = "ORDER BY `id` DESC LIMIT $lim OFFSET $off";
    $search_q = "AND (`title` LIKE \"%$search%\" OR `description` LIKE \"%$search%\") ";
    if ($category !== "" && $category !== NULL && $category !== 0) {
        $frm_q .= "AND `category` = $category ";
    }
    if ($active !== "" && $active !== NULL) {
        $frm_q .= "AND `active` = $active ";
    }
    $query = "SELECT id, location, title, description " . $frm_q . $search_q . $order_q;
    $sql = $conn->prepare($query);
    $sql->execute();
    $donations = $sql->get_result();
    $sql->close();
    $count_sql = $conn->prepare("SELECT COUNT(id) as total " . $frm_q . $search_q);
    $count_sql->execute();
    $donations_count = $count_sql->get_result()->fetch_object();
    return array("results" => $donations, "count" => $donations_count->total);
}
