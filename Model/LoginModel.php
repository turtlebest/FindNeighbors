<?php

require ("Entities/UserEntity.php");

//Contains database related code for the Coffee page.
class LoginModel {

    //Get coffeeEntity objects from the database and return them in an array.
    function CheckUser($uid, $psw) {
        require 'Credentials.php';
        $mysqli = new mysqli($host, $user, $passwd, $database);
printf("a");
        /* check connection */
        if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
        }
printf("b");
printf($uid);
printf($psw);
        $stmt = $mysqli->prepare("SELECT uname FROM User WHERE uid = ? and password = ?");
        $stmt->bind_param('ss', $uid, $psw);

        $stmt->execute();
        $stmt->bind_result($uname);
        $stmt -> fetch();
      printf("f");
        if(empty($uname)){
            printf("d");
            $Correct = FALSE;
        } else {
            printf("e");
            $Correct = TRUE;
        }
        //Close connection and return result
         printf("g");
        $stmt->close();
        $mysqli->close();
        printf($Correct);
        return $Correct;
    }

}
?>
