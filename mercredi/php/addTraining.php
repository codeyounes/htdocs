<?php
/*
	file: php/addTraining.php
	desc: Adds new training for student.
*/
header("Access-Control-Allow-Origin: * ");
session_start();
if(isset($_SESSION['user'])){
	$studentID=$_POST['studentID'];
	$start=$_POST['start'];
	$end=$_POST['end'];
	$place=$_POST['place'];
	$supervisor=$_POST['supervisor'];
	$hours=$_POST['hours'];
	include('dbConnect.php');
	$sql="INSERT INTO training(studentID,start,end,organizationID,supervisorID,supervisorhours)
			values('$studentID','$start','$end',$place,$supervisor,$hours)";
	if($conn->query($sql)===TRUE) echo 'Ok';
	else echo 'Fail'; //this is tested in jQuery part
}echo 'Fail';



