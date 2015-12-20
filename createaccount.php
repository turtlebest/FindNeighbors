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
                  <input type='text' class='' name='uname_input' placeholder='User Name'></p>
                  <input type='text' class='' name='uid_input' placeholder='User ID'></p>
                  <input type='password' class='' name='password_input' placeholder='Password'></p>
                  <p><textarea rows="4" cols="50" class='' name='intro_input' placeholder='About Me'></textarea></p>
                  <input type='text' class='' name='address_input' placeholder='Address' size = '51'></p>
                  <!--<input type='text' class='' name='city_input' placeholder='city'></p>
                  <input type='text' class='' name='state_input' placeholder='state'</p>
                  </p>-->
                  <br>
                  <?php
                  include "include.php";
                  //equire 'Model/MessageModel.php';
                  require 'Model/BlockModel.php';
                 
                  $BlockModel = new BlockModel();
                  echo "Block";
                  echo "<br>";
                  echo "<select name='GetBlockList'>";
                  $BlockModel->GetBlockList();
                 
                  //printf($_SESSION['hid']);
                  ?>
                  
                  <input type='submit' class='' value = 'Create'>
                </p>
                </form>
                   </div>
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

