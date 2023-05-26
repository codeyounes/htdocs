<?php
/*
	file:	php/delTotalHours.php
	desc:	Removes record in db table training by rowid 
			(trainingID). Returns to correct view by id (trainingIDID)
*/
if(isset($_GET['id'])) $studentID=$_GET['id'];else $id='';

include('dbConnect.php');
$sql="DELETE FROM training WHERE studentID='$studentID'";
if($conn->query($sql)===TRUE){
	header("location:index.php?page=ontraining");
}else header('location:index.php?page=error');
echo $sql;
?>