<?php
include "include.php";
require_once 'Controller/MessageController.php';
require_once 'Controller/UserController.php';
require_once 'Model/UserModel.php';
$MessageController = new MessageController();
$UserController = new UserController();
$UserModel = new UserModel();
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
    <?php 
    if(isset($_GET['user_id'])){
        if ($_GET['user_id'] == $_SESSION['uid']){
            $result = $MessageController->DisplayUserPost($_SESSION['uid']);
        }else{
             $result = $MessageController->DisplayUserPost($_GET['user_id']);
        }
    }else{
    $result = $MessageController->DisplayUserPost($_SESSION['uid']);
    }?>
    
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
                  include_once 'Model/UserModel.php';
                  
                  $UserModel = new UserModel();
                  if(isset($_GET['user_id'])){
                    if($_GET['user_id'] == $_SESSION['uid']){
                        echo $UserController->DisplayUserProfile();
                        echo "<a class='blog_readmore' href='Profiledit.php'>Edit Profile</a>";
                    }else{
                        $Check = $UserModel->CheckRelationship($_GET['user_id']);
                        echo $UserController->DisplayUserInfo($_GET['user_id']);
                        
                        if($Check[0] == FALSE){
                        $content = $UserController->CheckRelationship($_GET['user_id']);
                        }
                        if($Check[1] == FALSE){
                        $content2 = $UserController->CheckRelationship($_GET['user_id']);
                        }
                    }
                  }else{
                 // echo "user";
                 //$content = $UserController->CheckRelationship($_GET['user_id']);
                  echo $UserController->DisplayUserProfile();
                  echo "<a class='blog_readmore' href='Profiledit.php'>Edit Profile</a>";
                  //$UserModel->GetUserInfo($_SESSION['uid']);
                  }
                                    
        ?>
                   <a <?php echo $content2[0];?> <?php echo $content2[4]; echo $content2[2]; ?>><?php echo $content2[5];?></a>
                  <a <?php echo $content[0];?> <?php echo $content[1]; echo $content[2]; ?>><?php echo $content[3];?></a>
                  
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
