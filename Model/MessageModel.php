<?php

require ("Entities/MessageEntity.php");

//Contains database related code for the Coffee page.
class MessageModel {

    //Get coffeeEntity objects from the database and return them in an array.
    function GetNewPost() {
        require 'Credentials.php';

        $uid = $_SESSION['uid'];
        //$uid = 'u01';
        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        printf("b".$uid."aaa");
        $stmt = $mysqli->prepare("SELECT distinct m.mid, m.title, m.content, m.address, m.author, m.timestamp, m.tid
                                  FROM Message as m, User as u, block_hood as bh, Relationship as r
                                  WHERE (u.uid = ? AND u.bid = bh.bid AND u.login_time < m.timestamp AND (u.bid = m.recipient_bid OR bh.hid = m.recipient_hid)) 
                                  OR 
                                  (r.user2 = u.uid AND u.uid = ? AND u.login_time < m.timestamp AND r.relationship = 'neighbor' AND r.user1 = m.author AND m.recipient_neighbors = TRUE)
                                  OR
                                  (r.user2 = u.uid AND u.uid = ? AND u.login_time < m.timestamp AND r.relationship = 'friend' AND r.user1 = m.author AND m.recipient_friend = TRUE)");
        $stmt->bind_param('sss', $uid, $uid, $uid);
        $stmt->execute();
        $stmt->bind_result($mid, $title, $content, $address, $author, $timestamp, $tid);

        $messageArray = array();

        //Get data from database.
        while ($stmt->fetch()) {
            printf("c");
            //Create coffee objects and store them in an array.
            $message = new MessageEntity($mid, $title, $content, $address, $timestamp, $author, NULL, NULL, NULL, NULL, NULL, $tid);
            array_push($messageArray, $message);
        }
        //Close connection and return result
        $stmt->close();
        $mysqli->close();

        return $messageArray;
    }

    function GetBlockPost() {
        require 'Credentials.php';

        $uid = $_SESSION['uid'];
        //$uid = 'u01';
        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        printf("b".$uid."aaa");
        $stmt = $mysqli->prepare("SELECT distinct m.mid, m.title, m.content, m.address, m.author, m.timestamp, m.tid
                                  FROM Message as m, User as u
                                  WHERE u.bid = m.recipient_bid AND u.uid = ? ");
        $stmt->bind_param('s', $uid);
        $stmt->execute();
        $stmt->bind_result($mid, $title, $content, $address, $author, $timestamp, $tid);

        $messageArray = array();

        //Get data from database.
        while ($stmt->fetch()) {
            printf("c");
            //Create coffee objects and store them in an array.
            $message = new MessageEntity($mid, $title, $content, $address, $timestamp, $author, NULL, NULL, NULL, NULL, NULL, $tid);
            array_push($messageArray, $message);
        }
        //Close connection and return result
        $stmt->close();
        $mysqli->close();

        return $messageArray;
    }

    function GetNeighborPost() {
        require 'Credentials.php';

        $uid = $_SESSION['uid'];
        //$uid = 'u01';
        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        printf("b".$uid."aaa");
        $stmt = $mysqli->prepare("SELECT distinct m.mid, m.title, m.content, m.address, m.author, m.timestamp, m.tid
                                  FROM Message as m, User as u, block_hood as bh
                                  WHERE bh.bid = u.bid AND bh.hid = m.recipient_hid AND u.uid = ? ");
        $stmt->bind_param('s', $uid);
        $stmt->execute();
        $stmt->bind_result($mid, $title, $content, $address, $author, $timestamp, $tid);

        $messageArray = array();

        //Get data from database.
        while ($stmt->fetch()) {
            //printf("c");
            //Create coffee objects and store them in an array.
            //printf($tid."turtle");
            $message = new MessageEntity($mid, $title, $content, $address, $timestamp, $author, NULL, NULL, NULL, NULL, NULL, $tid);
            //printf($message->tid."ttttt");
            array_push($messageArray, $message);
        }
        //Close connection and return result
        $stmt->close();
        $mysqli->close();

        return $messageArray;
    }

    function GetSinglePostFirst($tid) {
        require 'Credentials.php';
        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        printf("b".$uid."aaa");
        $stmt = $mysqli->prepare("SELECT distinct m.mid, m.title, m.content, m.address, m.author, m.timestamp
                                  FROM Message as m
                                  WHERE m.tid = ?
                                  Order by m.timestamp
                                  Limit 1");
        $stmt->bind_param('s', $tid);
        $stmt->execute();
        $stmt->bind_result($mid, $title, $content, $address, $author, $timestamp);
        $stmt->fetch();

        printf("c");
        $message = new MessageEntity($mid, $title, $content, $address, $timestamp, $author, NULL, NULL, NULL, NULL, NULL, NULL);
        //Close connection and return result
        $stmt->close();
        $mysqli->close();

        return $message;
    }

    function GetSinglePostReply($tid) {
        require 'Credentials.php';
        //$uid = 'u01';
        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        printf("b".$uid."aaa");
        $stmt = $mysqli->prepare("SELECT distinct m.mid, m.title, m.content, m.address, m.author, m.timestamp
                                  FROM Message as m, Thread t,
                                       (SELECT m.mid
                                        FROM Message as m
                                        WHERE m.tid = ?
                                        Order by m.timestamp
                                        Limit 1) as f
                                  WHERE m.tid = t.tid and t.tid = ? and m.mid != f.mid");
        $stmt->bind_param('ss', $tid, $tid);
        $stmt->execute();
        $stmt->bind_result($mid, $title, $content, $address, $author, $timestamp);

        $messageArray = array();

        //Get data from database.
        while ($stmt->fetch()) {
            printf("c");
            //Create coffee objects and store them in an array.
            $message = new MessageEntity($mid, $title, $content, $address, $timestamp, $author, NULL, NULL, NULL, NULL, NULL, NULL);
            array_push($messageArray, $message);
        }
        //Close connection and return result
        $stmt->close();
        $mysqli->close();

        return $messageArray;
    }
    
    
    function CreateNewPost() {
        require 'Credentials.php';
        printf("A");
        $uid = $_SESSION['uid'];
        $uid = 'u01';
        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        printf("b".$uid."aaa");
        
        
//$ifexist=true;
$mid = mt_rand();
$title = $_POST['title_input'];    
$content = $_POST['content_input'];
$address = $_POST['address_input'];
//$author = $_SESSION['uid'];
$author = $uid;
$recipient_uid = $_POST['recipient_input'];
//$recipient_bid = $_POST['recipient_bid'];
//$recipient_hid = $_POST['recipient_hid'];
$recipient_bid = "b01";
$recipient_hid = "h01";
//$recipient_friend = "";
//$recipient_neighbors = "";
$tid = null;

        $stmt = $mysqli->prepare("SELECT mid from Message where mid = ?");
        $stmt->bind_param('s', $mid);
        $stmt->execute();
        
        while($stmt->fetch()){
        printf("re");
        $mid= mt_rand();
        }


        $stmt = $mysqli->prepare("INSERT INTO Message(`mid`,`title`,`content`, `address`, `timestamp`,`author`, `recipient_uid`,`recipient_bid`, `recipient_hid`, `tid`) VALUES (?,?,?,?, NOW(),?,?,?,?,?);");
        $stmt->bind_param('sssssssss', $mid, $title, $content, $address, $author, $recipient_uid, $recipient_bid, $recipient_hid,$tid);
        $stmt->execute();
        $stmt -> fetch();
        $_SESSION['mid'] = $mid;
 printf("done");
 
 $tid = mt_rand();
 
        $stmt = $mysqli->prepare("INSERT INTO thread(`tid`, `initial_mid`) VALUES(?,?);");
        $stmt->bind_param('ss', $tid, $mid);
        $stmt->execute();
        $stmt -> fetch();
        
        $stmt = $mysqli->prepare("UPDATE Message SET `tid`= ? WHERE `mid`= ?;");
        $stmt->bind_param('ss', $tid, $mid);               
        $stmt->execute();
        $stmt -> fetch();
        
        $stmt = $mysqli->prepare("INSERT INTO thread_participate(`tid`, `uid`) VALUES(?,?);");
        $stmt->bind_param('ss', $tid, $author);
        $stmt->execute();
        $stmt -> fetch();
        
            $stmt->close();
            $mysqli->close();
            printf("done");
            printf($mid);

    }
    
    function ReplyPost() {
        require 'Credentials.php';
        printf("A");
        $uid = $_SESSION['uid'];
        //$uid = 'u01';
        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        printf("b".$uid."aaa");
     
$mid = mt_rand();
$title = $_SESSION['title'];    
$content = $_POST['content_input'];
$address = $_POST['address_input'];
$author = $_SESSION['uid'];
$recipient_uid = $_SESSION['recipient_uid'];
$recipient_bid = $_SESSION['recipient_bid'];
$recipient_hid = $_SESSION['recipient_hid'];
$recipient_friend = $_SESSION['recipient_friend'];
$recipient_neighbors = $_SESSION['recipient_neighbors'];
$tid = $_SESSION['tid'];

        $stmt = $mysqli->prepare("INSERT INTO Message(`mid`,`title`,`content`, `address`, `timestamp`,`author`, `recipient_uid`,`recipient_bid`, `recipient_hid`, `tid`) VALUES (?,?,?,?, NOW(),?,?,?,?,?);");
            $stmt->bind_param('sssssssss', $mid, $title, $content, $address, $author, $recipient_uid, $recipient_bid, $recipient_hid,$tid);
            $stmt->execute();
            $stmt -> fetch();
            
            $stmt = $mysqli->prepare("INSERT INTO thread_participate(`tid`, `uid`) VALUES(?,?);");
            $stmt->bind_param('ss', $tid, $author);
            $stmt->execute();
            $stmt -> fetch();
 printf("done");
            $stmt->close();
            $mysqli->close();
            printf("done");

    }
    
    function GetFriends() {
        require 'Credentials.php';
        $uid = $_SESSION['uid'];
        $uid = 'u01';
        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        
        $stmt = $mysqli->prepare("SELECT user2 FROM Relationship WHERE user1 = ?  AND relationship = 'friends' AND accept = 1 ");
        $stmt->bind_param('s', $uid);
        $stmt->execute();
        $stmt->bind_result($uid);
        echo "Friends<br>";
        while($stmt->fetch()) {       
        echo  "<input type='checkbox' name='friends[]' value=$uid> $uid<br>";

		}
		echo "<br>";

        /*$friendsArray = array();
        
        //Get data from database.
        while ($stmt->fetch()) {
            //Create coffee objects and store them in an array.
            $friends = new OrderEntity($aname, $config, $ordertime, $quantity, $price, $status);
            array_push($orderArray, $order);
        }
        //Close connection and return result*/
        $stmt->close();
        $mysqli->close();
 
        //return $orderArray;
    }
    function GetNeighbors() {
        require 'Credentials.php';
        $uid = $_SESSION['uid'];
        $uid = 'u01';
        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        
        $stmt = $mysqli->prepare("SELECT user2 FROM Relationship WHERE user1 = ? AND relationship = 'neighbors'");
        $stmt->bind_param('s', $uid);
        $stmt->execute();
        $stmt->bind_result($uid);
        echo "Neighbors<br>";
        while($stmt->fetch()) {       
        echo  "<input type='checkbox' name='neighbors[]' value=$uid> $uid<br>";

		}
		echo "<br>";
		

        /*$friendsArray = array();
        
        //Get data from database.
        while ($stmt->fetch()) {
            //Create coffee objects and store them in an array.
            $friends = new OrderEntity($aname, $config, $ordertime, $quantity, $price, $status);
            array_push($orderArray, $order);
        }
        //Close connection and return result*/
        $stmt->close();
        $mysqli->close();
 
        //return $orderArray;
    }
}
?>
