<?php
include "include.php";

include_once ("Entities/UserEntity.php");

//Contains database related code for the Coffee page.
class UserModel {

    function CreateAccount() {
        require ("Credentials.php");
        
        //Open connection and Select database. 
        //printf("a");
        $mysqli = new mysqli($host, $user, $passwd, $database);
        
        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        if(isset($_SESSION["uid"])) {
            echo "You are already logged in. ";
        }else {
            //echo "p";
  //if the user have entered _all_ entries in the form, insert into database
            if(isset($_POST['uid_input'])) {

    //check if username already exists in database
                //echo "p";
                $stmt = $mysqli->prepare("SELECT uid from User where uid = ?");
                $stmt->bind_param('s', $uid);
                $stmt->execute();
      //$stmt->bind_result($phoneno);
                if ($stmt->fetch()) {
                    echo "The userid already exists. ";
                    echo "Click <a href=\"createaccount.php\">here</a> to try again.";

                }else{
                    //echo "new";      
$uname = $_POST['uname_input'];    
$uid = $_POST['uid_input'];
$psw = $_POST['password_input'];
$introduction = $_POST['intro_input'];
$state = 'New York';
$city = 'New York';
$bid = $_POST['GetBlockList'];
$photo = "photo";
$address = $_POST['address_input'];

           $stmt = $mysqli->prepare("SELECT bid
                                     FROM User
                                     WHERE bid = ? ;");
           $stmt->bind_param('s', $bid);
           $stmt->execute();

           if(!$stmt->fetch()){
           //echo "numbid";
           $stmt->close();
           $stmt = $mysqli->prepare("INSERT INTO User (`uid`,`uname`, `password`, `introduction`, `photo`, `address`, `approved`, `bid`, `city`, `state`, `login_time`) VALUES (?, ?, ?, ?, ?, ?, 1, ?, ?, ?, NOW());");
            $stmt->bind_param('sssssssss', $uid, $uname, $psw, $introduction, $photo, $address, $bid, $city, $state);
            $stmt->execute();
            $stmt -> fetch();
            }else{
            $stmt->close();
            $stmt = $mysqli->prepare("INSERT INTO User (`uid`,`uname`, `password`, `introduction`, `photo`, `address`, `approved`, `bid`, `city`, `state`, `login_time`) VALUES (?, ?, ?, ?, ?, ?, 0, ?, ?, ?, NOW());");
            $stmt->bind_param('sssssssss', $uid, $uname, $psw, $introduction, $photo, $address, $bid, $city, $state);
            $stmt->execute();
            $stmt -> fetch();
            }
            

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
                                  WHERE r.user2 = ? and r.user1 = u.uid and r.relationship = 'friends' and r.accept = FALSE");
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
                                  WHERE r.user2 = ? and r.user1 = u.uid and r.relationship = 'neighbors' and r.accept = FALSE");
        $stmt->bind_param('s', $uid);

        $stmt->execute();
        $stmt->bind_result($neighborid, $uname);

        $userArray = array();

        //Get data from database.
        while ($stmt->fetch()) {
            //Create coffee objects and store them in an array.
            $stmt2 = $mysqli2->prepare("UPDATE Relationship SET accept = TRUE WHERE user1 = ? and user2 = ? and relationship ='neighbors';");
            $stmt2->bind_param('ss', $neighborid, $uid);
            $stmt2->execute();

            $stmt2->close();

            $user = new UserEntity($neighborid, $uname, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
            array_push($userArray, $user);
        }
        //Close connection and reurn result
        $stmt->close();
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

        $stmt = $mysqli->prepare("SELECT u2.uid, u2.uname
                                  FROM User as u, Application as a, User as u2
                                  WHERE u.bid = a.bid and u2.uid = a.applicant and u.uid = ? and u2.approved = 'FALSE' and u.uid not in (Select approver From Application Where applicant = u2.uid)
                                  Group by a.applicant
                                  Having Count(*) < ?");
        $stmt->bind_param('si', $uid, $membernumber);

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

        $uid = $_SESSION['uid'];

        $stmt = $mysqli->prepare("SELECT distinct u2.uid, u2.uname
                                  FROM User as u, Application as a, User as u2
                                  WHERE u2.bid = u.bid and u.uid = ? and u2.approved = 'FALSE' and u2.uid not in (Select applicant From Application)
                                ");
        $stmt->bind_param('s', $uid);

        $stmt->execute();
        $stmt->bind_result($uid, $uname);

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
        $stmt->bind_param('ss', $friendid, $uid);
        $stmt->execute();

        //Close connection and return result
        $stmt->close();
        $mysqli->close();
        return $userArray;
    }

    function GetUserInfo($userid){
        require 'Credentials.php';
        $mysqli = new mysqli($host, $user, $passwd, $database);
        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }


        $stmt = $mysqli->prepare("SELECT uname, password, introduction, address FROM User WHERE uid = ?");
        $stmt->bind_param('s', $userid);

        $stmt->execute();
        $stmt->bind_result($uname, $psw,$introduction, $address);

        $userArray = array();
        //echo "user";
        while($stmt -> fetch()){
        //echo "user";
        
        $user = new UserEntity($uid, $uname, $password, $introduction, NULL, $address, NULL, NULL, NULL, NULL, NULL);
        array_push($userArray, $user);
            
        //$_SESSION['uname'] = $uname;
        //$_SESSION['password'] =$pwd;
        //$_SESSION['introduction'] = $introduction;
        //$_SESSION['address'] = $address;
        }
        $stmt->close();
        $mysqli->close();

        return $userArray;
    }


    function ApproveMember($memberid) {
        require 'Credentials.php';
        $uid = $_SESSION['uid'];

        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }

        $stmt = $mysqli->prepare("SELECT bid FROM User WHERE uid = ?");
        $stmt->bind_param('s', $uid);
        $stmt->execute();
        $stmt->bind_result($bid);
        $stmt->fetch();
        $stmt->close();

        printf($memberid);

        $stmt = $mysqli->prepare("INSERT INTO Application (`applicant`, `approver`, `bid`) VALUES (?, ?, ?);");
        $stmt->bind_param('sss', $memberid, $uid, $bid);
        $stmt->execute();

        //Close connection and return result
        $stmt->close();
        $mysqli->close();
        return $userArray;
    }

    function GetUserProfile(){

        $uid = $_SESSION['uid'];

        require 'Credentials.php';
        $mysqli = new mysqli($host, $user, $passwd, $database);
        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }


        $stmt = $mysqli->prepare("SELECT uname, password, introduction, address FROM User WHERE uid = ?");
        $stmt->bind_param('s', $uid);

        $stmt->execute();
        $stmt->bind_result($uname, $password, $introduction, $address);
        
        $userArray = array();
        //echo "user";
        while($stmt -> fetch()){
        //echo "user";
        
        $user = new UserEntity($uid, $uname, $password, $introduction, NULL, $address, NULL, NULL, NULL, NULL, NULL);
        array_push($userArray, $user);
            
        //$_SESSION['uname'] = $uname;
        //$_SESSION['password'] =$pwd;
        //$_SESSION['introduction'] = $introduction;
        //$_SESSION['address'] = $address;
        }
        $stmt->close();
        $mysqli->close();

        return $userArray;
    }
    
    function CheckRelationship($userid){
    
        $uid = $_SESSION['uid'];
    require 'Credentials.php';
        $mysqli = new mysqli($host, $user, $passwd, $database);
        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }

        $stmt = $mysqli->prepare("SELECT user2 FROM Relationship WHERE user1 = ? AND user2 = ? AND relationship = 'friends' AND accept = TRUE ");
        $stmt->bind_param('ss', $uid, $userid);
        $stmt->execute();
        $stmt->bind_result($user2);
        //$stmt->fetch();
        //echo "user";
        $IsFriend = 1;
        $IsNeighbor = 1;
        $FriendRequest = 0;
        
        if(!$stmt->fetch()){
        $IsFriend = 0;    
        }
        
        $stmt->close();
        
        $stmt = $mysqli->prepare("SELECT user2 FROM Relationship WHERE user1 = ? AND user2 = ? AND relationship = 'friends' AND accept = FALSE ");
        $stmt->bind_param('ss', $uid, $userid);
        $stmt->execute();
        $stmt->bind_result($user2);
        
        if($stmt->fetch()){
        $FriendRequest = 1;    
        }
        
        $stmt->close();
        
        $stmt = $mysqli->prepare("SELECT user2 FROM Relationship WHERE user1 = ? AND user2 = ? AND relationship = 'neighbors'");
        $stmt->bind_param('ss', $uid, $userid);
        $stmt->execute();
        $stmt->bind_result($user2);
        //$stmt2->fetch();
        
        if(!$stmt->fetch()){
        $IsNeighbor = 0;

        //echo "<a class='blog_readmore' href='Profiledit.php'>Add Neighbor</a>";

        }
        
        $stmt->close();
        //$stmt2->close();
        $mysqli->close();
        //$mysqli2->close();
        return array($IsFriend, $IsNeighbor, $FriendRequest);
    }
    
}

?>
