<?php

include "./includes/function.php";
include "./includes/authentication_required.php";

if (isset($_POST['post_request'])) :
    $pet = $_POST['pet_id'];
    $message = $_POST['message'];
    createRequest($pet, $message);
endif;
