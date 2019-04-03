<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<!-- Header -->
<head>
<?php include('header.php'); ?></head>
<!-- Header Close -->

<body class="text-center gradbackground text-white">

<?php include('navbar.php'); ?>
<div class="container-fluid">
<div class="row">
<div class="col-md-4 col-md-offset-4">
<h1 class="logo">Login</h1>

<?php
if(isset($_REQUEST['login'])){
	
	$sql = "SELECT * FROM `user` WHERE `email`='".$_REQUEST['email']."' AND `password`='".$_REQUEST['password']."' ; ";
	$result = mysqli_query($con,$sql);
	if($result->num_rows>0){
	$row = mysqli_fetch_array($result);
	$_SESSION['loginid']= $row['id'];
	echo('<script>window.location="index.php";</script>');
	}
	else{echo('<div class="alert alert-danger">Wrong Email or Password</div>');}
}
?>

<form id="login" method="post" class="form form-inline">
<input type="text" id="email" name="email" class="form-control input-lg white-text" placeholder="Email" />
<br /><br />
<input type="password" name="password" class="form-control input-lg white-text" placeholder="Password" />
<br /><br />
<button type="submit" class="btn btn-lg btn-primary blue" name="login">Login</button><br /><br />
<a class="btn btn-lg btn-default green" href="signup.php">SignUp</a>
</form>

</div>
<br />

</div>
</div>

</body>
</html>