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
        
        if(!isset($_POST['uname_edit']) || trim($_POST['uname_edit']) == ''){
        echo "fail";
        }else{
        
        $stmt = $mysqli->prepare("UPDATE User SET `uname`= ? WHERE `uid`= ?;");
        $stmt->bind_param('ss', $uname, $uid);               
        $stmt->execute();
        $stmt -> fetch();
        $stmt->close();
        $mysqli->close();
        }
        if(!isset($_POST['password_edit'])|| trim($_POST['password_edit']) == ''){
        //echo "fail";
        }else{
        
        $stmt = $mysqli->prepare("UPDATE User SET `password`= ? WHERE `uid`= ?;");
        $stmt->bind_param('ss', $psw, $uid);               
        $stmt->execute();
        $stmt -> fetch();
        $stmt->close();
        $mysqli->close();
        }
        if(!isset($_POST['intro_edit'])|| trim($_POST['intro_edit'])== ''){
        //echo "fail";
        }else{
        $stmt = $mysqli->prepare("UPDATE User SET `introduction`= ? WHERE `uid`= ?;");
        $stmt->bind_param('ss', $introduction,$uid);               
        $stmt->execute();
        $stmt -> fetch();
        $stmt->close();
        $mysqli->close();
        }
        if(!isset($_POST['address_edit'])|| trim($_POST['address_edit'])== ''){
        echo "fail";
        }else{
        $stmt = $mysqli->prepare("UPDATE User SET `address`= ? WHERE `uid`= ?;");
        $stmt->bind_param('ss', $address, $uid);               
        $stmt->execute();
        $stmt -> fetch();
        $stmt->close();
        $mysqli->close();
        }
        if(!isset($_POST['GetBlockList'])|| trim($_POST['GetBlockList'])== ''){
        echo "fail";
        }else{
        $stmt = $mysqli->prepare("UPDATE User SET `bid`= ? , `approved` = 0 WHERE `uid`= ?;");
        $stmt->bind_param('ss', $bid, $uid);               
        $stmt->execute();
        $stmt -> fetch();
        $stmt->close();
        $mysqli->close();
        }

        /*$stmt = $mysqli->prepare("UPDATE User SET `uname`= ?, `password` = ?, `introduction`=?, `address`=?, `bid`=? WHERE `uid`= ?;");
        $stmt->bind_param('ssssss', $uname, $psw, $introduction, $address,$bid, $uid);               
        $stmt->execute();
        $stmt -> fetch();*/


            //$stmt->close();
            //$mysqli->close();
            printf("b");
        echo '<script>window.location.href = "UserProfile.php";</script>'; 
            
            
?>