<?php
include "include.php";
// Unset all of the session variables.
$_SESSION = array();
$_SESSION['Login'] = FALSE;


//include 'index2.php';

?>
<!DOCTYPE html>
<html lang="en">
  <?php include "static/template.php";?>
  <body>    

    <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"></a>
    <!-- END SCROLL TOP BUTTON -->

    <!--=========== BEGIN HEADER SECTION ================-->
    <?php include "static/header.php";?>
    <!--=========== END HEADER SECTION ================--> 

    <!--=========== BEGIN SLIDER SECTION ================-->
    <section id="slider">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="slider_area">
            <!-- Start super slider -->
            <div id="slides">
              <ul class="slides-container">                          
                <li>
                  <img src="img/slider/2.jpg" alt="img">
                   <div class="slider_caption">
                    <h2>Largest & Beautiful University</h2>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                    <a class="slider_btn" href="login.php">Login</a>
                    <a class="slider_btn" href="createaccount.php">Create Account</a>
                  </div>
                  </li>
                <!-- Start single slider-->
                <li>
                  <img src="img/slider/3.jpg" alt="img">
                   <div class="slider_caption slider_right_caption">
                    <h2>Better Education Environment</h2>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search</p>
                    <a class="slider_btn" href="#">Login</a>
                    <a class="slider_btn" href="#">Create Account</a>
                  </div>
                </li>
                <!-- Start single slider-->
                <li>
                  <img src="img/slider/4.jpg" alt="img">
                   <!--<form action= <?php echo $action; ?> method="POST">-->
                   <div class="slider_caption">
                    <h2>Find out you in better way</h2>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search</p>
                    <a class="slider_btn" href=<?php echo $action; ?>>Login</a>
                    <a class="slider_btn" href="#">Create Account</a>
                  </div>
                      <!--</form>-->
                </li>
              </ul>
              <nav class="slides-navigation">
                <a href="#" class="next"></a>
                <a href="#" class="prev"></a>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=========== END SLIDER SECTION ================-->


    <!--=========== BEGIN FOOTER SECTION ================-->
    <?php include "static/foot.html";?>
    <?php include "static/javascript.html";?>


  </body>
</html>