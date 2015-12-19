<?php
include "include.php";
require 'Controller/NeighborController.php';
include_once 'Model/NeighborModel.php';

$NeighborController = new NeighborController();
//$NeighborModel = new NeighborModel();
echo $NeighborController->AddNeighbor($_GET['user_id']);
$userid = $_GET['user_id'];
$url = 'UserProfile.php?user_id='.$userid;
echo "<script>window.location.href = 'UserProfile.php?user_id=".$userid."';</script>"; 
//echo '<script>window.location.href = "home.php";</script>'; 
?>
