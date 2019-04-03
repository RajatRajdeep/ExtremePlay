<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
<?php include('header.php'); ?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
</style>
</head>

<body class="" style="background:#ccc;">

<?php include('navbar.php'); ?>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
	  <?php
	  $sql = "SELECT * FROM `user` WHERE id=".$_REQUEST['id']."; ";
	  $result=mysqli_query($con,$sql);
	  if($result->num_rows>0){
		  $row= mysqli_fetch_array($result);
	  ?>
      <div class="w3-card w3-round w3-white text-center">
        <div class="w3-container">
		<br />
         <p class="w3-center"><?php if(strlen($row['image'])>0)echo("<img src='".$row['image']."' class='w3-circle' style='height:106px;width:106px' alt='Avatar'>"); else {echo('<i class="fa fa-user fa-3x"></i>');} ?> </p>
         <h4 class="w3-center"><?php echo($row['fullname']); ?></h4>
         <p> <?php if(strlen($row['address'])>0)echo('<i class="fa fa-home fa-fw"></i> '.$row['address']); ?></p>
		 <p> <?php if(strlen($row['profession'])>0)echo('<i class="fa fa-pencil fa-fw"></i> '.$row['profession']); ?></p>
		 <p> <?php if(strlen($row['birthday'])>0)echo('<i class="fa fa-birthday-cake fa-fw"></i> '.$row['birthday']); ?></p>
		 
		 <?php
	if($_SESSION['loginid']==$_REQUEST['id']){
	?><a class="btn btn-primary blue" href="editprofile.php?id=<?php echo($_SESSION['loginid']); ?>">Edit</a><br /><br /><?php } ?>
        </div>
      </div>
      <br>
            
      <!-- Interests --> 
      <div class="w3-card w3-round w3-white w3-hide-small">
        <div class="w3-container">
          <p>Interests</p>
		  
		  <?php
		$sql = "SELECT * FROM `interest` WHERE userid= ".$_REQUEST['id'].";";
	  $result=mysqli_query($con,$sql);
	  if($result->num_rows > 0){
		  while($row=mysqli_fetch_array($result)){
		$sql2="SELECT * FROM `category` WHERE id = ".$row['categoryid'].";";
	$result2 =mysqli_query($con,$sql2);
	$row2 = mysqli_fetch_array($result2);
	  echo('<a href="item.php?id='.$row2["id"].'" class=""><div class="padding10 margin10 grey curve lighten-2"><i class="fa fa-globe"></i> '.$row2["category"].'</div></a><br />');
			  }
	  }
		?>
        </div>
      </div>
    
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
    <?php
	if($_SESSION['loginid']==$_REQUEST['id']){
	?>
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding text-center">
			<form method="post" enctype="multipart/form-data">
              <h6 class="w3-opacity">Post your stuff</h6>
              <textarea name="addpost" style="height:auto !important;" rows="1" class="w3-border w3-padding"></textarea>
			  
<div class="container-fluid">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<input class="btn btn-default w3-theme form-control" name="fileToUpload[]" id="fileToUpload" type="file" multiple />
 </div>
 </div>
 </div>
              <button type="submit" class="w3-button w3-theme"><i class="fa fa-pencil"></i>  Post</button> 

			 </form>
            </div>
          </div>
        </div>
      </div>
	  <?php
	  }
      ?>
	  <?php
	  if(isset($_REQUEST['addpost'])){
		  $sql="INSERT INTO `post` (userid,text) VALUES(".$_SESSION['loginid'].",'".$_REQUEST['addpost']."');";
		  mysqli_query($con,$sql);
		  $sql="SELECT * FROM `post` WHERE userid=".$_SESSION['loginid']." AND text='".$_REQUEST['addpost']."' ;";
		  $result=mysqli_query($con,$sql);
		  $row=mysqli_fetch_array($result);
	
	$total = count($_FILES['fileToUpload']['name']);
	for($i=0; $i<$total; $i++) {
		if ($_FILES["fileToUpload"]["tmp_name"][$i] != ""){
	$image = "images/".time() . '.' . end(explode(".",$_FILES["fileToUpload"]["name"][$i]));
	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $image);
	$sql="INSERT INTO `media` (path,userid,type,parentid) VALUES('".$image."',".$_SESSION['loginid'].",'profile',".$row['id'].");";
	mysqli_query($con,$sql);
	}
	}
		  
		  }
	   echo('<div class="w3-container w3-card w3-white w3-round w3-margin">');
	  $sql = "SELECT * FROM `post` WHERE userid= ".$_REQUEST['id'].";";
	  $result=mysqli_query($con,$sql);
	  if($result->num_rows > 0){
		  while($row=mysqli_fetch_array($result)){
	  echo('
     <br>
        
        <p>'.$row['text'].'</p>
    ');
	 $sql2 = "SELECT * FROM `media` WHERE userid= ".$_SESSION['loginid']." AND type='profile' AND parentid= ".$row['id'].";";
	  $result2=mysqli_query($con,$sql2);
	  if($result2->num_rows > 0){
		  while($row2=mysqli_fetch_array($result2)){
			  echo('<img src="'.$row2['path'].'" class="img img-responsive" /><br />');
	  }}
	 
	  }
	  }
	  else{echo('<br />No Posts to Show.<br /><br />');}
	  echo('
      </div>
	  ');
     ?> 
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
		<p>Joined Events:</p>
		<?php
		$sql = "SELECT * FROM `eventmember` WHERE userid= ".$_REQUEST['id'].";";
	  $result=mysqli_query($con,$sql);
	  if($result->num_rows > 0){
		  while($row=mysqli_fetch_array($result)){
		$sql2 = "SELECT * FROM `event` WHERE id= ".$row['eventid'].";";
	  $result2=mysqli_query($con,$sql2);
	  $row2=mysqli_fetch_array($result2);
	  echo('<a href="event.php?id='.$row2["id"].'" class=""><div class="padding10 margin10 grey curve lighten-2"><i class="fa fa-globe"></i> '.$row2["title"].'</div></a><br />');
			  }
	  }
		?>
        </div>
      </div>
      
    <!-- End Right Column -->
    </div>
    <?php
	  }
	?>
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

<!-- Footer -->
<?php include('footer.php'); ?>
 
<script>
// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else { 
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
</html> 
