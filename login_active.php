<?php
require 'Controller/LoginController.php';
$loginController = new LoginController();

$uid = $_POST['account_input'];
$psw = $_POST['password_input'];
printf($uid);

$Correct = $loginController->CheckUser($uid, $psw);
printf($Correct);

if ($Correct) {
    $_SESSION['Login'] = TRUE;
    include 'index2.php';
} else {

    echo '<script type="text/javascript">alert("The account or password not exist!");</script>'; 
    include 'login.php';
}

?>
