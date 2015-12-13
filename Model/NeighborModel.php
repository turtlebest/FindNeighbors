<?php

require ("Entities/UserEntity.php");

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

}
?>
