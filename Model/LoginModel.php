<?php

require_once ("Entities/UserEntity.php");

//Contains database related code for the Coffee page.
class LoginModel {

    //Get coffeeEntity objects from the database and return them in an array.
    function CheckUser($uid, $psw) {
        require 'Credentials.php';
        $mysqli = new mysqli($host, $user, $passwd, $database);
printf("a");
        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
printf("b");
printf($uid);
printf($psw);
        $stmt = $mysqli->prepare("SELECT uname, approved FROM User WHERE uid = ? and password = ?");
        $stmt->bind_param('ss', $uid, $psw);

        $stmt->execute();
        $stmt->bind_result($uname, $approved);
        $stmt -> fetch();
      printf("f");

        if(empty($uname)){
            printf("d");
            $Correct = FALSE;
        } else {
            printf("e");
            $Correct = TRUE;
        }

        $stmt->close();

        if ($Correct) {
            $stmt = $mysqli->prepare("UPDATE User SET login_time = NOW() WHERE uid = ?");
            $stmt->bind_param('s', $uid);
            $stmt->execute();
            $stmt->close();
        }

        if (!$approved) {
            printf("notap".$approved);
            $approved = $this->CheckBlockApprove();
            printf($approved);
        }
        //Close connection and return result
         printf("g");
        $mysqli->close();
        printf($Correct);
        return array($Correct, $approved);
    }
    
    
    function GetUserInfo(){
    
        require 'Credentials.php';
        $mysqli = new mysqli($host, $user, $passwd, $database);
        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
printf("b");
$uid = $_SESSION['uid'];
$psw = $_SESSION['password'];
printf($uid);
printf($psw);

        $stmt = $mysqli->prepare("SELECT uname, password, introduction, address FROM User WHERE uid = ? and password = ?");
        $stmt->bind_param('ss', $uid, $psw);

        $stmt->execute();
        $stmt->bind_result($uname, $psw,$introduction, $address);
        if($stmt -> fetch()){
        $_SESSION['uname'] = $uname;
        $_SESSION['introduction'] = $introduction;
        $_SESSION['address'] = $address;
        }
    }

     function CheckBlockApprove(){
    
       require 'Credentials.php';

       printf("notblock");
        $mysqli = new mysqli($host, $user, $passwd, $database);
        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        $uid = $_SESSION['uid'];


        $stmt = $mysqli->prepare("SELECT COUNT(u2.uid) as number
                                  FROM User as u1, User as u2
                                  WHERE u1.uid = ? and u1.bid = u2.bid and u2.approved = TRUE");
        $stmt->bind_param('s', $uid);

        $stmt->execute();
        $stmt->bind_result($membernumber);
        $stmt->fetch();
        $stmt->close();

        if ($membernumber > 3) {
            $membernumber = 3;
        }

        $stmt = $mysqli->prepare("SELECT COUNT(approver) as number
                                  FROM Application
                                  WHERE applicant = ?");
        $stmt->bind_param('s', $uid);

        $stmt->execute();
        $stmt->bind_result($approvenumber);
        $stmt->fetch();
        $stmt->close();

        if ($approvenumber = $membernumber) {
          $uid = $_SESSION['uid'];
          $stmt = $mysqli->prepare("UPDATE User SET approved = TRUE WHER uid = ?");
          $stmt->bind_param('s', $uid);
          $stmt->execute();
          $stmt->close();
          $mysqli->close();

          return TRUE;
        } else {
          $mysqli->close();

          return FALSE;
        }
    }




}
?>
