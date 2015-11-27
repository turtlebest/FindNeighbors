<?php

class ApplianceEntity
{
    public $aname;
    public $description;
    public $config;
    public $price;
    public $status;

    function __construct($aname, $description, $config, $price, $status) {
        $this->aname = $aname;
        $this->description = $description;
        $this->config = $config;
        $this->price = $price;
        $this->status = $status;
       
    }

}

?>
