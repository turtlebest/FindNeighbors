<?php
include "include.php";

include_once ("Entities/UserEntity.php");

//Contains database related code for the Coffee page.
class UserModel {

    function CreateAccount() {
       
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
        }else {
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
                    echo "new";      
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
    }

    function GetFriendNotify() {
        require 'Credentials.php';
        $uid = $_SESSION['uid'];

        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }

        $stmt = $mysqli->prepare("SELECT u.uid, u.uname
                                  FROM User as u, Relationship as r
                                  WHERE r.user2 = u.uid and r.user1 = ? and r.relationship = 'friends' and r.accept = FALSE");
        $stmt->bind_param('s', $uid);

        $stmt->execute();
        $stmt->bind_result($uid, $uname);

        $userArray = array();

        //Get data from database.
        while ($stmt->fetch()) {
            //Create coffee objects and store them in an array.
            $user = new UserEntity($uid, $uname, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
            array_push($userArray, $user);
        }
        //Close connection and return result
        $stmt->close();
        $mysqli->close();
        return $userArray;
    }

    function GetNeighborNotify() {
        require 'Credentials.php';
        $uid = $_SESSION['uid'];

        $mysqli = new mysqli($host, $user, $passwd, $database);
        $mysqli2 = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }

        $stmt = $mysqli->prepare("SELECT u.uid, u.uname
                                  FROM User as u, Relationship as r
                                  WHERE r.user2 = u.uid and r.user1 = ? and r.relationship = 'neighbors' and r.accept = FALSE");
        $stmt->bind_param('s', $uid);

        $stmt->execute();
        $stmt->bind_result($neighborid, $uname);

        $userArray = array();

        //Get data from database.
        while ($stmt->fetch()) {
            //Create coffee objects and store them in an array.
            $stmt2 = $mysqli2->prepare("UPDATE Relationship SET accept = '1' WHERE user1 = ? and user2 = ? and relationship ='neighbors';");
            $stmt2->bind_param('ss', $uid, $neighborid);
            $stmt2->execute();

            $user = new UserEntity($neighborid, $uname, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
            array_push($userArray, $user);
        }
        //Close connection and return result
        $stmt->close();
        $stmt2->close();
        $mysqli->close();
        $mysqli2->close();
        return $userArray;
    }

     function GetBlockNotify() {
        require 'Credentials.php';
        $uid = $_SESSION['uid'];

        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }

        $stmt = $mysqli->prepare("SELECT u2.uid, u2.uname
                                  FROM User as u1, User as u2
                                  WHERE u1.uid = ? and u1.bid = u2.bid and u2.approved = FALSE;");
        $stmt->bind_param('s', $uid);

        $stmt->execute();
        $stmt->bind_result($uid, $uname);

        $userArray = array();

        //Get data from database.
        while ($stmt->fetch()) {
            //Create coffee objects and store them in an array.
            $user = new UserEntity($uid, $uname, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
            array_push($userArray, $user);
        }
        //Close connection and return result
        $stmt->close();
        $mysqli->close();

        return $userArray;
    }

    function AcceptFriend($friendid) {
        require 'Credentials.php';
        $uid = $_SESSION['uid'];

        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }

        $stmt = $mysqli->prepare("UPDATE Relationship SET accept = '1' WHERE user1 = ? and user2 = ? and relationship ='friends';");
        $stmt->bind_param('ss', $uid, $friendid);
        $stmt->execute();

        //Close connection and return result
        $stmt->close();
        $mysqli->close();
        return $userArray;
    }

}

?>
