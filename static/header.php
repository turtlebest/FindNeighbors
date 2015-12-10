 <!--=========== BEGIN HEADER SECTION ================-->
    <header id="header">
      <!-- BEGIN MENU -->
      <div class="menu_area">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <!-- LOGO -->
              <!-- TEXT BASED LOGO -->
              <a class="navbar-brand" href="index.php">B <span>rooklyner!</span></a>
              <!-- IMG BASED LOGO  -->
               <!-- <a class="navbar-brand" href="index.html"><img src="img/logo.png" alt="logo"></a>  -->
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
                <?php if ($_SESSION['Login']) { ?>
                <li><a href="home.php">Home</a></li>
                <li><a href="block.php">Block</a></li>
                <li><a href="neighbor.php">Hood</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Connect<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="contact.php">Friend</a></li>
                    <li><a href="#">Neighbor</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Other<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="contact.php">Profile</a></li>
                    <li><a href="#">Post Message</a></li>
                    <li><a href="login.php">Logout</a></li>
                    <li><a href="#">Link Three</a></li>
                  </ul>
                </li>
                <?php } else { ?>
                <li><a href="contact.php">About Us</a></li>
                <?php } ?>
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </nav>
      </div>
      <!-- END MENU -->
    </header>
    <!--=========== END HEADER SECTION ================-->