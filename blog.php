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
<h3>Blog</h3>
<hr />
</div>
<div class="col-md-12">

<?php
$sql = "SELECT * FROM `blog` ;";
$result = mysqli_query($con,$sql);
if($result->num_rows > 0){
while($row = mysqli_fetch_array($result)){
echo($row['message'].'<br /><hr />');
}
}
?>
</div>
</div>

</div>

<?php include('footer.php'); ?>

</body>
</html>