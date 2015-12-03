<?php

class MessageEntity
{
    public $mid;
    public $title;
    public $content;
    public $address;
    public $timestamp;
    public $author;
    public $recipient_friend;
    public $recipient_neighbors;
    public $recipient_uid;
    public $recipient_bid;
    public $recipient_hid;
    public $tid;

    function __construct($mid, $title, $content, $address, $timestamp, $author, $recipient_friend, $recipient_neighbors, $recipient_uid, $recipient_bid, $recipient_hid, $tid) {
        $this->mid = $mid;
        $this->title = $title;
        $this->content = $content;
        $this->address = $address;
        $this->timestamp = $timestamp;
        $this->author = $author;
        $this->recipient_friend = $recipient_friend;
        $this->recipient_neighbors = $recipient_neighbors;
        $this->recipient_uid = $recipient_uid;
        $this->recipient_bid = $recipient_bid;        
        $this->recipient_hid = $recipient_hid;
        $this->tid = $tid;
       
    }

}

?>
