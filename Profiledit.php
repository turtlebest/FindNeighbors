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
      <h2>Profile</h2>
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

                  <form action= "login_active.php" method="POST">
                  <input type='text' class='' name='uname_input' placeholder='user name'></p>
                  <input type='text' class='' name='password_input' placeholder='password'></p>
                  <input type='text' class='' name='intro_input' placeholder='introduction'></p>
                  <input type='text' class='' name='city_input' placeholder='city'></p>
                  <input type='text' class='' name='state' placeholder='state'</p>
                  </p>
                  <select>
                    <option>b01 6 Ave between 32nd and 36th Street</option>
                    <option>b02 12 Street between 1st and 3rd Street</option>
                    <option>b03 Columbus Ave between 59th and 65th Street</option>
                    <option>b04 50th Ave between Vernon Blvd and Jackson Ave</option>
                    <option>b05 7th Ave between 3rd and 6th Street</option>
                    <option>b06 Jay Street between Fulton and Johnson Street</option>
                    </select></p>
                  <input type='submit' class='' value = 'Create'>
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