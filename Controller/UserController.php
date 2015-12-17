<?php

require ("Model/UserModel.php");

//Contains non-database related function for the Coffee page
class UserController {


    function CreateAccount($uid, $uname, $psw, $introduction, $photo, $address, $bid, $city, $state) {
        $UserModel = new UserModel();
        $UserModel->CreateAccount($uid, $uname, $psw, $introduction, $photo, $address, $bid, $city, $state);

    }

    function DisplayFriendNotify()
    {
        $UserModel = new UserModel();
        $userArray = $UserModel->GetFriendNotify();
        $result = "";

        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($userArray as $key => $user)
        {
            $result = $result .
                    "<p><i class='fa fa-bell'></i><a> $user->uname</a> wants to add you as friend <p><a href='AcceptFriend.php?friendid=$user->uid' style='color:#ff1a1a'><i class='fa fa-check'></i> accept</a></p></p>
                    ";
        }
        return $result;
    }

    function DisplayNeighborNotify()
    {
        $UserModel = new UserModel();
        $userArray = $UserModel->GetNeighborNotify();
        $result = "";

        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($userArray as $key => $user)
        {
            $result = $result .
                    "<p><i class='fa fa-bell'></i><a> $user->uname</a> added you as neighbor <p></p>
                    ";
        }
        return $result;
    }

    function DisplayBlockNotify()
    {
        printf("n");
        $UserModel = new UserModel();
        $userArray = $UserModel->GetBlockNotify();
        $result = "aaa";

        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($userArray as $key => $user)
        {
            //printf("e");

           /* $result = $result .
                    "<p><i class='fa fa-bell'></i><a> $user->uname</a> need be approved as block member <p><a href='AcceptFriend.php?friendid=$user->uid' style='color:#ff1a1a'><i class='fa fa-check'></i> approve</a></p></p>
                    ";*/
        }
        return $result;
    }

    function AcceptFriend($friendid)
    {
        $UserModel = new UserModel();
        $userArray = $UserModel->AcceptFriend($friendid);

        return $result;
    }

}
?>
