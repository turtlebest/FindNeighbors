<?php

include_once ("Entities/UserEntity.php");

//Contains database related code for the Coffee page.
class NeighborModel {

    //Get coffeeEntity objects from the database and return them in an array.
    function GetMember() {
        require 'Credentials.php';
        $uid = $_SESSION['uid'];

        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }

        $stmt = $mysqli->prepare("SELECT u2.uid, u2.uname, u2.address
                                  FROM User as u1, Relationship as r, User as u2
                                  WHERE u1.uid = r.user1 and u2.uid = r.user2 and u1.uid = ? and r.relationship = 'neighbors'");
        $stmt->bind_param('s', $uid);

        $stmt->execute();
        $stmt->bind_result($uid, $uname, $address);

        $userArray = array();

        //Get data from database.
        while ($stmt->fetch()) {
            //Create coffee objects and store them in an array.
            $user = new UserEntity($uid, $uname, NULL, NULL, NULL, $address, NULL, NULL, NULL, NULL, NULL);
            array_push($userArray, $user);
        }
        //Close connection and return result
        $stmt->close();
        $mysqli->close();
        return $userArray;
    }
    function GetNeighborProfile(){
        require 'Credentials.php';
        $uid = $_SESSION['uid'];

        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        
        $stmt = $mysqli->prepare("SELECT distinct uid, uname, introduction, address
                                  FROM User as u, Relationship as r
                                  WHERE u.uid = r.user2 AND relationship = 'neighbors' AND r.user1 = ? ");
        $stmt->bind_param('s', $uid);
        $stmt->execute();
        $stmt->bind_result($uid, $uname, $introduction, $address);

        $neighborArray = array();

        //Get data from database.
        while ($stmt->fetch()) {
            printf("c");
            //Create coffee objects and store them in an array.
            $neighbor = new UserEntity($uid, $uname, NULL, $introduction, NULL, $address, NULL, NULL, NULL, NULL, NULL);
            array_push($neighborArray, $neighbor);
        }
        //Close connection and return result
        $stmt->close();
        $mysqli->close();

        return $neighborArray;
    }
    
    function GetBlockNeighbors() {
        require 'Credentials.php';
        $uid = $_SESSION['uid'];

        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }

         $stmt = $mysqli->prepare("SELECT distinct u.uid, u.uname, u.address, u.introduction
                                  FROM User as u, (SELECT bid FROM User WHERE uid = ?) as UserBlock
                                  WHERE u.bid = UserBlock.bid AND u.uid not in (SELECT user2 FROM Relationship WHERE relationship = 'neighbors' AND user1 = ?)" );
                                  
        /*$stmt = $mysqli->prepare("SELECT distinct uid, uname, introduction, address
                                  FROM User as u1, Relationship as r, User as u2
                                  WHERE u1.uid = ? AND r.user1 = ? ");*/
        $stmt->bind_param('ss', $uid, $uid);

        $stmt->execute();
        $stmt->bind_result($uid, $uname, $address, $introduction);

        $neighborArray = array();

        //Get data from database.
        while ($stmt->fetch()) {
            if($uid != $_SESSION['uid']){
            //Create coffee objects and store them in an array.
            $neighbor = new UserEntity($uid, $uname, NULL, $introduction, NULL, $address, NULL, NULL, NULL, NULL, NULL);
            array_push($neighborArray, $neighbor);
            }
        }
        //Close connection and return result
        $stmt->close();
        $mysqli->close();

        return $neighborArray;
    }
    
    function AddNeighbor($user2){
        require 'Credentials.php';
        $uid = $_SESSION['uid'];

        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
$relationship = "neighbors";        
        
        
        $stmt = $mysqli->prepare("INSERT INTO Relationship(`user1`,`user2`,`relationship`, `accept`) VALUES (?,?,?,0);");
            $stmt->bind_param('sss', $uid, $user2, $relationship);
            $stmt->execute();
            $stmt -> fetch();
        

    }
    
    function GetSearchNeighbor($keyword){
        require 'Credentials.php';
        $uid = $_SESSION['uid'];

        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        $kw = '%'.$keyword.'%';
        $stmt = $mysqli->prepare("SELECT distinct uid, uname, introduction, address
                                  FROM User as u, Relationship as r
                                  WHERE u.uid = r.user2 AND relationship = 'neighbors' AND r.user1 = ? AND (u.uid like ? OR u.uname like ? OR u.introduction like ? OR u.address like ?)");
        $stmt->bind_param('sssss', $uid, $kw, $kw, $kw, $kw);
        $stmt->execute();
        $stmt->bind_result($uid, $uname, $introduction, $address);

        $neighborArray = array();
        //r.relationship = 'neighbors'
        //Get data from database.
        while ($stmt->fetch()) {
            //printf("c");
            //Create coffee objects and store them in an array.
            $neighbor = new UserEntity($uid, $uname, NULL, $introduction, NULL, $address, NULL, NULL, NULL, NULL, NULL);
            array_push($neighborArray, $neighbor);
        }
        //Close connection and return result
        $stmt->close();
        $mysqli->close();

        return $neighborArray;
    }
}
?>
