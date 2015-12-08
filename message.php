<?php
include "include.php";
require 'Model/MessageModel.php';
printf("m2");

$MessageModel = new MessageModel();
$MessageModel->CreateNewPost();
printf("m");

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