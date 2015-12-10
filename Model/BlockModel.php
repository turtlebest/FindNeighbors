<?php

require ("Entities/UserEntity.php");

//Contains database related code for the Coffee page.
class BlockModel {

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

        $stmt = $mysqli->prepare("SELECT u.uid, u.uname, u.address
                                  FROM User as u, (SELECT bid FROM User WHERE uid = ?) as UserBlock
                                  WHERE u.bid = UserBlock.bid and u.approved = TRUE");
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

    function GetBlockName() {
        require 'Credentials.php';
        $uid = $_SESSION['uid'];

        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }

        $stmt = $mysqli->prepare("SELECT b.bname
                                  FROM Blocks as b, User as u
                                  WHERE b.bid = u.bid and u.uid = ?");
        $stmt->bind_param('s', $uid);

        $stmt->execute();
        $stmt->bind_result($bname);
        $stmt->fetch();
        //Close connection and return result
        $stmt->close();
        $mysqli->close();
        return $bname;
    }

}
?>
