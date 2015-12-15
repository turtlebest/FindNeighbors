<?php
include "include.php";
require 'Controller/NeighborController.php';
include_once 'Model/NeighborModel.php';

$NeighborController = new NeighborController();
//$NeighborModel = new NeighborModel();
?>
<!DOCTYPE html>
<html lang="en">
<?php include "static/template.php";?>
  <body>
    <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"></a>
    <!-- END SCROLL TOP BUTTON -->

    <?php include "static/header.php";?>
    <?php
      $content = $NeighborController->DisplayNeighborProfile();
      $result = $NeighborController->DisplayMembersOnMap();
      $suggest = $NeighborController->DisplaySuggestNeighbors();
    ?>
    <br><br><br></br>
    <?php include "google_map.php";?>
    <!--=========== END COURSE BANNER SECTION ================-->

    <!--=========== BEGIN COURSE BANNER SECTION ================-->
    <section id="courseArchive">
      <div class="container">
        <div class="row">
          <!-- start course content -->
          <a class="navbar-brand" style='color:#5c5cd6;font-weight: bold; font-size: 24px;font-family: "Arial Verdana"' ><i class="fa fa-home"></i> Neighbors</a>
          <div class='col-lg-12 col-12 col-sm-12'>
            <div class='single_blog_archive wow fadeInUp'>
              <h2 class='blog_title'>Members</h2>
              <div class="row">
                <?php echo $NeighborController->DisplayMembersOnList()?>
              </div>
            </div>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="courseArchive_content">
              <!-- start blog archive  -->
              <div class="row">
                <!-- start single blog archive -->
                <?php echo $content[0];?>
                <!-- start single blog archive -->
              </div>
              <!-- end blog archive  -->
            </div>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="courseArchive_content">
              <!-- start blog archive  -->
              <div class="row">
                <a class="navbar-brand" style='color:#5c5cd6;font-weight: bold; font-size: 24px;font-family: "Arial Verdana"' ><i class="fa fa-users"></i>Suggest Neighbors</a>
                <!-- start single blog archive -->
                <?php echo $NeighborController->AddNeighbor($_GET['neighbor_id']);?>
                <?php echo $suggest[0];?>
                <!-- start single blog archive -->
              </div>
              <!-- end blog archive  -->
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

