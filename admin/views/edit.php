<?php include('_header.php'); ?>
<div class="container text-center">
<!-- clean separation of HTML and PHP -->
<h2><?php echo $_SESSION['user_name']; ?><br/><?php echo WORDING_EDIT_YOUR_CREDENTIALS; ?></h2>

<!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
<form class="form-signin" method="post" action="edit.php" name="user_edit_form_name">
    <label class="form-signin-heading" for="user_name"><?php echo WORDING_NEW_USERNAME; ?></label>
    <input class="form-control" id="user_name" type="text" name="user_name" pattern="[a-zA-Z0-9]{2,64}" required />
	<br />(<?php echo WORDING_CURRENTLY; ?>: <?php echo $_SESSION['user_name']; ?>)
    <br />
	<input class="btn btn-lg btn-primary btn-block" type="submit" name="user_edit_submit_name" value="<?php echo WORDING_CHANGE_USERNAME; ?>" />
</form><hr/>

<!-- edit form for user email / this form uses HTML5 attributes, like "required" and type="email" -->
<form class="form-signin" method="post" action="edit.php" name="user_edit_form_email">
    <label class="form-signin-heading" for="user_email"><?php echo WORDING_NEW_EMAIL; ?></label>
    <input class="form-control" id="user_email" type="email" name="user_email" required /> 
	<br />(<?php echo WORDING_CURRENTLY; ?>: <?php echo $_SESSION['user_email']; ?>)
    <br />
	<input class="btn btn-lg btn-primary btn-block" type="submit" name="user_edit_submit_email" value="<?php echo WORDING_CHANGE_EMAIL; ?>" />
</form><hr/>

<!-- edit form for user's password / this form uses the HTML5 attribute "required" -->
<form class="form-signin" method="post" action="edit.php" name="user_edit_form_password">
    <label class="form-signin-heading" for="user_password_old"><?php echo WORDING_OLD_PASSWORD; ?></label>
    <input class="form-control" id="user_password_old" type="password" name="user_password_old" autocomplete="off" />

    <label class="form-signin-heading" for="user_password_new"><?php echo WORDING_NEW_PASSWORD; ?></label>
    <input class="form-control" id="user_password_new" type="password" name="user_password_new" autocomplete="off" />

    <label class="form-signin-heading" for="user_password_repeat"><?php echo WORDING_NEW_PASSWORD_REPEAT; ?></label>
    <input class="form-control" id="user_password_repeat" type="password" name="user_password_repeat" autocomplete="off" />
	<br />
    <input class="btn btn-lg btn-primary btn-block" type="submit" name="user_edit_submit_password" value="<?php echo WORDING_CHANGE_PASSWORD; ?>" />
</form><hr/>

<!-- backlink -->
<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

</div>

<?php include('_footer.php'); ?>
