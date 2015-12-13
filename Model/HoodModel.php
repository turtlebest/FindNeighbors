<?php

require ("Entities/UserEntity.php");

//Contains database related code for the Coffee page.
class HoodModel {

    function GetMember() {
        require 'Credentials.php';
        $uid = $_SESSION['uid'];

        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }

        $stmt = $mysqli->prepare("SELECT u.uid, u.uname, u.address
                                  FROM User as u, block_hood as bh, (SELECT hid FROM User as u, block_hood as bh WHERE u.bid = bh.bid and u.uid = ?) as UserNeighbor
                                  WHERE u.bid = bh.bid and bh.hid = UserNeighbor.hid and u.approved = TRUE");
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

    function GetNeighborName() {
        require 'Credentials.php';
        $uid = $_SESSION['uid'];

        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }

        $stmt = $mysqli->prepare("SELECT h.hname
                                  FROM Blocks as b, User as u, block_hood as bh, Hoods as h
                                  WHERE b.bid = u.bid and bh.bid = b.bid and h.hid = bh.hid and u.uid = ?");
        $stmt->bind_param('s', $uid);

        $stmt->execute();
        $stmt->bind_result($hname);
        $stmt->fetch();
        //Close connection and return result
        $stmt->close();
        $mysqli->close();
        return $hname;
    }



}
?>
