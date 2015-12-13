<?php
  include "include.php";
  require 'Controller/MessageController.php';
  require 'Controller/HoodController.php';

  $MessageController = new MessageController();
  $HoodController = new HoodController();
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
      <h2>Neighbor</h2>
    </section>-->
    <?php
      $content = $MessageController->DisplayBlockPost();
      $result = $HoodController->DisplayMembersOnMap();
    ?>
    <br><br><br></br>
    <?php include "google_map.php";?>

    <!--=========== END COURSE BANNER SECTION ================-->

    <!--=========== BEGIN COURSE BANNER SECTION ================-->
    <section id="courseArchive">
      <div class="container">
        <div class="row">
          <a class="navbar-brand" style='color:#5c5cd6;font-weight: bold; font-size: 24px;font-family: "Arial Verdana"' ><i class="fa fa-users"></i> <?php echo $HoodController->DisplayNeighborName();?></a>
          <div class='col-lg-12 col-12 col-sm-12'>
            <div class='single_blog_archive wow fadeInUp'>
              <h2 class='blog_title'>Members</h2>
              <div class="row">
                <?php echo $HoodController->DisplayMembersOnList()?>
                <!--<div class="col-lg-3 col-md-3 col-sm-3">
                    <h3>Best Tutor</h3>
                </div>-->
              </div>
            </div>
          </div>
          <!-- start course content -->
          <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="courseArchive_content">
              <!-- start blog archive  -->
              <div class="row">
                <!-- start single blog archive -->
                <?php echo $content[0];?>
                <!-- start single blog archive -->
              </div>
              <!-- end blog archive  -->
              <!-- start previous & next button -->
              <div class="single_blog_prevnext">
                <a href="#" class="prev_post wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;"><i class="fa fa-angle-left"></i>Previous</a>
                <a href="#" class="next_post wow fadeInRight animated" style="visibility: visible; animation-name: fadeInRight;">Next<i class="fa fa-angle-right"></i></a>
              </div>
            </div>
          </div>
          <!-- End course content -->
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


