<?php

require ("../Model/UserModel.php");

//Contains non-database related function for the Coffee page
class UserController {

 function CreateAccount($uid, $uname, $psw, $introduction, $photo, $address, $bid, $city, $state) {
        $UserModel = new UserModel();
        $UserModel->CreateAccount($uid, $uname, $psw, $introduction, $photo, $address, $bid, $city, $state);

    }

}
?>
