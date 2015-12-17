<?php
include "include.php";
require 'Controller/MessageController.php';
require 'Controller/UserController.php';

$MessageController = new MessageController();
$UserController = new UserController();
//$result = $MessageController->DisplayNewPost();
//printf('cda'.$result[1][0]['google_map']['lat']);

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
    <!--<section id="imgBanner">
      <h2>Home</h2>
    </section>-->
    <?php $result = $MessageController->DisplayNewPost();?>
    <br><br><br></br>
    <?php include "google_map.php"; ?>
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
                <?php echo $result[0];?>
                <!-- start single blog archive -->
              </div>
              <!-- end blog archive  -->
            </div>
          </div>
          <!-- End course content -->

          <!-- start course archive sidebar -->
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="courseArchive_sidebar">
              <!-- start single sidebar -->

              <!-- start single sidebar -->
              <div class="single_sidebar">
                <h2>Notify <span class="fa fa-angle-double-right"></span></h2>
                <ul>
                  <?php echo $UserController->DisplayFriendNotify(); ?>
                  <?php echo $UserController->DisplayNeighborNotify(); ?>
                  <!--<?php echo $UserController->DisplayBlockNotify(); ?>-->
                  <!--<li><a href="#">Food</a></li>-->
                </ul>
              </div>
              <!-- End single sidebar -->

            </div>
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


