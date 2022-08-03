<?php
include "./includes/function.php";
include "./includes/authentication_required.php";

if (isset($_POST['setAdoptionStatusBtn'])) :
    $request_id = intval($_POST['request_id']);
    $status = intval($_POST['status']);
    var_dump($request_id, $status);
    if (setRequestStatus($request_id, $status)) {
        $_SESSION['message'] = array('type' => 'success', 'msg' => 'Request Status Updated!');
    } else {
        $_SESSION['message'] = array('type' => 'danger', 'msg' => 'Request Status Update Failed!');
    }
    header('Location: ./adoption-requests.php');
endif;
