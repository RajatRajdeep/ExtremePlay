<nav id="menu" style="z-index:900;"  class="navbar navbar-default" style="background:#3A6073;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand text-black logo" style=" z-index:90;" href="index.php">Extreme Play</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      
		<ul class="nav navbar-nav navbar-right">
		<?php
		echo('
		<li><a class="text-black'); if(strpos($_SERVER['REQUEST_URI'],'category.php'))echo(' navemph'); echo(' " href="category.php">Sports</a></li>
		  ');
		?>
		<?php
		if(isset($_SESSION['loginid'])){
			
			echo('
		<li><a class="text-black'); if(strpos($_SERVER['REQUEST_URI'],'addevent.php'))echo(' navemph'); echo(' " href="addevent.php">Add Event</a></li>
		<li><a class="text-black'); if(strpos($_SERVER['REQUEST_URI'],'userprofile.php'))echo(' navemph'); echo(' " href="userprofile.php?id='.$_SESSION['loginid'].'">Profile</a></li>
		  ');
			
		echo('
		<li><a class="pointer text-black" href="index.php?logout">Logout</a></li>
	  	  ');
		}
	  ?>
	  
		<?php
		if(!isset($_SESSION['loginid'])){
		echo('
		<li><a class="text-black'); if(strpos($_SERVER['REQUEST_URI'],'login.php'))echo('navemph'); echo(' " href="login.php">Login</a></li>
		<li><a class="text-black'); if(strpos($_SERVER['REQUEST_URI'],'signup.php'))echo('navemph'); echo(' " href="signup.php">SignUp</a></li>
		');
		}
	  ?>
      </ul>
	  
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<br />