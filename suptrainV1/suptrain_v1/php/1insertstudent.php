<?php
/*
	file: php/1insertstudent.php
*/
if(!empty($_POST)){
	//inserting into database if ok
$studentID=$_POST['studentID'];
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$practicaltrainingdone=$_POST['practicaltrainingdone'];
	$groupname=$_POST['groupname'];
	$error=false;
	session_start();
	$_SESSION['insNewMsg']='';
	if(empty($firstname) or empty($studentID) OR empty($lastname) OR empty($groupname) OR empty($phone)){
		$_SESSION['insNewMsg']='<p class="alert alert-info">No empty fields!</p>';
		$error=true;
	}
	include('checkEmail.inc');
	if(!validEmail($email)){
		$_SESSION['insNewMsg']='<p class="alert alert-danger">Check email field!</p>';
		$error=true;
	}
	//check that email is not already in database table student-table
	include('dbConnect.php');
	$sql="SELECT email FROM student WHERE email='$email'";
	$result=$conn->query($sql);
	if($result->num_rows > 0){
		//email already in dbConnect
		$_SESSION['insNewMsg']='<p class="alert alert-danger">Email is already in db!</p>';
		$error=true;
	}
	if(!$error){
		//insert into database
		$sql="INSERT INTO student(studentID,firstname,lastname,email,phone,practicaltrainingdone,groupname)
				VALUES('$studentID','$firstname','$lastname','$email','$phone','$practicaltrainingdone','$groupname')";
		if($conn->query($sql)=== TRUE){
			$_SESSION['insNewMsg']='<p class="alert alert-success">Supervisor added!</p>';
			//get the id of inserted record->can go to edit page
			$id=$conn->insert_id;  //id  of last inserted record
			header("location:../index.php?page=1editstudent&id=$id");
		}else{
			$_SESSION['insNewMsg']='<p class="alert alert-danger">Was not able to insert!</p>';
			header('location:../index.php?page=1newstudent');
		}
	}else header('location:../index.php?page=1newstudent');
}else header('location:../index.php');
?>