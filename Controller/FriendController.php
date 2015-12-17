<?php

require ("Model/FriendModel.php");



//Contains non-database related function for the Coffee page
class FriendController {

   function GetLatandlong($user) {
        $address = str_replace(' ', '+', $user->address);
        $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false');

        $output= json_decode($geocode);

        $lat = $output->results[0]->geometry->location->lat;
        $long = $output->results[0]->geometry->location->lng;

        $location = array(
            'google_map' => array(
            'lat' => $lat,
            'lng' => $long,
            ),
            'location_address' => $address,
            'location_name'    => NULL,
            'location_id'     => $user->uid,
            'location_author'  => $user->uname,
        );

        return array($location, $lat, $long);

    }

    function DisplayMembersOnMap()
    {
        $FriendModel = new FriendModel();
        $userArray = $FriendModel->GetMember();
        $locations = array();

        foreach ($userArray as $key => $user) {
            $mapresult = $this->GetLatandlong($user);
            array_push($locations, $mapresult[0]);
        }

        return array($userArray, $locations);
    }

    function DisplayMembersOnList()
    {
        $FriendModel = new FriendModel();
        $userArray = $FriendModel->GetMember();
        $result = "";

        foreach ($userArray as $key => $user)
        {
            $result = $result .
                    "<div class='col-lg-3 col-md-3 col-sm-3'>
                      <h4><a><i class='fa fa-user'></i>  $user->uname</a></h4>
                     </div>";
        }
        return $result;
    }
    function DisplayFriendProfile()
    {
        $FriendModel = new FriendModel();
        $friendArray = $FriendModel->GetFriendProfile();
        $locations = array();
        $result = "";

        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($friendArray as $key => $friend)
        {
            $mapresult = $this->GetLatandlong($friend);
            array_push($locations, $mapresult[0]);
            $lat = $mapresult[1];
            $long = $mapresult[2];
            echo "test";
           //$_SESSION['tid'] = 

            $result = $result .
                    "
                     <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog_archive wow fadeInUp'>
                       <h2 class='blog_title'><a href='posts_single.php?thread_id=$message->tid'>$message->title</a></h2></h2>
                       <div class='blog_commentbox'>
                         <p><i class='fa fa-user'></i>$friend->uid</p>
                         <p><a style='color:#66b2ff' href='http://www.google.com/maps/place/$lat,$long'><i class='fa fa-map-marker'></i>$friend->address</a></p>
                         <p><i class='fa fa-user'></i>Name: $friend->uname</p>
                       </div>
                         <p class='blog_summary'>$friend->introduction</p>
                         <a class='blog_readmore' href='UserProfile.php?user_id=$friend->uid'>Read More</a>
                       </div>
                     </div>";
        }
        //printf($message->tid);
    
        return array($result, $locations);
    }
    
    function DisplaySuggestFriends()
    {
        $FriendModel = new FriendModel();
        $friendArray = $FriendModel->GetBlockFriends();
        $locations = array();
        $result = "";

        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($friendArray as $key => $friend)
        {
            $mapresult = $this->GetLatandlong($friend);
            array_push($locations, $mapresult[0]);
            $lat = $mapresult[1];
            $long = $mapresult[2];
            echo "test";
           //$_SESSION['tid'] = 

            $result = $result .
                    "
                     <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog_archive wow fadeInUp'>
                       <h2 class='blog_title'><a href='posts_single.php?thread_id=$message->tid'>$message->title</a></h2></h2>
                       <div class='blog_commentbox'>
                         <p><i class='fa fa-user'></i>$friend->uid</p>
                         <p><a style='color:#66b2ff' href='http://www.google.com/maps/place/$lat,$long'><i class='fa fa-map-marker'></i>$friend->address</a></p>
                         <p><i class='fa fa-user'></i>Name: $friend->uname</p>
                       </div>
                         <p class='blog_summary'>$friend->introduction</p>
                         <a class='blog_readmore' href='AddFriends.php?friend_id=$friend->uid'>Add Friend</a>
                       </div>
                     </div>";
        }
        //printf($message->tid);
    
        return array($result, $locations);
    }
    
    function AddFriend($user2)
    {
        $FriendModel = new FriendModel();
        $friend = $FriendModel->AddFriend($user2);
        $mapresult = $this->GetLatandlong($friend);
        $lat = $mapresult[1];
        $long = $mapresult[2];
        $result ="";
        
        return $result;
    }

    

}
?>
