<?php
include "include.php";
require 'Controller/FriendController.php';
include_once 'Model/FriendModel.php';

$FriendController = new FriendController();
//$NeighborModel = new NeighborModel();

echo $FriendController->AddFriend($_GET['user_id']);
echo '<script>window.location.href = "home.php";</script>'; 
?>

