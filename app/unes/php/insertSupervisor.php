<?php
/*
	file: php/insertSupervisor.php
	desc: Inserts into supervisor-table if all the fields have values and
		  email is not already in database
*/
if(!empty($_POST)){
	//inserting into database if ok
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$oldE
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
		//insert into database
		$sql="INSERT INTO supervisor(firstname,lastname,email,phone)
				VALUES('$firstname','$lastname','$email','$phone')";
		if($conn->query($sql)=== TRUE){
			$_SESSION['insNewMsg']='<p class="alert alert-success">Supervisor added!</p>';
			//get the id of inserted record->can go to edit page
			$id=$conn->insert_id;  //id  of last inserted record
			header("location:../index.php?page=supervisors&id=$id");
		}else{
			$_SESSION['insNewMsg']='<p class="alert alert-danger">Was not able to insert!</p>';
			header('location:../index.php?page=newSupervisor');
		}
	}else header('location:../index.php?page=newSupervisor');
}else header('location:../index.php');
?>



