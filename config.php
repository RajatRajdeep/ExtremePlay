<?php
//error_reporting(0);
session_start();
$con = mysqli_connect("localhost","root","","sport");

if(isset($_REQUEST['logout'])){
session_unset();
session_destroy(); 
}

function printprofile($userid){
	global $con;
	$sql="SELECT * FROM `user` WHERE id=".$userid.";";
	$result=mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);
	echo("<a href='userprofile.php?id=".$row['id']."'><img class='img-thumbnail' style='height:30px;' src='".$row['image']."' /> ".$row['fullname']."</a>");
}

?>