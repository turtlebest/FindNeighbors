<?php

require ("Entities/ApplianceEntity.php");
require ("Entities/OrderEntity.php");

//Contains database related code for the Coffee page.
class TrackOrderModel {

    //Get coffeeEntity objects from the database and return them in an array.
    function GetApplianceConfig($keyword) {
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
    
    function UpdateCustomer($bunum, $street, $apt) {
        require 'Credentials.php';
        $phone = $_SESSION["userphone"];

        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        
        $stmt = $mysqli->prepare("SELECT building_num, street, apartment FROM customer WHERE phone = ?");
        $stmt->bind_param('s', $phone);
        $stmt->execute();
        $rownum = $stmt->num_rows;
        $stmt->bind_result($d_bunum, $d_street, $d_apt);
        $stmt -> fetch();

        if(empty($d_bunum)){
            $stmt->close();
            $stmt = $mysqli->prepare("INSERT INTO customer (`phone`, `building_num`, `street`, `apartment`) VALUES (?, ?, ?, ?);");
            $stmt->bind_param('siss', $phone, $bunum, $street, $apt);
            $stmt->execute();          
        } else {           
            if ($d_bunum != $bunum || $d_street != $street || $d_apt != $apt) {
                $stmt->close();
                $stmt = $mysqli->prepare("UPDATE customer SET `building_num`= ?, `street`= ?, `apartment`= ? WHERE `phone`= ?;");
                $stmt->bind_param('isss', $bunum, $street, $apt, $phone);               
                $stmt->execute();
            }
        }
        
        $stmt->close();
        $mysqli->close();
    }
    
    function SetOrder($aname, $config, $price) {
        require 'Credentials.php';
        $phone = $_SESSION["userphone"];
        
        //Open connection and Select database. 
        
        $mysqli = new mysqli($host, $user, $passwd, $database);
        
        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        
        $stmt = $mysqli->prepare("SELECT o_time, quantity, price FROM orders WHERE phone = ? and aname = ? and config= ? and status = 'pending';");
        $stmt->bind_param('sss', $phone, $aname, $config);
        $stmt->execute();       
        $stmt->bind_result($ordertime, $qty, $oldprice);
        $stmt -> fetch();

        if (empty($ordertime)) {
            $stmt->close();
            $stmt = $mysqli->prepare("INSERT INTO orders (`phone`, `aname`, `config`, `o_time`, `quantity`, `price`, `status`) VALUES (?, ?, ?, NOW(), 1, ?, 'pending');");
            $stmt->bind_param('sssd', $phone, $aname, $config, $price);
            $stmt->execute();
        } else {
            $qty = $qty + 1;
            $newprice = $oldprice + $price;
            $stmt->close();
            $stmt = $mysqli->prepare("UPDATE orders SET `o_time`= NOW(), `quantity`= ?, `price`= ? WHERE `phone`= ? and`aname`= ? and`config`= ? and`o_time`= ?;");
            $stmt->bind_param('idssss', $qty, $newprice, $phone, $aname, $config, $ordertime);
            $stmt->execute();
            $stmt->close();
        }      
        //Close connection and return result.
        $stmt->close();
        $mysqli->close();
    }

}
?>
