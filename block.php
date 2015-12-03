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
      <h2>Block</h2>
    </section>
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
                <?php echo $MessageController->DisplayBlockPost();?>
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


