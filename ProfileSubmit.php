<?php
include "include.php";

require 'Model/Credentials.php';
printf("A");
$uid = $_SESSION['uid'];
        //$uid = 'u01';
        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        printf("b".$uid."aaa");
        echo "Edit";
        
        
$uname = $_POST['uname_edit'];    
//$uid = $_POST['uid_input'];
$psw = $_POST['password_edit'];
$introduction = $_POST['intro_edit'];
$state = 'New York';
$city = 'New York';
$bid = $_POST['GetBlockList'];
$photo = "photo";
$address = $_POST['address_edit'];

        $stmt = $mysqli->prepare("UPDATE User SET `uname`= ?, `password` = ?, `introduction`=?, `address`=?, `bid`=? WHERE `uid`= ?;");
        $stmt->bind_param('ssssss', $uname, $psw, $introduction, $address,$bid, $uid);               
        $stmt->execute();
        $stmt -> fetch();


            $stmt->close();
            $mysqli->close();
            printf("b");
            
            
?>