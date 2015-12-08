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
                                  FROM Message as m, Thread t
                                  WHERE m.mid = t.initial_mid and t.tid = ?");
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
                                  FROM Message as m, Thread t
                                  WHERE m.tid = t.tid and t.tid = ? and m.mid not in (Select initial_mid From Thread)
                                  Order by m.timestamp");
        $stmt->bind_param('s', $tid);
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
        //$uid = 'u01';
        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        printf("b".$uid."aaa");
        
        
$ifexist=true;
$mid = mt_rand();
$title = $_POST['title_input'];    
$content = $_POST['content_input'];
$address = $_POST['address_input'];
//$author = $_SESSION['uid'];
$author = "u01";
$recipient_uid = $_POST['recipient_input'];
//$recipient_bid = $_POST['recipient_bid'];
//$recipient_hid = $_POST['recipient_hid'];
$recipient_bid = "b01";
$recipient_hid = "h01";
//$recipient_friend = "";
//$recipient_neighbors = "";
$tid = null;
        /*while($ifexist=true){
        echo"w";
        $stmt = $mysqli->prepare("SELECT mid from Message where mid = ?");
        if(mysql_num_rows($check) > 0){ 
                echo"re";
                $ifexist=true;
                $mid = mt_rand();
                }else{
                $ifexist=false;
                
                }
                return $ifexist;
            }*/


        $stmt = $mysqli->prepare("INSERT INTO Message(`mid`,`title`,`content`, `address`, `timestamp`,`author`, `recipient_uid`,`recipient_bid`, `recipient_hid`, `tid`) VALUES (?,?,?,?, NOW(),?,?,?,?,?);");
            $stmt->bind_param('sssssssss', $mid, $title, $content, $address, $author, $recipient_uid, $recipient_bid, $recipient_hid,$tid);
            $stmt->execute();
            $stmt -> fetch();
            $_SESSION['mid'] = $mid;
 printf("done");
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
 printf("done");
            $stmt->close();
            $mysqli->close();
            printf("done");

    }
}
?>
