<?php include('config.php'); ?>
<?php
if(isset($_REQUEST['signup'])){
	
	$sql = "SELECT * FROM `user` WHERE `email`='".$_REQUEST['email']."' ; ";
	$result = mysqli_query($con,$sql);
	if($result->num_rows>0){echo('User already exists.');}
	
	$sql = "INSERT INTO `user` (`fullname`,`phone`,`email`,`address`,`password`) VALUES('".$_REQUEST['name']."','".$_REQUEST['phone']."','".$_REQUEST['email']."','".$_REQUEST['location']."','".$_REQUEST['password']."') ";
	mysqli_query($con,$sql);
	
	$sql = "SELECT * FROM `user` WHERE `email`='".$_REQUEST['email']."' ; ";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);
	$_SESSION['loginid']= $row['id'];
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<!-- Header -->
<head>
<?php include('header.php'); ?>
</head>
<!-- Header Close -->

<body class="text-center gradbackground white-text">

<?php include('navbar.php'); ?>

<div class="container-fluid">
<div class="row">
<div class="col-md-4 col-md-offset-4">
<h1 class="logo">SignUp</h1>

<form method="post" class="form form-inline">
<input type="text" name="name" class="form-control input-lg white-text" placeholder="Name" /><br /><br />
<input type="number" name="phone" class="form-control input-lg white-text" placeholder="Phone" /><br /><br />
<input type="text" name="location" class="form-control input-lg white-text" placeholder="Your Location ( City )" /><br /><br />
<input type="email" name="email" class="form-control input-lg white-text" placeholder="Email" /><br /><br />
<input type="password" name="password" class="form-control input-lg white-text" placeholder="Password" /><br /><br />
<button type="submit" class="btn blue btn-lg btn-primary" name="signup">SignUp</button><br /><br />
<a class="btn btn-lg btn-default" href="login.php">Login</a>
</form>

</div>
<br />

</div>
</div>

</body>
</html>