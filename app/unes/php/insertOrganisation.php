<?php
/*
	file: php/insert organisation.php
	desc: Inserts into organisation-table if all the fields have values and
		  email is not already in database
*/
if(!empty($_POST)){
	//inserting into database if ok
	$name=$_POST['name'];
	$address=$_POST['address'];
	$contactperson=$_POST['contactperson'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$error=false;	
	session_start();
	$_SESSION['insNewMsg']='';
	if(empty($name) OR empty($contactperson) OR empty ($phone)) {
		$_SESSION['insNewMsg']='<p class="alert alert-info">No empty fields!</p>';
		$error=true;
	}
	include('checkEmail.inc');
	if(!validEmail($email)){
		$_SESSION['insNewMsg']='<p class="alert alert-danger">Check email field!</p>';
		$error=true;
	}
	//check that email is not already in database table organisation-table
	include('dbConnect.php');
	$sql="SELECT email FROM organization WHERE email='$email'";
	$result=$conn->query($sql);
	if($result->num_rows > 0){
		//email already in dbConnect
		$_SESSION['insNewMsg']='<p class="alert alert-danger">Email is already in db!</p>';
		$error=true;
	}
	if(!$error){
		//insert into database
		$sql="INSERT INTO organization(name,address,contactperson,email,phone)
				VALUES('$name','$address','$contactperson','$email','$phone')";
		if($conn->query($sql)=== TRUE){
			$_SESSION['insNewMsg']='<p class="alert alert-success">Organisation added!</p>';
			//get the id of inserted record->can go to edit page
			$id=$conn->insert_id;  //id  of last inserted record
			header("location:../index.php?page=editOrganisation&id=$id");
		}else{
			$_SESSION['insNewMsg']='<p class="alert alert-danger">Was not able to insert!</p>';
			header('location:../index.php?page=newOrganisation');
		}
	}else header('location:../index.php?page=newOrganisation');
}else header('location:../index.php');
?>



