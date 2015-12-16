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
    <br></br>
    <!--=========== END COURSE BANNER SECTION ================-->
    <!--=========== BEGIN COURSE BANNER SECTION ================-->
    <section id="courseArchive">
      <div class="container">
        <div class="row">
          <!-- start course content -->
          <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="courseArchive_content">
              <!-- start blog archive  -->
              <div class="row">
                <!-- start single blog archive -->
                <div class="col-lg-12 col-12 col-sm-12">
                  <div class="single_blog">
                    <?php $result = $MessageController->DisplaySinglePostFirst($_GET['thread_id']);
echo $result[0];
                    ?>
                  </div>
                    <?php echo $MessageController->DisplaySinglePostReply($_GET['thread_id']);
                    //printf( "turtle".$_GET['thread_id']);
                    ?>
                </div>
              </div>
              <a class='blog_readmore' href=<?php echo $result[1]; ?>><i class="fa fa-reply" style='color:#ffac33'></i> Reply</a>
              <!-- end blog archive  -->
            </div>
          </div>
          <!-- start course archive sidebar -->
          <div class="col-lg-4 col-md-4 col-sm-4">
          </div>
          <!-- start course archive sidebar -->
        </div>
      </div>
    </section>
    <!--=========== END COURSE BANNER SECTION ================-->
   <?php include "static/foot.html";?>
   <?php include "static/javascript.html";?>
  <!--===============================================
    Template Design By WpFreeware Team.
    Author URI : http://www.wpfreeware.com/
  ====================================================-->
  </body>
</html>


