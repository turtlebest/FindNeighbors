<!DOCTYPE html>
<html lang="en">
  <?php include "static/template.php";?>
  <body>    

    <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"></a>
    <!-- END SCROLL TOP BUTTON -->

    <!--=========== BEGIN HEADER SECTION ================-->
    <?php include "static/header.php";?>
    <section id="imgBanner">
      <h2>Login</h2>
    </section>    
    <!--=========== END HEADER SECTION ================--> 
    <section id="courseArchive">
      <div class="container">
        <div class="row">
          <!-- start course content -->
          <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="courseArchive_content">
              <!-- start blog archive  -->
              <div class="row">
                <!-- start single blog archive -->
                <div class="col-lg-12 col-12 col-sm-12">
                  <div class="single_blog_archive wow fadeInUp">
                      <br></br> 
                  <form action= "login_active.php" method="POST">
                  <input type='text' class='' name='account_input' placeholder='account'>
                </p>  
                  <input type='text' class='' name='password_input' placeholder='password'></P>
                  <input type='submit' class='' value = 'login'>
                </p>
                </form>
                   </div>
                </div>
              </div>
          </div>
          <!-- start course archive sidebar -->
        </div>
            </div>
          </div>
          <!-- start course archive sidebar -->
        </div>

        </section>    
    <!--=========== BEGIN FOOTER SECTION ================-->
    <footer id="footer">


    <?php include "static/foot.html";?>
    <?php include "static/javascript.html";?>

  </body>
</html>