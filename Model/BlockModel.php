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

    function GetBid() {
        require 'Credentials.php';
        $uid = $_SESSION["uid"];
        //uid='u01';
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
        $mysqli->close();

        $_SESSION['bid'] = $bid;

        }

    function GetHid() {
        require 'Credentials.php';
        //$uid = $_SESSION["uid"];
        $uid='u01';
        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }

        $stmt = $mysqli->prepare("SELECT hid FROM User, block_hood WHERE User.bid = block_hood.bid AND uid = ?");
        $stmt->bind_param('s', $uid);
        $stmt->execute();
        $stmt->bind_result($hid);
        $stmt->fetch();

        $stmt->close();
        $mysqli->close();

        $_SESSION['hid'] = $hid;
        
        }
        
        function GetBlockList() {
        require 'Credentials.php';
        //$uid = $_SESSION["uid"];
        //$uid='u01';
        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        
        $stmt = $mysqli->prepare("SELECT bid, bname FROM Blocks");
        //$stmt->bind_param('s', $uid);
        $stmt->execute();
        $stmt->bind_result($bid, $bname);
        
        //echo "<select name='GetBlockList'>";
        
              
        while($stmt->fetch()) { 
        echo "<option value=$bid> $bname</option>";      
        //echo  "<input type='checkbox' name='friends[]' value=$uid> $uid<br>";

		}
		echo "</select></p>";
		echo "<br>";

    
        $stmt->close();
        $mysqli->close();
        //$_SESSION['blockssArray']=$blockssArray;

        
        }
    

}
?>
