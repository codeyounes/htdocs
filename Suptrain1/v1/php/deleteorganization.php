<?php
/*
	file:	php/delTotalHours.php
	desc:	Removes record in db table organizations by rowid
			(supervisorhoursID). Returns to correct view by id (supervisorID)
*/
if(isset($_GET['id'])) $id=$_GET['id']; else $id='';
include('dbConnect.php');
$sql="DELETE FROM organization WHERE organizationID='$id'";
if($conn->query($sql)===TRUE){
header("location:../index.php?page=organisations");
}else header('location:../index.php?page=organisations');
?>
