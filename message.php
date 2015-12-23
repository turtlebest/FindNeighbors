<?php
include "include.php";
require 'Model/MessageModel.php';
require 'Model/BlockModel.php';

//printf("m2");

if (isset($_POST['title_input'])){
$MessageModel = new MessageModel();
$MessageModel->GetFriends();
$MessageModel->GetNeighbors();
$BlockModel = new BlockModel();
$BlockModel->GetBid();
$BlockModel->GetHid();
$MessageModel->CreateNewPost();
//printf("m");
}else{
$MessageModel = new MessageModel();
$MessageModel->ReplyPost();
//printf("re");
$tid = $_SESSION['thread_id'];
}

//echo '<script>window.location.href = "home.php";</script>'; 
echo "<script>window.location.href = 'posts_single.php?thread_id=".$tid."';</script>"; 

?>