<?php

require ("Model/MessageModel.php");

//Contains non-database related function for the Coffee page
class MessageController {

    function DisplayNewPost()
    {
        $MessageModel = new MessageModel();
        $messageArray = $MessageModel->GetNewPost();
        $result = "";

        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($messageArray as $key => $message)
        {
            $result = $result .
                    "
                     <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog_archive wow fadeInUp'>
                       <div class='blogimg_container'>
                        <a href='#' class='blog_img'>
                          <img alt='img' src='img/blog.jpg'>
                        </a>
                       </div>
                       <h2 class='blog_title'><a href='events-single.html'>$message->title</a></h2>
                       <div class='blog_commentbox'>
                         <p><i class='fa fa-clock-o'></i>$message->timestamp</p>
                         <p><i class='fa fa-map-marker'></i>$message->address</p>
                         <p><i class='fa fa-user'></i>Author: $message->author</p>
                       </div>
                         <p class='blog_summary'>$message->content</p>
                         <a class='blog_readmore' href='posts_single.php?thread_id=$message->tid'>Read More</a>
                       </div>
                     </div>";
        }
        return $result;

    }

    function DisplayBlockPost()
    {
        $MessageModel = new MessageModel();
        $messageArray = $MessageModel->GetBlockPost();
        $result = "";

        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($messageArray as $key => $message)
        {
            $result = $result .
                    "
                     <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog_archive wow fadeInUp'>
                       <div class='blogimg_container'>
                        <a href='#' class='blog_img'>
                          <img alt='img' src='img/blog.jpg'>
                        </a>
                       </div>
                       <h2 class='blog_title'><a href='events-single.html'>$message->title</a></h2>
                       <div class='blog_commentbox'>
                         <p><i class='fa fa-clock-o'></i>$message->timestamp</p>
                         <p><i class='fa fa-map-marker'></i>$message->address</p>
                         <p><i class='fa fa-user'></i>Author: $message->author</p>
                       </div>
                         <p class='blog_summary'>$message->content</p>
                         <a class='blog_readmore' href='posts_single.php?thread_id=$message->tid'>Read More</a>
                       </div>
                     </div>";
        }
        return $result;

    }

    function DisplayNeighborPost()
    {
        $MessageModel = new MessageModel();
        $messageArray = $MessageModel->GetNeighborPost();
        $result = "";

        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($messageArray as $key => $message)
        {
           // printf($message->tid.'');
            $result = $result .
                    "
                     <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog_archive wow fadeInUp'>
                       <div class='blogimg_container'>
                        <a href='#' class='blog_img'>
                          <img alt='img' src='img/blog.jpg'>
                        </a>
                       </div>
                       <h2 class='blog_title'><a href='events-single.html'>$message->title</a></h2>
                       <div class='blog_commentbox'>
                         <p><i class='fa fa-clock-o'></i>$message->timestamp</p>
                         <p><i class='fa fa-map-marker'></i>$message->address</p>
                         <p><i class='fa fa-user'></i>Author: $message->author</p>
                       </div>
                         <p class='blog_summary'>$message->content</p>
                         <a class='blog_readmore' href='posts_single.php?thread_id=$message->tid'>Read More</a>
                       </div>
                     </div>";
        }
        return $result;

    }

    function DisplaySinglePostFirst($tid)
    {
        $MessageModel = new MessageModel();
        $message = $MessageModel->GetSinglePostFirst($tid);
        $result ="
                     <div><img src='img/events-slider2.jpg' alt='img'></div>

                    <h2 class='blog_title'><a href='blog-single.html'>$message->title</a></h2>
                    <div class='blog_commentbox'>
                      <p><i class='fa fa-clock-o'></i>Time: $message->timestamp</p>
                      <p><i class='fa fa-map-marker'></i>Location: $message->address</p>
                      <p><i class='fa fa-user'></i>Author: $message->author</p>
                    </div><p>$message->content</p>
                 ";
        return $result;
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
                      <p><p><i class='fa fa-comment' style='color:#ffac33'></i><a style='color:#ffac33'> Comment</a></p>
                      <div class='blog_commentbox'>
                        <p><i class='fa fa-clock-o'></i>Time: $message->timestamp</p>
                        <p><i class='fa fa-user'></i>Author: $message->author</p>
                      </div>
                      <p class='blog_summary'>$message->content</p>
                    </div>";
        }
        return $result;
    }

}
?>
