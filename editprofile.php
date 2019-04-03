<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<!-- Header -->
<head>
<?php include('header.php'); ?>
</head>
<!-- Header Close -->

<body class="text-center gradbackground white-text">

<?php include('navbar.php'); ?>
<div class="container">

<div class="row">
<div class="col-md-12">
<h3>Edit Profile</h3>
</div>
<div class="col-md-12">

<?php 

if(isset($_REQUEST['saveprofile'])){
$sql="UPDATE `user` SET fullname='".$_REQUEST['name']."' , email='".$_REQUEST['email']."' , phone='".$_REQUEST['phone']."' , address='".$_REQUEST['address']."', profession='".$_REQUEST['profession']."', birthday='".$_REQUEST['birthday']."' WHERE id = ".$_REQUEST['id']." ; ";
mysqli_query($con,$sql);
echo('<div class="alert alert-success">Profile Saved</div>');
	}
else if(isset($_REQUEST['changep'])){
$sql="UPDATE `user` SET password='".$_REQUEST['password']."' WHERE id = ".$_REQUEST['id']." ; ";
mysqli_query($con,$sql);
echo('<div class="alert alert-success">Password Changed</div>');
	}
	
	else if(isset($_REQUEST['uploadpic'])){
	$image = "images/".time() . '.' . end(explode(".",$_FILES["fileToUpload"]["name"]));
	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $image);
	$sql="UPDATE `user` SET image='".$image."' WHERE id = ".$_REQUEST['id']." ; ";
mysqli_query($con,$sql);
	}
	
	else if(isset($_REQUEST['di'])){
	$sql = "SELECT * FROM `user` WHERE id=".$_REQUEST['id']."; ";
$result=mysqli_query($con,$sql);
$row= mysqli_fetch_array($result);
unlink($row['image']);
	
	$sql="UPDATE `user` SET image='' WHERE id = ".$_REQUEST['id']." ; ";
$result=mysqli_query($con,$sql);
$row= mysqli_fetch_array($result);
	}

$sql = "SELECT * FROM `user` WHERE id=".$_REQUEST['id']."; ";
$result=mysqli_query($con,$sql);
if($result->num_rows>0){
$row= mysqli_fetch_array($result);
?>

<?php if(strlen($row['image'])>0)
	echo("<img src='".$row['image']."' class='w3-circle' style='height:106px;width:106px' alt='Avatar'>"); 
else {echo('<i class="fa fa-user fa-5x"></i>');} ?>
<br />
<form class="form form-inline" method="post" enctype="multipart/form-data">
<input class="btn btn-default form-control" name="fileToUpload" id="fileToUpload" type="file" />
<button class="btn btn-primary blue" name="uploadpic">Upload Image</button>
</form>
<form>
<br />
<?php if(strlen($row['image'])>0) echo('<a href="?id='.$_REQUEST['id'].'&di" class="btn btn-primary red">Delete Image</a>'); ?>
</form>

</div>
<div class="col-md-6 col-md-offset-3">

<form method="post" class="form">
<input class="form-control white-text" type="text" name="name" placeholder="Name" value="<?php echo($row['fullname']); ?>" />
<input class="form-control white-text" type="text" name="email" placeholder="Email" value="<?php echo($row['email']); ?>" />
<input class="form-control white-text" type="text" name="phone" placeholder="Phone" value="<?php echo($row['phone']); ?>" />
<input class="form-control white-text" type="text" name="address" placeholder="Address" value="<?php echo($row['address']); ?>" />
<input class="form-control white-text" type="text" name="profession" placeholder="Profession" value="<?php echo($row['profession']); ?>" />
<input class="form-control white-text" type="text" name="birthday" placeholder="Birthday" value="<?php echo($row['birthday']); ?>" />
<button class="btn btn-primary" name="saveprofile">Save Profile</button>
</form>


<form method="post" class="form">
<input class="form-control white-text" name="password" type="password" placeholder="New Password" />
<button class="btn btn-primary" name="changep">Change Password</button>
</form>

<br />
<h5>My Sports - </h5>
<?php


if(isset($_REQUEST['addinterest'])){$sql="INSERT INTO `interest` (userid,categoryid) VALUES (".$_SESSION['loginid'].",".$_REQUEST['category'].") ;";mysqli_query($con,$sql);}
if(isset($_REQUEST['dint'])){$sql="DELETE FROM `interest` WHERE userid=".$_SESSION['loginid']." AND categoryid=".$_REQUEST['dint'].";";mysqli_query($con,$sql);}

$sql="SELECT * FROM `interest` WHERE userid = ".$_SESSION['loginid']." GROUP BY categoryid;";
$result =mysqli_query($con,$sql);
if($result->num_rows > 0){
while($row = mysqli_fetch_array($result)){
	$sql2="SELECT * FROM `category` WHERE id = ".$row['categoryid'].";";
	$result2 =mysqli_query($con,$sql2);
	$row2 = mysqli_fetch_array($result2);
echo('<p>'.$row2["category"].' <a href="?id='.$_REQUEST['id'].'&dint='.$row2['id'].'" class="secondary-content"><i class="material-icons red-text">close</i></a> </p>');
}
}
?> 

<form method="post" class="form">
<select class="browser-default black-text" name="category">
<?php

$sql="SELECT * FROM `category` ;";
$result =mysqli_query($con,$sql);
if($result->num_rows > 0){
while($row = mysqli_fetch_array($result)){
echo('<option value='.$row["id"].'>'.$row["category"].'</option>');
}
}
?> 
</select>
<br />
<button class="btn btn-primary" name="addinterest">Add Sport</button>
</form>

<?php
}
?>
</div>
</div>

</div>

<?php include('footer.php'); ?>

</body>
</html>