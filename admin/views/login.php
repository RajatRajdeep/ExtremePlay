<!DOCTYPE html>
<html lang="en">
<?php include('_header.php'); ?>
  <body>
<!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
    <div class="container">
      <form class="form-signin" method="post" action="index.php" name="loginform">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="user_name" class="sr-only"><?php echo WORDING_USERNAME; ?></label>
        <input id="user_name" class="form-control" placeholder="<?php echo WORDING_USERNAME; ?>" autofocus="" type="text" name="user_name" required />
        <label for="user_password" class="sr-only"><?php echo WORDING_PASSWORD; ?></label>
        <input id="user_password" class="form-control" placeholder="<?php echo WORDING_PASSWORD; ?>" type="password" name="user_password" autocomplete="off" required />
        <div class="checkbox">
          <label>
            <input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" /><?php echo WORDING_REMEMBER_ME; ?>
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login" ><?php echo WORDING_LOGIN; ?></button>
		<?php
		/*<a href="register.php"><?php echo WORDING_REGISTER_NEW_ACCOUNT; ?></a>*/
		?>
<a href="password_reset.php"><?php echo WORDING_FORGOT_MY_PASSWORD; ?></a>
      </form>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

</body></html>