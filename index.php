<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<!-- Header -->
<head><?php include('header.php'); ?>
</head>
<!-- Header Close -->

<body class="text-center gradbackground text-white">

<?php include('navbar.php'); ?>

<div class="container-fluid" >
<div class="row">
<div id="carousel" class="carousel slide" data-ride="carousel" style="height: 100%;">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel" data-slide-to="0" class="active"></li>
    <li data-target="#carousel" data-slide-to="1"></li>
    <li data-target="#carousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active ">
      <img class="center-block" src="img/mike-erskine-144525.jpg" alt="camping 1">
      <div class="carousel-caption">
        <h5>Camp out with friends</h5>
      </div>
    </div>
    
	<div class="item">
      <img class="center-block" src="img/anthony-mapp-235816.jpg" alt="bmx">
      <div class="text-black carousel-caption">
        <h5>BMX</h5>
      </div>
    </div>
    
	<div class="item">
      <img class="center-block" src="img/david-200073.jpg" alt="cycle">
      <div class="text-black carousel-caption">
        <h5>Cycling</h5>
      </div>
	
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
</div>
</div>

<br />

<div class="container">
<div class="row">
<a href="item.php?id=20">
<div class="col-md-2 col-sm-2">
<img class="img img-responsive img-thumbnail" src="img/cycling.jpg" />
<h5 class="white-text">Cycling</h5>
</div>
</a>
<a href="item.php?id=6">
    <div class="col-md-2 col-sm-2">
	<img class="img img-responsive img-thumbnail" src="img/hans-eiskonen-25804.jpg" />	
    <h5 class="white-text">Skateboarding</h5>
</div>
</a>
<a href="item.php?id=3">
    <div class="col-md-2 col-sm-2">
    <img class="img img-responsive img-thumbnail" src="img/parkour.jpg" />
	<h5 class="white-text">Parkour</h5>
</div>
</a>
<a href="item.php?id=4">
<div class="col-md-2 col-sm-2">
<img class="img img-responsive img-thumbnail" src="img/liz99-254943.jpg" />
    <h5 class="white-text">Scootering</h5>
</div>
</a>
<a href="item.php?id=11">
<div class="col-md-2 col-sm-2">
<img class="img img-responsive img-thumbnail" src="img/rafting_5134.jpg" />
    <h5 class="white-text">Rafting</h5>
</div>
</a>
<a href="item.php?id=12">
<div class="col-md-2 col-sm-2">
<img class="img img-responsive img-thumbnail" src="img/camp.jpg" />
    <h5 class="white-text">Camping</h5>
</div>
</a>
<br />

</div>
<div class="row">
<a href="category.php" class="btn btn-lg white black-text btn-default">All Games</a>
</div>
</div>


<!-- Footer -->
<?php include('footer.php'); ?>
<br />
<!-- Footer Close -->

</body>
</html>