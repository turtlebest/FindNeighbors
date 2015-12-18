<?php
include "include.php";

include_once ("Entities/MessageEntity.php");

//Contains database related code for the Coffee page.
class MessageModel {

    //Get coffeeEntity objects from the database and return them in an array.
    function GetNewPost() {
        require 'Credentials.php';

        $uid = $_SESSION['uid'];
        //$uid = 'u01';
        $mysqli = new mysqli($host, $user, $passwd, $database);
        $mysqli2 = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        printf("b".$uid."aaa");
       
        $stmt = $mysqli->prepare("SELECT distinct m.mid, m.title, m.content, m.address, m.author, m.timestamp, m.tid
                                  FROM Message as m, read_state as rs
                                  WHERE m.mid = rs.mid AND rs.uid = ? AND rs.read_date is NULL ");
        $stmt->bind_param('s', $uid);
        $stmt->execute();
        $stmt->bind_result($mid, $title, $content, $address, $author, $timestamp, $tid);

        $messageArray = array();

        //Get data from database.
        while ($stmt->fetch()) {
            printf("cf");
            /* $stmt2 = $mysqli2->prepare("UPDATE read_state SET read_date = NOW() WHERE mid = ? AND uid = ?");
            $stmt2->bind_param('ss', $mid, $uid);
            $stmt2->execute();
            $stmt2->close();
            printf("d");*/
            //$MessageModel = new MessageModel();
            $firstmessage = $this->GetSinglePostFirst($tid);
            printf("d");
            if ($firstmessage->mid != $mid) {
                printf("reply");
              $reply = TRUE;
            } else {
                printf("notr");
              $reply = FALSE;
            }
            //Create coffee objects and store them in an array.
            $message = new MessageEntity($mid, $title, $content, $address, $timestamp, $author, NULL, NULL, NULL, NULL, NULL, $tid, $reply);
            array_push($messageArray, $message);
        }
        //Close connection and return result
        $stmt->close();
        $mysqli->close();
         $mysqli2->close();

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
        $stmt = $mysqli->prepare("SELECT * FROM (SELECT distinct m.mid, m.title, m.content, m.address, m.author, m.timestamp, m.tid
                                  FROM Message as m, User as u
                                  WHERE u.bid = m.recipient_bid AND u.uid = ? 
                                  Order by m.timestamp) as t 
                                  Group by t.tid
                                  ");
        $stmt->bind_param('s', $uid);
        $stmt->execute();
        $stmt->bind_result($mid, $title, $content, $address, $author, $timestamp, $tid);

        $messageArray = array();

        //Get data from database.
        while ($stmt->fetch()) {
            printf("c");
            //Create coffee objects and store them in an array.
            $message = new MessageEntity($mid, $title, $content, $address, $timestamp, $author, NULL, NULL, NULL, NULL, NULL, $tid, NULL);
            array_push($messageArray, $message);
        }
        //Close connection and return result
        $stmt->close();
        $mysqli->close();

        return $messageArray;
    }

    function GetHoodPost() {
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
        $stmt = $mysqli->prepare("SELECT * FROM (SELECT distinct m.mid, m.title, m.content, m.address, m.author, m.timestamp, m.tid
                                  FROM Message as m, User as u, block_hood as bh
                                  WHERE bh.bid = u.bid AND bh.hid = m.recipient_hid AND u.uid = ? 
                                  Order by m.timestamp) as t
                                  Group by t.tid");
        $stmt->bind_param('s', $uid);
        $stmt->execute();
        $stmt->bind_result($mid, $title, $content, $address, $author, $timestamp, $tid);

        $messageArray = array();

        //Get data from database.
        while ($stmt->fetch()) {
            //printf("c");
            //Create coffee objects and store them in an array.
            //printf($tid."turtle");
            $message = new MessageEntity($mid, $title, $content, $address, $timestamp, $author, NULL, NULL, NULL, NULL, NULL, $tid, NULL);
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

        printf("first");
        printf("new");
        printf($tid);
        $_SESSION['tid']=$tid;
        $message = new MessageEntity($mid, $title, $content, $address, $timestamp, $author, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        //Close connection and return result
        $stmt->close();
        $mysqli->close();
        //printf($_SESSION['tid']);
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
        $stmt->bind_param('ss', $tid,$tid);
        $stmt->execute();
        $stmt->bind_result($mid, $title, $content, $address, $author, $timestamp);

        $messageArray = array();

        //Get data from database.
        while ($stmt->fetch()) {
            printf("c");
            //Create coffee objects and store them in an array.
            $message = new MessageEntity($mid, $title, $content, $address, $timestamp, $author, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
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
//$recipient_uid = 'u02';
$recipient_uid = $_POST['friendsORneighbors'];
$recipient_bid = null;
$recipient_hid = null;
$recipient_friend = 0;
$recipient_neighbors = 0;
$tid = null;
//$friends = $_POST["friends"];


if (isset($_POST['recipient_bid'])){
        $recipient_bid = $_SESSION['bid'];
        }
if (isset($_POST['recipient_hid'])){
        $recipient_hid = $_SESSION['hid'];
        }
if (isset($_POST['recipient_friend'])){
        $recipient_friend = 1;
        echo "p";
        
        
        foreach ($_SESSION['friendsArray'] as $key => $friends) {
            echo "f";
            //printf($mid);
            //printf($friends);
               $stmt = $mysqli->prepare("INSERT INTO read_state(`mid`, `uid`) VALUES(?,?);");
               $stmt->bind_param('ss', $mid, $friends);
               $stmt->execute();
               $stmt -> fetch();
        }
        }
if (isset($_POST['recipient_neighbor'])){
        $recipient_neighbors = 1;
        
        foreach($_SESSION['neighborsArray'] as $key => $neighbors){
                $stmt = $mysqli->prepare("INSERT INTO read_state(`mid`, `uid`) VALUES(?,?);");
        $stmt->bind_param('ss', $mid, $neighbors);
        $stmt->execute();
        $stmt -> fetch();
        }
        }


        $stmt = $mysqli->prepare("SELECT mid from Message where mid = ?");
        $stmt->bind_param('s', $mid);
        $stmt->execute();
        
        while($stmt->fetch()){
        printf("re");
        $mid= mt_rand();
        }


        
        $stmt = $mysqli->prepare("INSERT INTO Message(`mid`,`title`,`content`, `address`, `timestamp`,`author`,`recipient_friend`, `recipient_neighbors`, `recipient_uid`, `recipient_bid`, `recipient_hid`, `tid`) VALUES (?,?,?,?, NOW(),?,?,?,?,?,?,?);");
        $stmt->bind_param('sssssiissss', $mid, $title, $content, $address, $author,$recipient_friend, $recipient_neighbors, $recipient_uid, $recipient_bid, $recipient_hid,$tid);
        $stmt->execute();
        $stmt -> fetch();
        $_SESSION['mid'] = $mid;
 printf("done");
 
 $tid = mt_rand();
 
        $stmt = $mysqli->prepare("INSERT INTO thread(`tid`) VALUES(?);");
        $stmt->bind_param('s', $tid);
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


        if($author != $recipient_uid){
        $stmt = $mysqli->prepare("INSERT INTO read_state(`mid`, `uid`) VALUES(?,?);");
        $stmt->bind_param('ss', $mid, $recipient_uid);
        $stmt->execute();
        $stmt -> fetch();
        //echo "==";
        }
            $stmt->close();
            $mysqli->close();
            //printf($mid);

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
    
$content = $_POST['content_input'];
           
$tid = $_SESSION['thread_id'];
        $stmt = $mysqli->prepare("INSERT INTO thread(`tid`) VALUES(?);");
        $stmt->bind_param('s', $tid);
        $stmt->execute();
        $stmt -> fetch();
        
        
        $stmt = $mysqli->prepare("SELECT distinct m.title, m.address, m.author, m.recipient_friend, m.recipient_neighbors, m.recipient_uid, m.recipient_bid, m.recipient_hid FROM Message as m WHERE tid = ? ORDER by m.timestamp Limit 1;" );
        $stmt->bind_param('s', $tid);
        $stmt->execute();
        $stmt->bind_result($title, $address, $author, $recipient_friend, $recipient_neighbors, $recipient_uid, $recipient_bid, $recipient_hid);
        
        
        if($stmt -> fetch()){
        echo $tid;
        $message = new MessageEntity($mid, $title, $content, $address, NULL, $author,$recipient_friend, $recipient_neighbors,$recipient_uid, $recipient_bid, $recipient_hid, $tid,NULL);
        $title = $message->title;
        $address = $message->address;
        $author = $message->author;        
        $recipient_friend = $message->recipient_friend;
        //$recipient_friend =0;
        //$recipient_neighbors =0;
        $recipient_neighbors = $message->recipient_neighbors;
        $recipient_uid = $message->recipient_uid;
        $recipient_bid = $message->recipient_bid;
        $recipient_hid = $message->recipient_hid;
        //$recipient_hid =null;
        //echo $recipient_uid;
        
        $stmt->close();
            
       if($recipient_uid != $author && $recipient_uid == $uid){
       //$recipient_uid = $author;
       echo $recipient_uid;
       echo "<br>";
       echo $author;
       
        echo "author";
        $stmt = $mysqli->prepare("INSERT INTO Message(`mid`,`title`,`content`, `address`, `timestamp`,`author`,`recipient_friend`, `recipient_neighbors`, `recipient_uid`, `recipient_bid`, `recipient_hid`, `tid`) VALUES (?,?,?,?, NOW(),?,?,?,?,?,?,?);");
            $stmt->bind_param('sssssiissss', $mid, $title, $content, $address, $uid,$recipient_friend, $recipient_neighbors, $author, $recipient_bid, $recipient_hid, $tid);
            $stmt->execute();
            $stmt -> fetch();
            
        }else{
        $author = $uid;
        echo $mid;
        
        $stmt = $mysqli->prepare("INSERT INTO Message(`mid`,`title`,`content`, `address`, `timestamp`,`author`,`recipient_friend`, `recipient_neighbors`, `recipient_uid`, `recipient_bid`, `recipient_hid`, `tid`) VALUES (?,?,?,?, NOW(),?,?,?,?,?,?,?);");
        
        $stmt->bind_param('sssssiissss', $mid, $title, $content, $address, $uid,$recipient_friend, $recipient_neighbors, $uid, $recipient_bid, $recipient_hid,$tid);
        $stmt->execute();
        $stmt -> fetch();
        
        }
        
            $stmt = $mysqli->prepare("INSERT INTO thread_participate(`tid`, `uid`) VALUES(?,?);");
            $stmt->bind_param('ss', $tid, $uid);
            $stmt->execute();
            $stmt -> fetch();
 printf("done");
            
            if($author != $recipient_uid){
        $stmt = $mysqli->prepare("INSERT INTO read_state(`mid`, `uid`) VALUES(?,?);");
        $stmt->bind_param('ss', $mid, $recipient_uid);
        $stmt->execute();
        $stmt -> fetch();
        //echo "==";
        }
            
            $stmt->close();
            $mysqli->close();
            printf("done");
            }

    }
    
    function GetFriendsOrNeighbors() {
        require 'Credentials.php';
        $author = $_SESSION['uid'];
        echo "$author";
        $uid = $_SESSION['uid'];
        $mysqli = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        
        $stmt = $mysqli->prepare("SELECT distinct user2 FROM Relationship WHERE user1 = ?  AND ((relationship = 'friends' AND accept = 1 ) OR (relationship ='neighbors'))" );
        $stmt->bind_param('s', $uid);
        $stmt->execute();
        $stmt->bind_result($uid);
        
        echo "To<br>";
        echo "<select name='friendsORneighbors'>";
        echo "<option value=$author>  </option>"; 
              
        while($stmt->fetch()) { 
        echo "<option value=$uid> $uid</option>";      
        //echo  "<input type='checkbox' name='friends[]' value=$uid> $uid<br>";

		}
		echo "</select></p>";
		echo "<br>";

        
        //Close connection and return result*/
        $stmt->close();
        $mysqli->close();
 
        //return $orderArray;
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
        
        $stmt = $mysqli->prepare("SELECT user2 FROM Relationship WHERE user1 = ? AND relationship = 'friends'");
        $stmt->bind_param('s', $uid);
        $stmt->execute();
        $stmt->bind_result($uid);
        $friendsArray = array();
        while($stmt->fetch()) {       
        array_push($friendsArray, $uid);
		}
		
        //Close connection and return result*/
        $stmt->close();
        $mysqli->close();
        $_SESSION['friendsArray']=$friendsArray;
        //return $friendsArray;
 
        //return $orderArray;
    }
    
    function GetNeighbors() {
        require 'Credentials.php';
        $uid = $_SESSION['uid'];
        //$uid = 'u01';
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
        $neighborsArray = array();
        while($stmt->fetch()) {       
        array_push($neighborsArray, $uid);
		}

        
        //Close connection and return result*/
        $stmt->close();
        $mysqli->close();
        $_SESSION['neighborsArray']=$neighborsArray;
        //return $neighborsArray;
        
    }
    
      
    function GetUserPost($userid) {
        require 'Credentials.php';

        //$uid = $_SESSION['uid'];
        //$uid = 'u01';
        $mysqli = new mysqli($host, $user, $passwd, $database);
        //$mysqli2 = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        printf("b".$uid."aaa");
       
        $stmt = $mysqli->prepare("SELECT* FROM (SELECT m.mid, m.title, m.content, m.address, m.author, m.timestamp, m.tid 
                                FROM Message as m, User as u
                                WHERE u.uid=? AND (m.recipient_uid = ? OR (u.bid = m.recipient_bid AND u.approved = TRUE) OR m.author = ? OR m.recipient_hid in (SELECT hid FROM User as u, block_hood as bh WHERE u.bid = bh.bid AND u.uid = ? AND u.approved = TRUE))
                                Order by m.timestamp) as t
                                Group by t.tid                                
                                ");
       
       
        $stmt->bind_param('ssss', $userid, $userid, $userid, $userid);
        $stmt->execute();
        $stmt->bind_result($mid, $title, $content, $address, $author, $timestamp, $tid);

        $messageArray = array();

        //Get data from database.
        while ($stmt->fetch()) {
            //printf("cf");
            
            //Create coffee objects and store them in an array.
            $message = new MessageEntity($mid, $title, $content, $address, $timestamp, $author, NULL, NULL, NULL, NULL, NULL, $tid, $reply);
            array_push($messageArray, $message);
        }
        //Close connection and return result
        $stmt->close();
        $mysqli->close();
         //$mysqli2->close();

        return $messageArray;
    }
    
    function GetSearchPost($keyword) {
        require 'Credentials.php';

        $uid = $_SESSION['uid'];
        //$uid = 'u01';
        $mysqli = new mysqli($host, $user, $passwd, $database);
        //$mysqli2 = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        printf("b".$uid."aaa");
        $kw = '%'.$keyword.'%';
       
        $stmt = $mysqli->prepare("SELECT * FROM (SELECT m.mid, m.title, m.content, m.address, m.author, m.timestamp, m.tid 
                                FROM Message as m, User as u
                                WHERE u.uid=? AND (m.recipient_uid = ? OR (u.bid = m.recipient_bid AND u.approved = TRUE) OR m.author = ? OR m.recipient_hid in (SELECT hid FROM User as u, block_hood as bh WHERE u.bid = bh.bid AND u.uid = ? AND u.approved = TRUE))AND (m.title like ? OR m.content like ? OR m.address like ?)
                                Order by m.timestamp) as t
                                Group by t.tid
                                ");

        $stmt->bind_param('sssssss', $uid, $uid, $uid, $uid, $kw, $kw, $kw);
        $stmt->execute();
        $stmt->bind_result($mid, $title, $content, $address, $author, $timestamp, $tid);

        $messageArray = array();

        //Get data from database.
        while ($stmt->fetch()) {
            //printf("keywork");
            
            $message = new MessageEntity($mid, $title, $content, $address, $timestamp, $author, NULL, NULL, NULL, NULL, NULL, $tid, $reply);
            array_push($messageArray, $message);
        }
        //Close connection and return result
        $stmt->close();
        $mysqli->close();
         //$mysqli2->close();

        return $messageArray;
    }

        function GetFriendPost() {
        require 'Credentials.php';

        $uid = $_SESSION['uid'];
        //$uid = 'u01';
        $mysqli = new mysqli($host, $user, $passwd, $database);
        //$mysqli2 = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        printf("b".$uid."aaa");
       
        $stmt = $mysqli->prepare("SELECT* FROM (SELECT m.mid, m.title, m.content, m.address, m.author, m.timestamp, m.tid 
                                FROM Message as m, User as u, Relationship as r
                                WHERE u.uid=? AND (m.recipient_uid = ? OR (u.bid = m.recipient_bid AND u.approved = TRUE) OR m.author = ? OR m.recipient_hid in (SELECT hid FROM User as u, block_hood as bh WHERE u.bid = bh.bid AND u.uid = ? AND u.approved = TRUE)) AND (r.user1 = u.uid AND r.user2 = m.author AND r.relationship ='friends' AND r.accept=TRUE)
                                Order by m.timestamp) as t
                                Group by t.tid                                
                                ");
       
       
        $stmt->bind_param('ssss', $uid, $uid, $uid, $uid);
        $stmt->execute();
        $stmt->bind_result($mid, $title, $content, $address, $author, $timestamp, $tid);

        $messageArray = array();

        //Get data from database.
        while ($stmt->fetch()) {
            //printf("cf");
            
            //Create coffee objects and store them in an array.
            $message = new MessageEntity($mid, $title, $content, $address, $timestamp, $author, NULL, NULL, NULL, NULL, NULL, $tid, $reply);
            array_push($messageArray, $message);
        }
        //Close connection and return result
        $stmt->close();
        $mysqli->close();
         //$mysqli2->close();

        return $messageArray;
    }
    
    function GetNeighborPost() {
        require 'Credentials.php';

        $uid = $_SESSION['uid'];
        //$uid = 'u01';
        $mysqli = new mysqli($host, $user, $passwd, $database);
        //$mysqli2 = new mysqli($host, $user, $passwd, $database);

        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
        printf("b".$uid."aaa");
       
        $stmt = $mysqli->prepare("SELECT* FROM (SELECT m.mid, m.title, m.content, m.address, m.author, m.timestamp, m.tid 
                                FROM Message as m, User as u, Relationship as r
                                WHERE u.uid=? AND (m.recipient_uid = ? OR (u.bid = m.recipient_bid AND u.approved = TRUE) OR m.author = ? OR m.recipient_hid in (SELECT hid FROM User as u, block_hood as bh WHERE u.bid = bh.bid AND u.uid = ? AND u.approved = TRUE)) AND (r.user1 = u.uid AND r.user2 = m.author AND r.relationship ='neighbors')
                                Order by m.timestamp) as t
                                Group by t.tid                                
                                ");
       
       
        $stmt->bind_param('ssss', $uid, $uid, $uid, $uid);
        $stmt->execute();
        $stmt->bind_result($mid, $title, $content, $address, $author, $timestamp, $tid);

        $messageArray = array();

        //Get data from database.
        while ($stmt->fetch()) {
            //printf("cf");
            
            //Create coffee objects and store them in an array.
            $message = new MessageEntity($mid, $title, $content, $address, $timestamp, $author, NULL, NULL, NULL, NULL, NULL, $tid, $reply);
            array_push($messageArray, $message);
        }
        //Close connection and return result
        $stmt->close();
        $mysqli->close();
         //$mysqli2->close();

        return $messageArray;
    }

}

?>
