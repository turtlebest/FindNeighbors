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
      <h2>New account</h2>
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

                  <form action= "newaccount.php" method="POST">
                  <input type='text' class='' name='uname_input' placeholder='user name'></p>
                  <input type='text' class='' name='uid_input' placeholder='user id'></p>
                  <input type='password' class='' name='password_input' placeholder='password'></p>
                  <input type='text' class='' name='intro_input' placeholder='introduction'></p>
                  <input type='text' class='' name='address_input' placeholder='address'></p>
                  <!--<input type='text' class='' name='city_input' placeholder='city'></p>
                  <input type='text' class='' name='state_input' placeholder='state'</p>
                  </p>-->
                  <br>
                  <?php
                  include "include.php";
                  //equire 'Model/MessageModel.php';
                  require 'Model/BlockModel.php';
                 
                  $BlockModel = new BlockModel();
                  echo "<select name='GetBlockList'>";
                  $BlockModel->GetBlockList();
                 
                  //printf($_SESSION['hid']);
                  ?>
                  <!--<select name='block_input'>
                    
                    <option value='b01'> 6 Ave between 32nd and 36th Street</option>
                    <option value='b02'> 12 Street between 1st and 3rd Street</option>
                    <option value='b03'> Columbus Ave between 59th and 65th Street</option>
                    <option value='b04'> 50th Ave between Vernon Blvd and Jackson Ave</option>
                    <option value='b05'> 7th Ave between 3rd and 6th Street</option>
                    <option value='b06'> Jay Street between Fulton and Johnson Street</option>
                    </select></p>-->
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

