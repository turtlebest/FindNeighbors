<?php
include "include.php";
require 'Controller/MessageController.php';
$MessageController = new MessageController();
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
    <?php $result = $MessageController->DisplayUserPost();?>
    
    <br><br><br></br>
    <?php include "google_map.php";?>
    <!--=========== END COURSE BANNER SECTION ================-->

    <!--=========== BEGIN COURSE BANNER SECTION ================-->
    <section id="courseArchive">
      <div class="container">
        <div class="row">
          <!-- start course content -->
          <div class='col-lg-12 col-12 col-sm-12'>
            <div class='single_blog_archive wow fadeInUp'>
            <h2 class='blog_title'>Profile</h2>
            <div class="row">
            <p class='blog_summary'>
            
          <?php
                  include "include.php";
                  include_once 'Model/MessageModel.php';
                  
                  $MessageModel = new MessageModel();
                  $MessageModel->GetUserInfo();
                  
                  echo "&nbsp&nbsp&nbsp&nbsp&nbsp";                  
                  echo "Name: "; 
                  echo $_SESSION['uname'];
                  echo "<br><br>";
                  //echo "<input type='text' class='' name='uname_edit' placeholder='user name'></p>";
                  //echo $_SESSION['password'];
                  //echo "<br>";
                  //echo "<input type='text' class='' name='password_edit' placeholder='password'></p>";
                  echo "&nbsp&nbsp&nbsp&nbsp&nbsp"; 
                  echo "About me: ";
                  echo $_SESSION['introduction'];
                  echo "<br><br>";
                  //echo "<input type='text' class='' name='intro_edit' placeholder='introduction'></p>";
                  echo "&nbsp&nbsp&nbsp&nbsp&nbsp"; 
                  echo "Address: ";
                  echo $_SESSION['address'];
                  echo "<br><br>";
                  //echo "<input type='text' class='' name='address_edit' placeholder='address'></p>";
                  
                  ?>
                  </p>
                  <a class='blog_readmore' href='Profiledit.php'>Edit Profile</a>
                  </div>
            </div>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="courseArchive_content">
              <!-- start blog archive  -->
              <div class="row">
                <!-- start single blog archive -->
                <?php echo $result[0];?>
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
