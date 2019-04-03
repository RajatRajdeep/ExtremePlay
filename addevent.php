<?php include('config.php'); ?>
<?php
if(isset($_REQUEST['additem'])){
	$image = "images/".time() . '.' . end(explode(".",$_FILES["fileToUpload"]["name"]));
	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $image);
	$sql = "INSERT INTO `event` (parentid,title,image,datetime,userid,location,description) VALUES(".$_REQUEST['category'].",'".$_REQUEST['title']."','".$image."','".$_REQUEST['datetime']."',".$_SESSION['loginid'].",'".$_REQUEST['location']."','".$_REQUEST['description']."')";	
	if(mysqli_query($con,$sql)){
		$sql = "SELECT * FROM `event` WHERE userid=".$_SESSION['loginid']." AND image = '".$image."';";
		$result=mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
		//echo('<div class="alert alert-success">Event Added.</div>');
	$sql = "INSERT INTO `eventmember` (userid,eventid) VALUES(".$_SESSION['loginid'].",".$row['id'].") ; ";	
	mysqli_query($con,$sql);
	header('Location: event.php?id='.$row["id"]);
}
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
<div class="container">

<div class="row">
<div class="col-md-12">
<h3>Add Event</h3>
</div>
<div class="col-md-6 col-md-offset-3">

<form class="form white-text" method="post" enctype="multipart/form-data" >
<input name="title" type="text" placeholder="Title of the Event" />
<input name="description" type="text" placeholder="Description" />
<input name="location" type="text" placeholder="Location" />
<input name="datetime" type="text" placeholder="Date Time" />
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
Select Image<input class="btn btn-default form-control" name="fileToUpload" id="fileToUpload" type="file" >
<br /><br />
<button class="btn btn-primary" name="additem">Add Event</button>
</form>
</div>
</div>

</div>

<?php include('footer.php'); ?>

</body>
</html>