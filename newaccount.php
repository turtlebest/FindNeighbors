<?php
include "include.php";
require_once 'Model/UserModel.php';
require 'Controller/LoginController.php';
$loginController = new LoginController();

$UserModel = new UserModel();
$UserModel->CreateAccount();

$uid = $_POST['uid_input'];
$psw = $_POST['password_input'];
//printf($uid);

$result = $loginController->CheckUser($uid, $psw);
$Correct = $result[0];
$Approved = $result[1];
//printf($Correct);

if ($result[0]) {
    $_SESSION['Login'] = TRUE;
    $_SESSION['uid'] = $uid;
    $_SESSION['password'] = $psw;
    $_SESSION['approved'] = $Approved;
    
    echo '<script>window.location.href = "login.php";</script>'; 
} else {

    echo '<script type="text/javascript">alert("The account or password not exist!");</script>'; 
    echo '<script>window.location.href = "login.php";</script>'; 
}


?>