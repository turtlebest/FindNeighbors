<?php
include "include.php";

require 'Controller/UserController.php';
$UserController = new UserController();

$friendid = $_GET['memberid'];

$UserController->ApproveMember($memberid);


echo '<script type="text/javascript">alert("You have accepted friend request!!");</script>';
echo '<script>window.location.href = "home.php";</script>';

?>
