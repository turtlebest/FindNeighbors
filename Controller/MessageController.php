<?php

require ("Model/MessageModel.php");

//Contains non-database related function for the Coffee page
class MessageController {

    function DisplayPost()
    {
        $MessageModel = new MessageModel();
        $messageArray = $MessageModel->GetPost();
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
                       </div>
                         <p class='blog_summary'>$message->content</p>
                         <a class='blog_readmore' href='events-single.html'>Read More</a>
                       </div>
                     </div>";
        }        
        return $result;
        
    }

}
?>
