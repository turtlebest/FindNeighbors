<?php
include "include.php";
require 'Controller/FriendController.php';
include_once 'Model/FriendModel.php';

$FriendController = new FriendController();
//$NeighborModel = new NeighborModel();

echo $FriendController->AddFriend($_GET['user_id']);
$userid = $_GET['user_id'];
$url = 'UserProfile.php?user_id='.$userid;
echo "<script>window.location.href = 'UserProfile.php?user_id=".$userid."';</script>"; 
?>
