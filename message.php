<?php
include "include.php";
require 'Model/MessageModel.php';
printf("m2");

if (isset($_POST['title_input'])){
$MessageModel = new MessageModel();
$MessageModel->CreateNewPost();
printf("m");
}else{
$MessageModel = new MessageModel();
$MessageModel->ReplyPost();
printf("re");
}

/*<?php
include "include.php";
require 'Model/MessageModel.php';
printf("m2");

$MessageModel = new MessageModel();

if ($_POST['title'] != NULL || $_POST['content'] != NULL){
    $MessageModel->CreateNewPost();
    printf("m");
}
printf("m2");
?>*/
?>