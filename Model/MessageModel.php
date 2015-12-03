<?php

require ("Entities/MessageEntity.php");

//Contains database related code for the Coffee page.
class MessageModel {

    //Get coffeeEntity objects from the database and return them in an array.
    
    function GetPost() {
        /*
        SELECT distinct m.mid
        FROM Message as m, User as u, block_hood as bh, Relationship as r   
        WHERE   (u.uid = 'u05' AND u.bid = bh.bid AND u.login_time < m.timestamp AND (u.bid = m.recipient_bid OR bh.hid = m.recipient_hid)) 
        OR 
        (r.user2 = u.uid AND u.uid = 'u01'AND u.login_time < m.timestamp AND r.relationship = 'neighbor' AND r.user1 = m.author AND m.recipient_neighbors = TRUE)
        OR
        (r.user2 = u.uid AND u.uid = 'u01' AND u.login_time < m.timestamp AND r.relationship = 'friend' AND r.user1 = m.author AND m.recipient_friend = TRUE)
        */
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
        $stmt = $mysqli->prepare("SELECT distinct m.mid, m.title, m.content, m.address, m.author, m.timestamp
                                  FROM Message as m, User as u, block_hood as bh, Relationship as r
                                  WHERE (u.uid = ? AND u.bid = bh.bid AND u.login_time < m.timestamp AND (u.bid = m.recipient_bid OR bh.hid = m.recipient_hid)) 
                                  OR 
                                  (r.user2 = u.uid AND u.uid = ? AND u.login_time < m.timestamp AND r.relationship = 'neighbor' AND r.user1 = m.author AND m.recipient_neighbors = TRUE)
                                  OR
                                  (r.user2 = u.uid AND u.uid = ? AND u.login_time < m.timestamp AND r.relationship = 'friend' AND r.user1 = m.author AND m.recipient_friend = TRUE)");
        $stmt->bind_param('sss', $uid, $uid, $uid);
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
}
?>
