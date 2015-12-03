<?php
include "include.php";

require 'Controller/LoginController.php';
$loginController = new LoginController();

$uid = $_POST['account_input'];
$psw = $_POST['password_input'];
printf($uid);

$Correct = $loginController->CheckUser($uid, $psw);
printf($Correct);

if ($Correct) {
    $_SESSION['Login'] = TRUE;
    $_SESSION['uid'] = $uid;
    echo '<script>window.location.href = "home.php";</script>'; 
} else {

    echo '<script type="text/javascript">alert("The account or password not exist!");</script>'; 
    echo '<script>window.location.href = "login.php";</script>'; 
}

?>
