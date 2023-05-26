<?php
/*
	file: php/removeimage.php
	desc: Removes profile imagefile and updates table
*/
if(isset($_GET['id'])) $id=$_GET['id'];
include('dbConnect.php');
$sql="SELECT image FROM student WHERE studentID=$id";
$result=$conn->query($sql);
if($row=$result->fetch_assoc()) $image=$row['image'];
$sql="UPDATE student SET image='' WHERE studentID=$id";
if($conn->query($sql)===TRUE){
	session_start();
	$target_dir="../images/supervisors/";
	unlink($target_dir.$image); //removes the imagefile
	$_SESSION['insNewMsg']='<p class="alert alert-success">Image removed!</p>';
	header("location:../index.php?page=editstudent&id=$id");
}else{
	$_SESSION['insNewMsg']='<p class="alert alert-alert">Failed!</p>';
	header("location:../index.php?page=editstudent&id=$id");
}
?>
