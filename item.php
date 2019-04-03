<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<!-- Header -->
<head>
<?php include('header.php'); ?>
 
</head>
<!-- Header Close -->

<body class="text-center gradbackground text-white">

<?php include('navbar.php'); ?>

<div class="container-fluid" >
<div class="row">
<div class="col-md-12">

<?php
$sql = "SELECT * FROM `category` WHERE id = ".$_REQUEST['id'].";";
$result =mysqli_query($con,$sql);
if($result->num_rows > 0){
$row = mysqli_fetch_array($result);
echo('<h3><span class="text-capitalize">'.$row['category'].'</span> Events</h3>');

$sql = "SELECT * FROM `event` WHERE parentid = ".$_REQUEST['id'].";";
$result =mysqli_query($con,$sql);
if($result->num_rows > 0){
while($row = mysqli_fetch_array($result)){
echo('
<div class="col-md-3">
<a href="event.php?id='.$row["id"].'">
  <div class="card black-text">
    <div class="card-image waves-effect waves-block waves-light">
      <img class="activator" style="height:200px" src="'.$row["image"].'">
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">'.$row["title"].'</span>
    </div>
  </div>
  </a>
  </div>
  ');
}
}
}
?>  
  
            
</div>
</div>

</div>


<!-- Footer -->
<div class="container text-center">
   
    <div class="row">
        <div class="col-lg-12">
		<hr />
            <ul class="nav nav-pills nav-justified">
                <li><a href="about.php">About Us</a></li>
                <li><a href="#">Login</a></li>
                <li><a href="#">SignUp</a></li>
            </ul>
        </div>
    </div>
</div>
<br />
<!-- Footer Close -->

</body>
</html>