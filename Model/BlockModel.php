<?php

require ("Entities/UserEntity.php");

//Contains database related code for the Coffee page.
class BlockModel {

    //Get coffeeEntity objects from the database and return them in an array.
    function GetMember($keyword) {
        require 'Credentials.php';
        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }

        $kw = '%'.$keyword.'%';
        $stmt = $mysqli->prepare("SELECT a.aname, a.description, c.config, c.price, c.status FROM appliance a join catalog c on a.aname = c.aname WHERE (a.description LIKE ? or a.aname Like ? or c.config Like ?) and c.status = 'available' Group By a.aname, c.config");
        $stmt->bind_param('sss', $kw, $kw, $kw);

        $stmt->execute();
        $stmt->bind_result($aname, $description, $config, $price, $status);

        $applianceArray = array();
        
        //Get data from database.
        while ($stmt->fetch()) {
            //Create coffee objects and store them in an array.
            $appliance = new ApplianceEntity($aname, $description, $config, $price, $status);
            array_push($applianceArray, $appliance);
        }
        //Close connection and return result
        $stmt->close();
        $mysqli->close();
        return $applianceArray;
    }
    
    function GetBid() {
        require 'Credentials.php';
        //$uid = $_SESSION["uid"];
        $uid='u01';
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
    
    function GetOrder() {
        require 'Credentials.php';
        $phone = $_SESSION["userphone"];

        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        
        $stmt = $mysqli->prepare("SELECT aname, config, o_time, quantity, price, status FROM orders WHERE phone = ?");
        $stmt->bind_param('s', $phone);
        $stmt->execute();
        $stmt->bind_result($aname, $config, $ordertime, $quantity, $price, $status);

        $orderArray = array();
        
        //Get data from database.
        while ($stmt->fetch()) {
            //Create coffee objects and store them in an array.
            $order = new OrderEntity($aname, $config, $ordertime, $quantity, $price, $status);
            array_push($orderArray, $order);
        }
        //Close connection and return result
        $stmt->close();
        $mysqli->close();
 
        return $orderArray;
    }

}
?>
