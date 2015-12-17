<?php
include "include.php";
require 'Model/UserModel.php';
//require 'Model/BlockModel.php';

printf("u2");


$UserModel = new UserModel();
$UserModel->CreateAccount();


?>