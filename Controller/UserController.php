<?php
include ("include.php");

require_once ("Model/UserModel.php");

//Contains non-database related function for the Coffee page
class UserController {


    function CreateAccount($uid, $uname, $psw, $introduction, $photo, $address, $bid, $city, $state) {
        $UserModel = new UserModel();
        $UserModel->CreateAccount($uid, $uname, $psw, $introduction, $photo, $address, $bid, $city, $state);

    }

    function DisplayFriendNotify()
    {
        //printf("turtle");
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
        //printf("turtlet");
        $UserModel = new UserModel();
        $userArray = $UserModel->GetNeighborNotify();
        //printf("turtle66");
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
        //printf("turtle3");
        $UserModel = new UserModel();
        $userArray = $UserModel->GetBlockNotify();
        $result = "";

        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($userArray as $key => $user)
        {
            //printf("e");

           $result = $result .
                    "<p><i class='fa fa-bell'></i><a> $user->uname</a> need be approved as block member <p><a href='ApproveMember.php?memberid=$user->uid' style='color:#ff1a1a'><i class='fa fa-check'></i> approve</a></p></p>
                    ";
        }
        return $result;
    }

    function AcceptFriend($friendid)
    {
        $UserModel = new UserModel();
        $userArray = $UserModel->AcceptFriend($friendid);

        return $result;
    }

    function ApproveMember($memberid)
    {
        $UserModel = new UserModel();
        $userArray = $UserModel->ApproveMember($memberid);

        return $result;
    }
    
    function EditUserProfile()
    {
        //printf("turtle3");
        $UserModel = new UserModel();
        $userArray = $UserModel->GetUserProfile();
        $result = "";
        
        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($userArray as $key => $user)
        {
        //printf("e");

           $result = $result .
                    "
                    <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog'>
                         <p class=''>Name:</p>
                         <input type='text' class='' name='uname_edit' placeholder='$user->uname'></p>
                         <p class=''>Password:</p>
                         <input type='text' class='' name='password_edit' placeholder=$user->password></p>
                         <p class=''>About Me:</p>
                         <p><textarea rows='4' cols='50' class='' name='intro_input' placeholder='$user->introduction'></textarea></p>
                         <p class=''>Address:</p>
                         <input type='text' class='' name='address_edit' placeholder='$user->address' size = '51'></p>
                         <br>
                       </div>                          
                     </div>";
                    
        }
        return $result;
    }
    
    function DisplayUserProfile()
    {
        //printf("turtle3");
        $UserModel = new UserModel();
        $userArray = $UserModel->GetUserProfile();
        $result = "";
        
        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($userArray as $key => $user)
        {
        //printf("e");

           $result = $result .
                    "
                    <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog'>
                         <p class='blog_summary'><a>$user->uname</a></p>
                         <p class='blog_summary'><a>$user->introduction<a></p>
                         <p class='blog_summary'><a>$user->address</a></p>
                         <br>
                       </div>                          
                     </div>";
                    
        }
        return $result;
    }
    
    function DisplayUserInfo($userid)
    {
        //printf("turtle3");
        $UserModel = new UserModel();
        $userArray = $UserModel->GetUserInfo($userid);
        $result = "";
        
        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($userArray as $key => $user)
        {
        //printf("e");

           $result = $result .
                    "
                    <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog'>
                         <p class='blog_summary'><a>$user->uname</a></p>
                         <p class='blog_summary'><a>$user->introduction<a></p>
                         <p class='blog_summary'><a>$user->address</a></p>
                         <br>
                       </div>                          
                     </div>";
                    
        }
        return $result;
    }
    
    function CheckRelationship($userid){
    
        $UserModel = new UserModel();
        $Check = $UserModel->CheckRelationship($userid);
        
        if($Check[0] == FALSE){
        $url = "class='blog_readmore' href=";
        $Add_url =  "AddFriends.php?user_id=";
        $Add = 'Add Friend';
        }
        if($Check[1] == FALSE){
        $url = "class='blog_readmore' href=";
        $Add_url2 =  "AddNeighbors.php?user_id=";
        $Add2 = 'Add Neighbor';
        }
        $user= $userid;
        
        return array($url, $Add_url, $user, $Add, $Add_url2, $Add2 );
        
        }
                    
}
?>
