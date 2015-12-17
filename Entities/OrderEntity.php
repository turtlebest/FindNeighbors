<?php

class OrderEntity
{
    public $aname;
    public $config;
    public $ordertime;
    public $quantity;
    public $price;
    public $status;

    function __construct($aname, $config, $ordertime, $quantity, $price, $status) {
        $this->aname = $aname;
        $this->config = $config;
        $this->ordertime = $ordertime;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->status = $status;
    }

}

?>
