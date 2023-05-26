<?php
/*
	file:	NrInTraining.php
	desc:	Displays the nr of students doing their training at the moment
*/
include('dbConnect.php');
$sql="SELECT count(studentID) AS Students_in_training
	  FROM `training`
	  WHERE now() BETWEEN start AND end";
$result=$conn->query($sql);
?>
<div class="alert alert-success">
  <?php
	if($row=$result->fetch_assoc()){
		echo '<b><a href="index.php?page=ontraining">'.$row['Students_in_training'].'</b>';
		echo ' students in training at the moment!</a>';
	}
	$conn->close();
  ?>
</div>