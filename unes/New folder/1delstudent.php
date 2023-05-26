
<?php
if(isset($_GET['id'])) $id=$_GET['id'];else $id='';
include('dbConnect.php');
$sql="DELETE FROM student WHERE studentID='$id'";
if($conn->query($sql)===TRUE){
	echo "Deleted student";
	header("location:../index.php?page=query1_2_11");
}else header('location:../index.php?page=error');
$conn->close();
?>
