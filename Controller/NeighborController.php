<?php

require ("Model/NeighborModel.php");

//Contains non-database related function for the Coffee page
class NeighborController {

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
        $NeighborModel = new NeighborModel();
        $userArray = $NeighborModel->GetMember();
        $locations = array();

        foreach ($userArray as $key => $user) {
            $mapresult = $this->GetLatandlong($user);
            array_push($locations, $mapresult[0]);
        }

        return array($userArray, $locations);
    }

    function DisplayMembersOnList()
    {
        $NeighborModel = new NeighborModel();
        $userArray = $NeighborModel->GetMember();
        $result = "";

        foreach ($userArray as $key => $user)
        {
            $result = $result .
                    "<div class='col-lg-3 col-md-3 col-sm-3'>
                      <h4><a class='' href='UserProfile.php?user_id=$user->uid'><i class='fa fa-user'></i>  $user->uname</a></h4>
                     </div>";
        }
        return $result;
    }
    
    function DisplayNeighborProfile()
    {
        $NeighborModel = new NeighborModel();
        $neighborArray = $NeighborModel->GetNeighborProfile();
        $locations = array();
        $result = "";

        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($neighborArray as $key => $neighbor)
        {
            $mapresult = $this->GetLatandlong($neighbor);
            array_push($locations, $mapresult[0]);
            $lat = $mapresult[1];
            $long = $mapresult[2];
            echo "test";
           //$_SESSION['tid'] = 

            $result = $result .
                    "
                     <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog_archive wow fadeInUp'>
                       <h2 class='blog_title'> </h2>
                       <div class='blog_commentbox'>
                       <p><i class='fa fa-user'></i>$neighbor->uname</p>
                         <p><i class='fa fa-user'></i>$neighbor->uid</p>
                         <p><a style='color:#66b2ff' href='http://www.google.com/maps/place/$lat,$long'><i class='fa fa-map-marker'></i></a>$neighbor->address</p>                        
                       </div>
                         <p class='blog_summary'>$neighbor->introduction</p>
                         <a class='blog_readmore' href='UserProfile.php?user_id=$neighbor->uid'style='font-size:100%'>Read More</a>
                       </div>
                     </div>";
        }
        //printf($message->tid);
    
        return array($result, $locations);
    }
    
    function DisplaySuggestNeighbors()
    {
        $NeighborModel = new NeighborModel();
        $neighborArray = $NeighborModel->GetBlockNeighbors();
        $locations = array();
        $result = "";

        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($neighborArray as $key => $neighbor)
        {
            $mapresult = $this->GetLatandlong($neighbor);
            array_push($locations, $mapresult[0]);
            $lat = $mapresult[1];
            $long = $mapresult[2];
            echo "test";
           //$_SESSION['tid'] = 

            $result = $result .
                    "
                     <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog_archive wow fadeInUp'>
                       <h2 class='blog_title'> </h2>
                       <div class='blog_commentbox'>
                         <p><i class='fa fa-user'></i>$neighbor->uid</p>
                         <p><a style='color:#66b2ff' href='http://www.google.com/maps/place/$lat,$long'><i class='fa fa-map-marker'></i>$neighbor->address</a></p>
                         <p><i class='fa fa-user'></i>Name: $neighbor->uname</p>
                       </div>
                         <p class='blog_summary'>$neighbor->introduction</p>
                         
                         <a class='blog_readmore' href='addfriends.php?user_id=$neighbor->uid'>Add Neighbor</a>
                       </div>
                     </div>";
        }
        //printf($message->tid);
        //<form method='post' action='addfriends.php'>
//<input name='add' type='submit' value='Add neighbor' /></form>
    
        return array($result, $locations);
    }
    
    function AddNeighbor($user2)
    {
        $NeighborModel = new NeighborModel();
        $neighbor = $NeighborModel->AddNeighbor($user2);
        $mapresult = $this->GetLatandlong($neighbor);
        $lat = $mapresult[1];
        $long = $mapresult[2];
        $result ="";
        
        return $result;
    }

    function DisplaySearchNeighbor($keyword)
    {
        $NeighborModel = new NeighborModel();
        $neighborArray = $NeighborModel->GetSearchNeighbor($keyword);
        $locations = array();
        $result = "";

        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($neighborArray as $key => $neighbor)
        {
            $mapresult = $this->GetLatandlong($neighbor);
            array_push($locations, $mapresult[0]);
            $lat = $mapresult[1];
            $long = $mapresult[2];
            //echo "test";
           //$_SESSION['tid'] = 

            $result = $result .
                    "
                     <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog_archive wow fadeInUp'>
                       <h2 class='blog_title'> </h2>
                       <div class='blog_commentbox'>
                         <p><i class='fa fa-user'></i>$neighbor->uid</p>
                         <p><a style='color:#66b2ff' href='http://www.google.com/maps/place/$lat,$long'><i class='fa fa-map-marker'></i>$neighbor->address</a></p>
                         <p><i class='fa fa-user'></i>Name: $neighbor->uname</p>
                       </div>
                         <p class='blog_summary'>$neighbor->introduction</p>
                         <a class='blog_readmore' href='UserProfile.php?user_id=$neighbor->uid'>Read More</a>
                       </div>
                     </div>";
        }
        //printf($message->tid);
    
        return array($result, $locations);
    }


}
?>
