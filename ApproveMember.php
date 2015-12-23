<?php
include "include.php";

require 'Controller/UserController.php';
$UserController = new UserController();

$memberid = $_GET['memberid'];

$UserController->ApproveMember($memberid);

        printf($memberid);

echo '<script type="text/javascript">alert("You have approve block request!!");</script>';
//echo '<script> console.log('PHP: ".$memberid."');</script>';
echo '<script>window.location.href = "home.php";</script>';

?>
