<div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
		
		<!-- User Details for Sidebar -->
		<ul class="nav nav-sidebar">
		<span class="text-info">
            <li>Welcome</li>
            <li><?php
// if you need the user's information, just put them into the $_SESSION variable and output them here
echo WORDING_YOU_ARE_LOGGED_IN_AS . $_SESSION['user_name'] . "<br />";
//echo WORDING_PROFILE_PICTURE . '<br/>' . $login->user_gravatar_image_tag;
?></li>
          </span></ul>
		  
        </div>