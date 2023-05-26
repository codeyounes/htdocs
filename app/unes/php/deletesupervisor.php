<?php
/*
	file:	php/delTotalHours.php
	desc:	Removes record in db table supervisorhours by rowid 
			(supervisorhoursID). Returns to correct view by id (supervisorID)
*/
if(isset($_GET['id'])) $supervisorID=$_GET['id'];else $id='';

include('dbConnect.php');
$sql="DELETE FROM supervisor WHERE supervisorID='$supervisorID'";
if($conn->query($sql)===TRUE){
	header("location:index.php?page=supervisors");
}else header('location:index.php?page=error');
?>