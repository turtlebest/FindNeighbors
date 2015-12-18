<?php

require ("Model/MessageModel.php");

//Contains non-database related function for the Coffee page
class MessageController {

    function GetLatandlong($message) {
        //printf("map");
        $address = str_replace(' ', '+', $message->address);
        $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false');

        $output= json_decode($geocode);

        $lat = $output->results[0]->geometry->location->lat;
        $long = $output->results[0]->geometry->location->lng;

        if ($message->reply_message) {
           $title = $message->author." reply on ".$message->title;
        } else {
           $title = $message->title;
        }

        $location = array(
            'google_map' => array(
            'lat' => $lat,
            'lng' => $long,
            ),
            'location_address' => $address,
            'location_name'    => $title,
            'location_id'     => $message->tid,
            'location_author'  => $message->author,
        );

        return array($location, $lat, $long);

    }

    function DisplayNewPost()
    {
        $MessageModel = new MessageModel();
        $messageArray = $MessageModel->GetNewPost();
        $locations = array();
        $result = "";

        foreach ($messageArray as $key => $message)
        {
            $mapresult = $this->GetLatandlong($message);
            array_push($locations, $mapresult[0]);
            //printf($mapresult[0][location_author]);
            $lat = $mapresult[1];
            $long = $mapresult[2];

            if ($message->reply_message) {
                $result = $result .
                    "
                     <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog_archive wow fadeInUp'>
                       <h5 class='blog_title'><a href='posts_single.php?thread_id=$message->tid'><i class='fa fa-comment' style='color:#ffac33'></i> $message->author reply on message $message->title</a></h5>
                       <div class='blog_commentbox'>
                         <p><i class='fa fa-clock-o'></i>$message->timestamp</p>
                         <p><a style='color:#66b2ff' href='http://www.google.com/maps/place/$lat,$long'><i class='fa fa-map-marker'></i>$message->address</a></p>
                         <p><i class='fa fa-user'></i>Author: $message->author</p>
                       </div>
                         <p class='blog_summary'>$message->content</p>
                         <a class='blog_readmore' href='posts_single.php?thread_id=$message->tid'>Read More</a>
                       </div>
                     </div>";

            } else {
                $result = $result .
                    "
                     <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog_archive wow fadeInUp'>
                       <h2 class='blog_title'><a href='posts_single.php?thread_id=$message->tid'>$message->title</a></h2>
                       <div class='blog_commentbox'>
                         <p><i class='fa fa-clock-o'></i>$message->timestamp</p>
                         <p><a style='color:#66b2ff' href='http://www.google.com/maps/place/$lat,$long'><i class='fa fa-map-marker'></i>$message->address</a></p>
                         <p><i class='fa fa-user'></i>Author: $message->author</p>
                       </div>
                         <p class='blog_summary'>$message->content</p>
                         <a class='blog_readmore' href='posts_single.php?thread_id=$message->tid'>Read More</a>
                       </div>
                     </div>";
            }

        }
        return array($result, $locations);
    }

    function DisplayBlockPost()
    {
        $MessageModel = new MessageModel();
        $messageArray = $MessageModel->GetBlockPost();
        $locations = array();
        $result = "";

        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($messageArray as $key => $message)
        {
            $mapresult = $this->GetLatandlong($message);
            array_push($locations, $mapresult[0]);
            $lat = $mapresult[1];
            $long = $mapresult[2];
            echo "test";
           //$_SESSION['tid'] = 

            $result = $result .
                    "
                     <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog_archive wow fadeInUp'>
                       <h2 class='blog_title'><a href='posts_single.php?thread_id=$message->tid'>$message->title</a></h2>
                       <div class='blog_commentbox'>
                         <p><i class='fa fa-clock-o'></i>$message->timestamp</p>
                         <p><a style='color:#66b2ff' href='http://www.google.com/maps/place/$lat,$long'><i class='fa fa-map-marker'></i>$message->address</a></p>
                         <p><i class='fa fa-user'></i>Author: $message->author</p>
                       </div>
                         <p class='blog_summary'>$message->content</p>
                         <a class='blog_readmore' href='posts_single.php?thread_id=$message->tid'>Read More</a>
                       </div>
                     </div>";
        }
        //printf($message->tid);
    
        return array($result, $locations);
    }

