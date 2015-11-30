<?php

require ("Model/LoginModel.php");

//Contains non-database related function for the Coffee page
class LoginController {

    function CheckUser($uid, $psw) {
        $LoginModel = new LoginModel();
        printf("c");
        $Correct = $LoginModel->CheckUser($uid, $psw);

        return $Correct;
    }

}
?>
