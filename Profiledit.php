<?php
include "include.php";
include_once ('Model/UserModel.php');
require_once 'Controller/UserController.php';
$UserController = new UserController();

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
                
                  <form action= 'ProfileSubmit.php' method='POST'>
                  <?php
                  
                  //$UserModel = new UserModel();
                  //$UserModel->GetUserProfile();
                  echo $UserController->EditUserProfile();
                  
                  ?>
                  <div class='col-lg-12 col-12 col-sm-12'>
                      <div class='single_blog'>
                  <?php
                  include "include.php";
                  //require 'Model/MessageModel.php';
                  include_once 'Model/BlockModel.php';
                  
                 
                  $BlockModel = new BlockModel();
                  $BlockModel->GetBid();

                  echo "Block: ";
                  echo $_SESSION['bid'];
                  echo "<br>";

                  echo "<select name='GetBlockList'>";                  
                  echo "<option value='' selected=''>  </option>";

                  $BlockModel->GetBlockList();
                  ?>
                 </div>
                </div>
                <p class='blog_summary'>If changing your current block, you will need to be reapproved by the block members.</p>
                <br><br>
                <div class='col-lg-12 col-12 col-sm-12'>
                 <div class='single_blog'>
                
                  <input type='submit' class='' value = 'Save Changes'>

                </p>
                </form>
                 </div>
                </div>
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