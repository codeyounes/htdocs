<?php
/*
	file: php/updateSupervisor.php
	desc: Updates supervisor-table if all the fields have values and
		  email is not already in database. Update by the field supervisorID
*/
if(!empty($_POST)){
	//updating  database if ok
	$id=$_POST['id'];
  $groupname=$_POST['groupname'];
	$studentID=$_POST['studentID'];
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$practicaltrainingdone=$_POST['practicaltrainingdone'];
	$error=false;
	session_start();
	$_SESSION['insNewMsg']='';
	if(empty($groupname) OR empty($firstname) OR empty($lastname) OR empty($phone)){
		$_SESSION['insNewMsg']='<p class="alert alert-info">No empty fields!</p>';
		$error=true;
	}
	include('checkEmail.inc');
	if(!validEmail($email)){
		$_SESSION['insNewMsg']='<p class="alert alert-danger">Check email field!</p>';
		$error=true;
	}
	//check that email is not already in database table supervisor-table
	include('dbConnect.php');
	$sql="SELECT email FROM student WHERE email='$email'";
	$result=$conn->query($sql);
	if($result->num_rows > 0){
		//email already in dbConnect
		$_SESSION['insNewMsg']='<p class="alert alert-danger">Email is already in db!</p>';
		$error=true;
	}
	if(!$error){
		//update database
		$sql="UPDATE student SET studentID='$studentID', groupname='$groupname', firstname='$firstname',lastname='$lastname', email='$email', phone='$phone', practicaltrainingdone='$practicaltrainingdone'
			WHERE studentID=$id";
		if($conn->query($sql)=== TRUE){
			$_SESSION['insNewMsg']='<p class="alert alert-success">student updated!</p>';
			header("location:../index.php?page=editstudent&id=$id");
		}else{
			$_SESSION['insNewMsg']='<p class="alert alert-danger">Was not able to update!</p>';
			header("location:../index.php?page=editstudent&id=$id");
		}
	}else header("location:../index.php?page=editstudent&id=$id");
}else header('location:../index.php');
?>
