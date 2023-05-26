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
	$sql="SELECT email FROM supervisor WHERE email='$email'";
	$result=$conn->query($sql);
	if($result->num_rows > 0){
		//email already in dbConnect
		$_SESSION['insNewMsg']='<p class="alert alert-danger">Email is already in db!</p>';
		$error=true;
	}
	if(!$error){
		//update database
		$sql="UPDATE supervisor SET firstname='$firstname', 
			lastname='$lastname', email='$email', phone='$phone'
			WHERE supervisorID=$id";
		if($conn->query($sql)=== TRUE){
			$_SESSION['insNewMsg']='<p class="alert alert-success">Supervisor updated!</p>';
			header("location:../index.php?page=editSupervisor&id=$id");
		}else{
			$_SESSION['insNewMsg']='<p class="alert alert-danger">Was not able to update!</p>';
			header("location:../index.php?page=editSupervisor&id=$id");
		}
	}else header("location:../index.php?page=editSupervisor&id=$id");
}else header('location:../index.php');
?>