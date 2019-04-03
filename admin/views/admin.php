<!DOCTYPE html>
<html lang="en">
<?php include('_header.php'); ?>
<?php include('database.php'); ?>
<?php include('config/tables.php'); ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.tablesorter.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/holder.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

	<link href="lib/css/font-awesome.min.css" rel='stylesheet' type='text/css' />
	
	<link href="lib/iconpicker/css/fontawesome-iconpicker.min.css" rel="stylesheet">
	<script src="lib/iconpicker/js/fontawesome-iconpicker.min.js"></script>

	<style>
            footer{
                font-style: italic;
                background:#f7f7f7;
                padding:60px;
                text-align: center;
                margin-top: 60px;
            }
            pre{
                text-align: left;
            }
			.clickable{
			cursor: pointer; cursor: hand;
			}
            .form-control, .form-group{
                position: relative;
            }
            p.lead{
                max-width: 600px;
                margin:0 auto 20px auto;
            }
            div.lead{
                margin:30px 0;
            }
            a.action-placement{
                margin:0 4px 4px 4px;
                display:inline-block;
                /*border-bottom: 1px dotted #428BCA;*/
                text-decoration: none;
            }
            a.action-placement.active{
                color:#5CB85C;
            }
            .form-group{
                text-align: left;
                margin-bottom: 30px;
            }
            .form-group label{
                display:block;
                margin-bottom: 15px;
            }
            .lead iframe{
                display:inline-block;
                vertical-align: middle;
            }
        </style>
	
<link rel="stylesheet" href="css/jquery-ui.min.css" />	
<link rel="stylesheet" href="css/jquery-ui.theme.min.css" />
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: ".textedit",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
<script>
            $(function() {
                    //$('.icp-auto').iconpicker();
                    $('.icp-dd').each(function() {
                        var $this = $(this);
                        $this.iconpicker({
                            container: $(' ~ .dropdown-menu:first', $this),
                        placement: 'inline',
						input: 'input,.iconpicker-input'
                        });
                    }).data('iconpicker');
                                    
                // Events sample:
                // This event is only triggered when the actual input value is changed
                // by user interaction
                $('.icp').on('iconpickerSelected', function(e) {
                    $('.picker-target').get(0).className = 'picker-target ' +
                            e.iconpickerInstance.options.iconBaseClass + ' ' +
                            e.iconpickerInstance.getValue(e.iconpickerValue);
                });
            });
        </script>
		<script>
		
		</script>
<?php

if(isset($_REQUEST['table'])){$i=$_REQUEST['table'];}

// Get primary Keys
for($k=0;$k<count($tables);$k++){
$sql = "SHOW KEYS FROM `".$tables[$k]."` WHERE Key_name = 'PRIMARY'";

$result = $con->query($sql);
if ($result->num_rows > 0){
$row = $result->fetch_assoc();
$primary[$k]=$row['Column_name'];
}
else{$primary[$k]="id";}
}

// Handle insert command
if(isset($_REQUEST['insert']))
{
$types="";
$sql = "INSERT INTO ".$tables[$i]." ( ";
			for($j=0;$j<count($columns[$i]);$j++)
			{	if($columns[$i][$j]!=$primary[$i]){
			$sql .= addslashes($columns[$i][$j]).",";
			$types.="s";}
			}
			$sql=rtrim($sql,",");
			$sql.=" ) VALUES ( ";
			$refArr = array($types);//add types to ref
			for($j=0;$j<count($columns[$i]);$j++)
			{	if($columns[$i][$j]!=$primary[$i]){
			$sql .= "?,";
			//array_push($refArr,$_REQUEST[$j]);
			array_splice($refArr, count($refArr), 0, array(&$_REQUEST[$j]));
			}
			}
			$sql=rtrim($sql,",");
			$sql.=" );";
$stmt = $con->prepare($sql);
/*for($j=0;$j<count($columns[$i]);$j++)
			{	if($columns[$i][$j]!="id"){
			//$stmt->bind_param($j, $res="New");
			}}*/
//var_dump($refArr);
$ref    = new ReflectionClass('mysqli_stmt');
$method = $ref->getMethod("bind_param");
$method->invokeArgs($stmt,$refArr);
$stmt->execute();  

//$stmt->close();
//$con->close();
}

// Handle update command
if(isset($_REQUEST['update']))
{
$sql = "UPDATE ".$tables[$i]." SET ";
for($j=0;$j<count($columns[$i]);$j++)
{if($columns[$i][$j]!=$primary[$i]){
$sql .= $columns[$i][$j]."='".addslashes($_REQUEST[$j])."',";
}}
$sql=rtrim($sql,",");
$sql.=" WHERE ".$primary[$i]." = ".$_REQUEST['row'];
$con->query($sql);
}

