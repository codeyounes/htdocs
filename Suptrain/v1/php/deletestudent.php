<?php
/*
	file:	php/delTotalHours.php
	desc:	Removes record in db table supervisorhours by rowid 
			(supervisorhoursID). Returns to correct view by id (supervisorID)
*/
if(isset($_GET['id'])) $studentID=$_GET['id'];else $id='';

include('dbConnect.php');
$sql="DELETE FROM student WHERE studentID='$studentID'";
if($conn->query($sql)===TRUE){
	header("location:index.php?page=allstudents");
}else header('location:index.php?page=error');
?>