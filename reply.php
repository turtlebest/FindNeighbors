<?php
include "include.php";

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
              <!-- start blog archive  -->
              <div class="row">
                <!-- start single blog archive -->

                  <form action= "message.php" method="POST">
                  <input type='text' class='' name='content_input' placeholder='content'></p>
                  <input type='text' class='' name='address_input' placeholder='address'></p>
                  <input type='submit' class='' value = 'Reply'>
                </p>
                </form>
                   </div>
                </div>
              </div>
          
          
          <!-- start course archive sidebar -->
         <!-- start course archive sidebar -->
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="courseArchive_sidebar">
              <!-- start single sidebar -->
              
              <!-- start single sidebar -->
              <div class="single_sidebar">
                <h2>Category <span class="fa fa-angle-double-right"></span></h2>
                <ul>
                  <li><a href="#">Food</a></li>
                  <li><a href="#">Technology</a></li>
                  <li><a href="#">Fashion</a></li>
                  <li><a href="#">Business</a></li>
                  <li><a href="#">Games</a></li>
                </ul>
              </div>
              <!-- End single sidebar -->
              
            </div>
          </div>
          <!-- start course archive sidebar -->
        </div>
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
