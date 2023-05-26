<?php
/*
	file: php/updatetraining.php
	desc: Updates training-table if all the fields have values and
		  email is not already in database. Update by the field trainingID
*/
if(!empty($_POST['id'])){
	//updating  database if ok
	$studentID=$_POST['studentID'];
	$start=$_POST['start'];
	$end=$_POST['end'];
	$supervisorID=$_POST['supervisorID'];
	$organizationID=$_POST['organizationID'];
	$supervisorID=$_POST['supervisorID'];
	$ID=$_POST['id'];
	echo $studentID."...";
	echo $start."...";
	echo $end."...";
	echo $supervisorID."...";
	echo $organizationID."...";
	$error=false;	
	session_start();
	$_SESSION['insNewMsg']='';
	if($studentID==""||$start==""||$end==""||$supervisorID==""||$organizationID==""){
		$_SESSION['insNewMsg']='<p class="alert alert-info">No empty fields!</p>';
		$error=true;
	}
	
	//check that email is not already in database table student-table
	include('dbConnect.php');
	if(!$error){
		//update database
		$sql="UPDATE training SET  
			start='$start', end='$end', supervisorID=$supervisorID ,organizationID=$organizationID,supervisorID=$supervisorID
			WHERE trainingID=$ID";
		if($conn->query($sql)=== TRUE){
			echo "<br> UPDATE training SET , 
			start='$start', end='$end', supervisorID=$supervisorID ,organizationID=$organizationID,supervisorID=$supervisorID
			WHERE trainingID=$ID success";
			$_SESSION['insNewMsg']='<p class="alert alert-success">Training updated!</p>';
			header("location:../index.php?page=edittraining&id=".$ID."&studentID=".$studentID);
		}else{
			$_SESSION['insNewMsg']='<p class="alert alert-danger">Was not able to update!</p>';
			echo $sql;//header("location:../index.php?page=edittraining&id=".$ID."&studentID=".$studentID);
		}
	}//else header("location:../index.php?page=edittraining&id=".$ID."&studentID=".$studentID);
}else header('location:index.php');
?>