<?php
include "include.php";
require 'Controller/MessageController.php';
$MessageController = new MessageController();
?>

<!DOCTYPE html>
<html lang="en">
<?php include "static/template.php";?>

  <body>    

        <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"></a>
    <!-- END SCROLL TOP BUTTON -->

    <?php include "static/header.php";?>

    <!--=========== BEGIN COURSE BANNER SECTION ================-->
    <section id="imgBanner">
      <h2>Reply</h2>
    </section>
    <!--=========== END COURSE BANNER SECTION ================-->
    <!--=========== BEGIN COURSE BANNER SECTION ================-->
    <section id="courseArchive">
      <div class="container">
        <div class="row">
          <!-- start course content -->
           <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="courseArchive_content">
              <div class="row">
              <div class="col-lg-12 col-12 col-sm-12">
                  <div class="single_blog">
                    <?php 
                   $result = $MessageController->DisplaySinglePostFirst($_GET['re_thread_id']);
                   echo $result[0];
                   $_SESSION['thread_id']=$result[2];
                   ?>
                  </div>
                    <?php 
                   echo $MessageController->DisplaySinglePostReply($_GET['re_thread_id']);
                    //echo $result[0]
                    //printf( "turtle".$_GET['thread_id']);
                    ?>
                    <form action= "message.php" method="POST">
               <p><textarea rows="6" cols="66" class='' name='content_input' placeholder='content'></textarea></p>
                  <!--<input type='text' class='' name='address_input' placeholder='address'></p>-->
                    <input type='submit' class='' value = 'Reply'>
                    </form>
                </div>
              </div>
            </div>
          </div>
                
          <!-- End course content -->
        
        </div>
      </div>
    </section>
    <!--=========== END COURSE BANNER SECTION ================-->
  
    <!--=========== END COURSE BANNER SECTION ================-->
   <?php include "static/foot.html";?>
   <?php include "static/javascript.html";?>
     
  <!--=============================================== 
    Template Design By WpFreeware Team.
    Author URI : http://www.wpfreeware.com/
  ====================================================-->


  </body>
</html>
