<?php
/*
	file: php/updateSupervisor.php
	desc: Updates supervisor-table if all the fields have values and
		  email is not already in database. Update by the field supervisorID
*/
if(!empty($_POST)){
	//updating  database if ok
	$id=$_POST['id'];

	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$practicaltrainingdone=$_POST['practicaltrainingdone'];
	$groupname=$_POST['groupname'];
	$error=false;
	session_start();
	$_SESSION['insNewMsg']='';
	if(empty($firstname) OR empty($lastname) OR empty($phone)){
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

	if(!$error){
		//update database
		$sql="UPDATE student SET firstname='$firstname',
			lastname='$lastname', email='$email', phone='$phone',practicaltrainingdone='$practicaltrainingdone',groupname='$groupname'
			WHERE studentID='$id'";
		if($conn->query($sql)=== TRUE){
			$_SESSION['insNewMsg']='<p class="alert alert-success">Student updated!</p>';
			header("location:../index.php?page=1editstudent&id=$id");
		}else{
			$_SESSION['insNewMsg']='<p class="alert alert-danger">Was not able to update!</p>';
			header("location:../index.php?page=1editstudent&id=$id");
		}
	}else header("location:../index.php?page=1editstudent&id=$id");
}else header('location:../index.php');
?>
