<?php
$tables = array("category","event","eventmember","interest","media","post","user","blog");
$columns[0] = array("id","category","description","image");
$columns[1] = array("id","parentid","userid","title","image","datetime","location","description");
$columns[2] = array("id","userid","eventid");
$columns[3] = array("id","userid","categoryid");
$columns[4] = array("id","path","type","userid","parentid");
$columns[5] = array("id","userid","text");
$columns[6] = array("id","password","fullname","profession","birthday","image","email","address");
$columns[7] = array("id","message");
?>
