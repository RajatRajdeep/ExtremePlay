<?php include('config.php'); ?>
<?php
if(isset($_REQUEST['d'])){
$sql = "DELETE FROM `eventmember` WHERE userid = ".$_REQUEST['d']." AND eventid = ".$_REQUEST['id']."; ";
mysqli_query($con,$sql);	
}

if(isset($_REQUEST['j'])){
$sql = "INSERT INTO `eventmember` ( userid,eventid) VALUES(  ".$_REQUEST['j']." , ".$_REQUEST['id']." ); ";
mysqli_query($con,$sql);	
}

if(!isset($_SESSION['loginid'])){
	header('Location: login.php');
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

<?php
$sql = "SELECT * FROM `event` WHERE id = ".$_REQUEST['id'].";";
$result =mysqli_query($con,$sql);
if($result->num_rows > 0){
while($row = mysqli_fetch_array($result)){
echo('
<div class="col-md-4">
<img class="img img-responsive" style="max-height:300px;" src="'.$row['image'].'" />
</div>
<div class="col-md-4">
<h4>'.$row['title'].'</h4>
<b>'.$row['location'].'</b>
<p>'.$row['datetime'].'</p>
<p>'.$row['description'].'</p>');
echo(' Created By - ');
printprofile($row['userid']);
echo('<br />');

$sql2 = "SELECT * FROM `eventmember` WHERE eventid = ".$_REQUEST['id']." AND userid = ".$_SESSION['loginid']." ;";
$result2 =mysqli_query($con,$sql2);
if($result2->num_rows == 0){echo('<br /><a class="btn btn-primary blue" href="?id='.$_REQUEST['id'].'&j='.$_SESSION['loginid'].'">Join</a>');}

echo('</div>
<div class="col-md-4">

  <ul class="collection with-header black-text">
        <li class="collection-header"><h5>Going</h5></li>
');
$sql2 = "SELECT * FROM `eventmember` WHERE eventid = ".$_REQUEST['id'].";";
$result2 =mysqli_query($con,$sql2);
if($result2->num_rows > 0){
while($row2 = mysqli_fetch_array($result2)){
	echo('<li class="collection-item"><div>');
		printprofile($row2['userid']);
	if($_SESSION['loginid'] == $row2['userid']){echo(' <a href="?id='.$_REQUEST['id'].'&d='.$row2['userid'].'" class="secondary-content"><i class="material-icons red-text">close</i></a>');}
	echo('</div></li>');
}}
echo('</ul>
</div>
');
}
}
?>

</div>

</div>

<?php include('footer.php'); ?>

</body>
</html>