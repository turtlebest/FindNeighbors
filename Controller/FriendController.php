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

}
?>
