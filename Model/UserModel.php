<?php

require ("../Entities/UserEntity.php");
printf("a");
//Contains database related code for the Coffee page.
//class UserModel {

       //function CreateAccount($uid, $uname, $psw, $introduction, $photo, $address, $bid, $city, $state) {
        require ("Credentials.php");
        
        //Open connection and Select database. 
        printf("a");
        $mysqli = new mysqli($host, $user, $passwd, $database);
        
        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
if(isset($_SESSION["uid"])) {
  echo "You are already logged in. ";
}
else {
  echo "p";
  //if the user have entered _all_ entries in the form, insert into database
  if(isset($_POST['uid_input'])) {

    //check if username already exists in database
    echo "p";
      $stmt = $mysqli->prepare("SELECT uid from User where uid = ?");
      $stmt->bind_param('s', $uid);
      $stmt->execute();
      //$stmt->bind_result($phoneno);
        if ($stmt->fetch()) {
          echo "The userid already exists. ";
          echo "Click <a href=\"createaccount.php\">here</a> to try again.";

        }else{
 echo "q";      
$uname = $_POST['uname_input'];    
$uid = $_POST['uid_input'];
$psw = $_POST['password_input'];
$introduction = $_POST['intro_input'];
$state = 'New York';
$city = 'New York';
$bid = $_POST['GetBlockList'];
$photo = "photo";
$address = $_POST['address'];

        $stmt = $mysqli->prepare("INSERT INTO User (`uid`,`uname`, `password`, `introduction`, `photo`, `address`, `approved`, `bid`, `city`, `state`, `login_time`) VALUES (?, ?, ?, ?, ?, ?, 0, ?, ?, ?, NOW());");
            $stmt->bind_param('sssssssss', $uid, $uname, $psw, $introduction, $photo, $address, $bid, $city, $state);
            $stmt->execute();
            $stmt -> fetch();

            $stmt->close();
            $mysqli->close();
            printf("b");
     } 
    }
}
?>
