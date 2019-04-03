<?php

// Create connection
$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  
  $con=mysqli_connect(DB_HOST,DB_USER,DB_PASS);
  
  $sql="CREATE DATABASE IF NOT EXISTS ".DB_NAME.";";

  if(!mysqli_query($con,$sql))
    {
		echo(
  "Install the database and check the connection."." <br>"
  ."If you're running XAMPP or use a CPANEL, then"." <br>"
  ." open the PHPmyAdmin and import the SQL file"." <br>"
  ." that is included in the folder."." <br>"
  ."In any other environment try,"." <br>"
  ." search,ask to execute the SQL query in the used technology."." <br>"
  );
		die('Error : ' . mysqli_error());
		
  }
  else{mysqli_select_db(databasename);}
  //else{echo "Successfully checked table connection."." <br>";
  }
?>