    function DisplayHoodPost()
    {
        $MessageModel = new MessageModel();
        $messageArray = $MessageModel->GetHoodPost();
        $locations = array();
        $result = "";

        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($messageArray as $key => $message)
        {
            $mapresult = $this->GetLatandlong($message);
            array_push($locations, $mapresult[0]);
            $lat = $mapresult[1];
            $long = $mapresult[2];
           //printf($message->tid.'');
           //$_SESSION['tid'] = 
            $result = $result .
                    "
                     <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog_archive wow fadeInUp'>
                       <h2 class='blog_title'><a href='posts_single.php?thread_id=$message->tid'>$message->title</a></h2>
                       <div class='blog_commentbox'>
                         <p><i class='fa fa-clock-o'></i>$message->timestamp</p>
                         <p><a style='color:#66b2ff' href='http://www.google.com/maps/place/$lat,$long'><i class='fa fa-map-marker'></i>$message->address</a></p>
                         <p><i class='fa fa-user'></i>Author: $message->author</p>
                       </div>
                         <p class='blog_summary'>$message->content</p>
                         <a class='blog_readmore' href='posts_single.php?thread_id=$message->tid'>Read More</a>
                       </div>
                     </div>";
        }
        return array($result, $locations);
    }

    function DisplaySinglePostFirst($tid)
    {
        $MessageModel = new MessageModel();
        $message = $MessageModel->GetSinglePostFirst($tid);
        $mapresult = $this->GetLatandlong($message);
        $lat = $mapresult[1];
        $long = $mapresult[2];
        $result ="<div><img src='img/events-slider2.jpg' alt='img'></div>
                    <h2 class='blog_title'><a href='blog-single.html'>$message->title</a></h2>
                    <div class='blog_commentbox'>
                      <p><i class='fa fa-clock-o'></i>Time: $message->timestamp</p>
                      <p><a style='color:#66b2ff' href='http://www.google.com/maps/place/$lat,$long'><i class='fa fa-map-marker'></i>$message->address</a></p>
                      <p><i class='fa fa-user'></i>Author: $message->author</p>
                    </div><p>$message->content</p>
                 ";
        //$reply_url = "reply.php?re_thread_id=".$tid;
        $reply_url = "reply.php?re_thread_id=";
        $reply_tid = $tid;

        return array($result,$reply_url, $reply_tid);
    }

    function DisplaySinglePostReply($tid)
    {
        $MessageModel = new MessageModel();
        $messageArray = $MessageModel->GetSinglePostReply($tid);
        $result = "";

        foreach ($messageArray as $key => $message)
        {
           // printf($message->tid.'');

            $result = $result .
                    "<div class='single_blog_archive'>
                      <p><p><i class='fa fa-comment' style='color:#ffac33'></i>
                      <div class='blog_commentbox'>
                        <p><i class='fa fa-clock-o'></i>Time: $message->timestamp</p>
                        <p><i class='fa fa-user'></i>Author: $message->author</p>
                      </div>
                      <p class='blog_summary'>$message->content</p>
                    </div>";

        }
        return $result;
    }
    
    function DisplayUserPost($userid)
    {
        $MessageModel = new MessageModel();
        $messageArray = $MessageModel->GetUserPost($userid);
        $locations = array();
        $result = "";

        foreach ($messageArray as $key => $message)
        {
            $mapresult = $this->GetLatandlong($message);
            array_push($locations, $mapresult[0]);
            $lat = $mapresult[1];
            $long = $mapresult[2];

            if ($message->reply_message) {
                $result = $result .
                    "
                     <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog_archive wow fadeInUp'>
                       <h5 class='blog_title'><a href='posts_single.php?thread_id=$message->tid'><i class='fa fa-comment' style='color:#ffac33'></i> $message->author reply on message $message->title</a></h5>
                       <div class='blog_commentbox'>
                         <p><i class='fa fa-clock-o'></i>$message->timestamp</p>
                         <p><a style='color:#66b2ff' href='http://www.google.com/maps/place/$lat,$long'><i class='fa fa-map-marker'></i>$message->address</a></p>
                         <p><i class='fa fa-user'></i>Author: $message->author</p>
                       </div>
                         <p class='blog_summary'>$message->content</p>
                         <a class='blog_readmore' href='posts_single.php?thread_id=$message->tid'>Read More</a>
                       </div>
                     </div>";

            } else {
                $result = $result .
                    "
                     <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog_archive wow fadeInUp'>
                       <h2 class='blog_title'><a href='posts_single.php?thread_id=$message->tid'>$message->title</a></h2>
                       <div class='blog_commentbox'>
                         <p><i class='fa fa-clock-o'></i>$message->timestamp</p>
                         <p><a style='color:#66b2ff' href='http://www.google.com/maps/place/$lat,$long'><i class='fa fa-map-marker'></i>$message->address</a></p>
                         <p><i class='fa fa-user'></i>Author: $message->author</p>
                       </div>
                         <p class='blog_summary'>$message->content</p>
                         <a class='blog_readmore' href='posts_single.php?thread_id=$message->tid'>Read More</a>
                       </div>
                     </div>";
            }

        }
        return array($result, $locations);
    }
    
