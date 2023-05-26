<?php
/*
	file: php/updateOrganization.php
	desc: Updates organization-table if all the fields have values and
		  email is not already in database. Update by the field supervisorID
*/
if(!empty($_POST)){
	//updating  database if ok
	$id=$_POST['id'];
	$name=$_POST['name'];
	$address=$_POST['address'];
	$contactperson=$_POST['contactperson'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$oldE=$_POST['oldE'];
    $NE=$_POST['NE'];
	$error=false;	
	session_start();
	$_SESSION['insNewMsg']='';
	if(empty($name) OR empty($address) OR empty($phone)){
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
	if (oldE==NE){
	$sql="SELECT email FROM organization WHERE email='$email'";
	$result=$conn->query($sql);
	if($result->num_rows > 0){
		//email already in dbConnect
		$_SESSION['insNewMsg']='<p class="alert alert-danger">Email is already in db!</p>';
		$error=true;
	}
	}
	if(!$error){
		//update database
		$sql="UPDATE organization SET name='$name', 
			address='$address', contactperson='$contactperson', email='$email',phone='$phone'
			WHERE organizationID=$id";
		if($conn->query($sql)=== TRUE){
			$_SESSION['insNewMsg']='<p class="alert alert-success">Organization updated!</p>';
			header("location:../index.php?page=organisations");
		}else{
			$_SESSION['insNewMsg']='<p class="alert alert-danger">Was not able to update!</p>';
			header("location:../index.php?page=editOrganization&id=$id");
		}
	}else header("location:../index.php?page=editOrganization&id=$id");
}else header('location:../index.php');
?>