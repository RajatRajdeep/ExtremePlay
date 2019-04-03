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

<?php
$sql = "SELECT * FROM `category` ;";
$result =mysqli_query($con,$sql);
if($result->num_rows > 0){
while($row = mysqli_fetch_array($result)){
echo('
<a href="item.php?id='.$row["id"].'">
<div class="col-md-3 col-xs-6 text-center ">
<div class="shadow curve white black-text ">
              <img src="'.$row["image"].'" class="img img-responsive curve center-block">
            
			<h5 style="padding: 10px !important;margin: 0px;">'.$row["category"].'</h5>
              <p>'.$row["description"].'</p>
  </div>
  </div>
  </a>
  ');
}
}
?>  

</div>



</div>

<?php include('footer.php'); ?>

</body>
</html>