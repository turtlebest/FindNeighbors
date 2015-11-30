<?php

class UserEntity
{
    public $uid;
    public $uname;
    public $password;
    public $introduction;
    public $photo;
    public $address;
    public $approved;
    public $bid;
    public $city;
    public $status;
    public $login_time;

    function __construct($uid, $uname, $password, $introduction, $photo, $address, $approved, $bid, $city, $status, $login_time) {
        $this->uid = $uid;
        $this->uname = $uname;
        $this->password = $password;
        $this->introduction = $introduction;
        $this->photo = $photo;
        $this->address = $address;
        $this->approved = $approved;
        $this->bid = $bid;
        $this->city = $city;
        $this->status = $status;
        $this->login_time = $login_time;
       
    }

}

?>
