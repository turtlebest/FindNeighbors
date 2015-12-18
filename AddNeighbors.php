<?php
include "include.php";
require 'Controller/NeighborController.php';
include_once 'Model/NeighborModel.php';

$NeighborController = new NeighborController();
//$NeighborModel = new NeighborModel();
echo $NeighborController->AddNeighbor($_GET['user_id']);
echo '<script>window.location.href = "home.php";</script>'; 
?>