    function DisplaySearchPost($keyword)
    {
        $MessageModel = new MessageModel();
        $messageArray = $MessageModel->GetSearchPost($keyword);
        $locations = array();
        $result = "";

        foreach ($messageArray as $key => $message)
        {
            $mapresult = $this->GetLatandlong($message);
            array_push($locations, $mapresult[0]);
            $lat = $mapresult[1];
            $long = $mapresult[2];

            if ($message->reply_message) {
                $result = $result .
                    "
                     <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog_archive wow fadeInUp'>
                       <h5 class='blog_title'><a href='posts_single.php?thread_id=$message->tid'><i class='fa fa-comment' style='color:#ffac33'></i> $message->author reply on message $message->title</a></h5>
                       <div class='blog_commentbox'>
                         <p><i class='fa fa-clock-o'></i>$message->timestamp</p>
                         <p><a style='color:#66b2ff' href='http://www.google.com/maps/place/$lat,$long'><i class='fa fa-map-marker'></i>$message->address</a></p>
                         <p><i class='fa fa-user'></i>Author: $message->author</p>
                       </div>
                         <p class='blog_summary'>$message->content</p>
                         <a class='blog_readmore' href='posts_single.php?thread_id=$message->tid'>Read More</a>
                       </div>
                     </div>";

            } else {
                $result = $result .
                    "
                     <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog_archive wow fadeInUp'>
                       <h2 class='blog_title'><a href='posts_single.php?thread_id=$message->tid'>$message->title</a></h2>
                       <div class='blog_commentbox'>
                         <p><i class='fa fa-clock-o'></i>$message->timestamp</p>
                         <p><a style='color:#66b2ff' href='http://www.google.com/maps/place/$lat,$long'><i class='fa fa-map-marker'></i>$message->address</a></p>
                         <p><i class='fa fa-user'></i>Author: $message->author</p>
                       </div>
                         <p class='blog_summary'>$message->content</p>
                         <a class='blog_readmore' href='posts_single.php?thread_id=$message->tid'>Read More</a>
                       </div>
                     </div>";
            }

        }
        return array($result, $locations);
    }
    
    function DisplayFriendPost()
    {
        $MessageModel = new MessageModel();
        $messageArray = $MessageModel->GetFriendPost();
        $locations = array();
        $result = "";

        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($messageArray as $key => $message)
        {
            $mapresult = $this->GetLatandlong($message);
            array_push($locations, $mapresult[0]);
            $lat = $mapresult[1];
            $long = $mapresult[2];
           //printf($message->tid.'');
           //$_SESSION['tid'] = 
            $result = $result .
                    "
                     <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog_archive wow fadeInUp'>
                       <h2 class='blog_title'><a href='posts_single.php?thread_id=$message->tid'>$message->title</a></h2>
                       <div class='blog_commentbox'>
                         <p><i class='fa fa-clock-o'></i>$message->timestamp</p>
                         <p><a style='color:#66b2ff' href='http://www.google.com/maps/place/$lat,$long'><i class='fa fa-map-marker'></i>$message->address</a></p>
                         <p><i class='fa fa-user'></i>Author: $message->author</p>
                       </div>
                         <p class='blog_summary'>$message->content</p>
                         <a class='blog_readmore' href='posts_single.php?thread_id=$message->tid'>Read More</a>
                       </div>
                     </div>";
        }
        return array($result, $locations);
    }
    
    function DisplayNeighborPost()
    {
        $MessageModel = new MessageModel();
        $messageArray = $MessageModel->GetNeighborPost();
        $locations = array();
        $result = "";

        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($messageArray as $key => $message)
        {
            $mapresult = $this->GetLatandlong($message);
            array_push($locations, $mapresult[0]);
            $lat = $mapresult[1];
            $long = $mapresult[2];
           //printf($message->tid.'');
           //$_SESSION['tid'] = 
            $result = $result .
                    "
                     <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog_archive wow fadeInUp'>
                       <h2 class='blog_title'><a href='posts_single.php?thread_id=$message->tid'>$message->title</a></h2>
                       <div class='blog_commentbox'>
                         <p><i class='fa fa-clock-o'></i>$message->timestamp</p>
                         <p><a style='color:#66b2ff' href='http://www.google.com/maps/place/$lat,$long'><i class='fa fa-map-marker'></i>$message->address</a></p>
                         <p><i class='fa fa-user'></i>Author: $message->author</p>
                       </div>
                         <p class='blog_summary'>$message->content</p>
                         <a class='blog_readmore' href='posts_single.php?thread_id=$message->tid'>Read More</a>
                       </div>
                     </div>";
        }
        return array($result, $locations);
    }



}
?>