// Handle delete command
if(isset($_REQUEST['delete']))
{$sql = "DELETE FROM `".$tables[$i]."` WHERE `".$primary[$i]."` = ".$_REQUEST['row'];
$con->query($sql);}

// Handle image upload command
if(isset($_REQUEST["imageupload"])) {?>
						<?php
$target_dir = "../images/";
if(isset($_REQUEST['folderpath']))$target_dir = $_REQUEST['folderpath'];

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Allow certain file formats
$imageFileType=strtolower($imageFileType);

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
}

// Handle image delete command
if(isset($_REQUEST["imagedelete"])) {
unlink($_REQUEST["imagedelete"]);
}
?>
						
  <body>
    <?php include('menu.php');?>
	<?php //include('sidebar.php');?>
	
	<?php
	
	// Show add data form
	if(isset($_REQUEST['add']))
	{
		?>
		<div class="col-md-12 main">
          <h1 class="page-header">Add to <?=$tables[$i]?></h1>
			<form action="" method="post" role="form">
			<?php
			for($j=0;$j<count($columns[$i]);$j++)
			{	if($columns[$i][$j]!=$primary[$i]){
			?>
				  <div class="form-group">
					<label for="<?=$columns[$i][$j]?>"><?=$columns[$i][$j]?></label>
					
<?php
$sql = "SELECT DATA_TYPE 
FROM INFORMATION_SCHEMA.COLUMNS
WHERE 
     TABLE_NAME = '".$tables[$i]."' AND 
     COLUMN_NAME = '".$columns[$i][$j]."'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
if($row['DATA_TYPE']=="datetime"){echo("<input type='text' class='form-control datetime' id='".$columns[$i][$j]."' name='".$j."' />");}
else if($columns[$i][$j]=="message")echo('<textarea class="textedit" id="'.$columns[$i][$j].'" name="'.$j.'" style="width:100%"></textarea>');
else if($columns[$i][$j]=="icon")echo('<div class="input-group"><input id="'.$columns[$i][$j].'" name='.$j.' data-placement="bottomLeftCorner" class="form-control icp icp-dd" value="'.$olddata[$columns[$i][$j]].'" type="text" /><span class="input-group-addon"></span></div>');
else{echo('<input type="text" class="form-control" id="'.$columns[$i][$j].'" name='.$j.'>');}
}
echo("</div>");
				}
			}
			?>
  <script>
  $(function() {
	$( ".datetime" ).datepicker();
    $( ".datetime" ).datepicker("option", "dateFormat","yy-mm-dd 00:00:00");
  });
  </script>
			<input type="hidden" name="table" value="<?=$i?>">
			<button name="insert" type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
		<?php
	}
	
	// Show uploadFile
	else if(isset($_REQUEST['image']))
	{
	echo('<div class="col-md-12 main">
<h1 class="page-header">Files</h1>
<form action="" class="form form-inline text-center" role="form" method="post" enctype="multipart/form-data">
					<div class="form-group">
							<label for="image">Upload New File -</label>
					Path: <input class="form-control" type="text" name="folderpath" placeholder="folder path for upload" value="../images/" />
					<br /><br />
					File: <input class="btn btn-default form-control" type="file" name="fileToUpload" id="fileToUpload" />
					<br /><br />
					<input class="btn btn-primary form-control" type="submit" value="Upload" name="imageupload" />
				</div>
				</form>
');

echo('<h1>Server</h1>');
$dataarray = ['../images/','../files/','../data/','../profileimages/','../forumimages/'];
echo("<h5>Files in - images, files, data, profileimages, forumimages</h5>");
foreach($dataarray as $datadir)
{
$boxes = glob($datadir . '*', GLOB_BRACE);
foreach($boxes as $box){
echo('
<form action="" method="post">
<a target="_blank" href="'.$box.'"><b>'.$box.'</b></a>
<button name="imagedelete" type="submit" class="btn btn-sm btn-danger" value="'.$box.'">Delete</button>
</form>
<br />
');
}
}

	}
	
	// Show edit data form
	else if(isset($_REQUEST['edit']))
	{
		?>
		<div class="col-md-12 main">
          <h1 class="page-header">Edit to <?=$tables[$i]?></h1>
			<form action="" method="post" role="form">
			<?php
$sql = "SELECT * FROM ".$tables[$i]." where ".$primary[$i]."=".$_REQUEST['row']." ";
$olddata = $con->query($sql);
$olddata = $olddata->fetch_assoc();
			for($j=0;$j<count($columns[$i]);$j++)
			{	if($columns[$i][$j]!=$primary[$i]){
			?>
				  <div class="form-group">
					<label for="<?=$columns[$i][$j]?>"><?=$columns[$i][$j]?></label>
					
<?php
$sql = "SELECT DATA_TYPE 
FROM INFORMATION_SCHEMA.COLUMNS
WHERE 
     TABLE_NAME = '".$tables[$i]."' AND 
     COLUMN_NAME = '".$columns[$i][$j]."'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
if($row['DATA_TYPE']=="datetime"){echo("<input type='text' class='form-control datetime' id='".$columns[$i][$j]."' name='".$j."' value='".$olddata[$columns[$i][$j]]."' />");}

else if($columns[$i][$j]=="message")echo('<textarea class="textedit" id="'.$columns[$i][$j].'" name="'.$j.'" style="width:100%">'.$olddata[$columns[$i][$j]].'</textarea>');

else if($columns[$i][$j]=="icon")echo('<div class="input-group"><input id="'.$columns[$i][$j].'" name='.$j.' data-placement="bottomLeftCorner" class="form-control icp icp-dd" value="'.$olddata[$columns[$i][$j]].'" type="text" /><span class="input-group-addon"></span></div>');
								
else{echo('<input type="text" class="form-control" id="'.$columns[$i][$j].'" name='.$j.' value="'.$olddata[$columns[$i][$j]].'">');}

}
echo("</div>");
				}
			}
			?>
  <script>
  $(function() {
	$( ".datetime" ).datepicker();
    $( ".datetime" ).datepicker("option", "dateFormat","yy-mm-dd 00:00:00");
});
  </script>
  
			<input type="hidden" name="table" value="<?=$i?>">
			<input type="hidden" name="row" value="<?=$_REQUEST['row']?>">
			<button name="update" type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
		<?php
	}
	
		else
		{
			?>
        <div class="col-md-12 main">
          <h1 class="page-header">Dashboard</h1>
<script>
 $(function() {
$("table").tablesorter();
});
</script>
<?php
// For each table show data
for($i=0;$i<count($tables);$i++)
{
echo('<a class="btn btn-default" href="#'.$tables[$i].'">'.$tables[$i].'</a> ');
}

// For each table show data
for($i=0;$i<count($tables);$i++)
{
echo('<a name="'.$tables[$i].'"><h2 class="sub-header">'.$tables[$i].'</h2></a>');
echo('<form action="" method="post">');
echo('<input type="hidden" name="table" value="'.$i.'">');
echo('<button type="submit" name="add" class="btn btn-success">Add New</button>');
echo('</form>');
echo('<div class="table-responsive">');
echo('<table class="table table-striped tablesorter">');
echo('<thead>');
echo('<tr>');

// All columns names as the table header
for($j=0;$j<count($columns[$i]);$j++)
{if($columns[$i][$j]!=$primary[$i])echo("<th class='clickable'>".$columns[$i][$j]."</th>");}
echo('</tr>');
echo('</thead>');
echo('<tbody>');
$sql = "SELECT * FROM ".$tables[$i];
$result = $con->query($sql);

if ($result->num_rows > 0) {
	
	$row_count=0;
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo('<tr>');
		
		// Loop to show all columns
		for($j=0;$j<count($columns[$i]);$j++){
        if($columns[$i][$j]!=$primary[$i]){
		if($columns[$i][$j]=="icon"){echo "<td><i class='fa " .$row[$columns[$i][$j]]. "'></i></td>";}
		else {echo "<td>" . $row[$columns[$i][$j]]. "</td>";}
		}
		}
		
		echo('<td>');
		//Edit button
		echo('<form action="" method="post">');
		echo('<input type="hidden" name="table" value="'.$i.'">');
		echo('<input type="hidden" name="row" value="'.$row[$primary[$i]].'">');$row_count++;
		echo('<button type="submit" name="edit" class="btn btn-info">Edit</button>');
		echo('</form>');
		echo('</td>');
		
		echo('<td>');
		//Delete button
		echo('<form action="" method="post">');
		echo('<input type="hidden" name="table" value="'.$i.'">');
		echo('<input type="hidden" name="row" value="'.$row[$primary[$i]].'">');$row_count++;
		echo('<button type="submit" name="delete" class="btn btn-danger">Delete</button>');
		echo('</form>');
		echo('</td>');
		
		echo('</tr>');
    }
} else {
    echo "0 data";
}
echo('</tbody>');
echo('</table>');
echo('</div>');
}
?>
        </div>

<?php } ?>
	<?php include('_footer.php'); ?>
</body></html>
