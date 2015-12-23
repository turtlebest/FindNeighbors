<?php
include "include.php";
require 'Controller/MessageController.php';
require 'Controller/FriendController.php';
require 'Controller/NeighborController.php';
$MessageController = new MessageController();
$FriendController = new FriendController();
$NeighborController = new NeighborController();
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
      <h2>Search</h2>
    </section>
    <!--=========== END COURSE BANNER SECTION ================-->
    <!--=========== BEGIN COURSE BANNER SECTION ================-->
    <section id="courseArchive">
      <div class="container">
        <div class="row">
          <!-- start course content -->
          <a class="navbar-brand" style='color:#5c5cd6;font-weight: bold; font-size: 24px;font-family: "Arial Verdana"' ><i class="fa fa-home"></i> Search</a>
          
          <br><br><br>
           <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="courseArchive_content">
              
              <div class="row">
              <div class="col-lg-12 col-12 col-sm-12">
                  <div class="single_blog">
                  <form action= "search.php" method="POST">
                  <input type='text' class='' name='keyword_input' placeholder='keyword'></p>
               
                  <!--<input type='text' class='' name='address_input' placeholder='address'></p>-->
                    <input type='submit' class='' value = 'Search'>
                    </form>
                    <br>
                    <?php
                    if(isset($_POST['keyword_input'])){ 
                    echo "<h2 class='blog_title'>Post</h2>";
                    //echo "keyword";
                    echo $_POST['keyword_input'];
                   $result = $MessageController->DisplaySearchPost($_POST['keyword_input']);
                   echo $result[0];
                   echo "<h2 class='blog_title'>Friends</h2>";
                   $result2 = $FriendController->DisplaySearchFriend($_POST['keyword_input']);
                   echo $result2[0];
                   echo "<h2 class='blog_title'>Neighbors</h2>";
                   $result3 = $NeighborController->DisplaySearchNeighbor($_POST['keyword_input']);
                   echo $result3[0];
                   }
                   //$_SESSION['thread_id']=$result[2];
                   ?>
                  </div>
                    <?php 
                   echo $MessageController->DisplaySinglePostReply($_GET['re_thread_id']);
                    //echo $result[0]
                    //printf( "turtle".$_GET['thread_id']);
                    ?>
                    
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
