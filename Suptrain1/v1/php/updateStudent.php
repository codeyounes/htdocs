<?php
/*
	file: php/updateStudent.php
	desc: Updates student-table if all the fields have values and
		  email is not already in database. Update by the field supervisorID
*/
if(!empty($_POST)){
	//updating  database if ok
	$studentID=$_POST['id'];
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$groupname=$_POST['groupname'];
	// $ID=$_POST['student'];
	$error=false;
	session_start();
	$_SESSION['insNewMsg']='';
	if(empty($firstname) OR empty($lastname) OR empty($phone) OR empty ($studentID) OR empty ($groupname) OR empty($email)){
		$_SESSION['insNewMsg']='<p class="alert alert-info">No empty fields!</p>';
		$error=true;
	}

	//check that email is not already in database table student-table
	include('dbConnect.php');
	if(!$error){
		//update database
		$sql="UPDATE student SET firstname='$firstname',
			lastname='$lastname', email='$email', phone='$phone',groupname='$groupname'
			WHERE studentID='$studentID'";
		if($conn->query($sql)=== TRUE){
			echo "<br>success";
			$_SESSION['insNewMsg']='<p class="alert alert-success">Student updated!</p>';
			header("location:../index.php?page=allstudents");
		}else{
			$_SESSION['insNewMsg']='<p class="alert alert-danger">Was not able to update!</p>';
			header("location:../index.php?page=editStudent&id=$studentID");
		}
	}//else header("location:../index.php?page=editSupervisor&id=$id");
}else header('location:../index.php');
?>
