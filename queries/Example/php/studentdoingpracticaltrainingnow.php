<?php
/*
	file:	ontrainingnow.php
	desc:	List students who are in training at the moment
*/
include('dbConnect.php');
$sql="SELECT count(studentID) AS Students_in_training
FROM `training`
WHERE now() BETWEEN start AND end";
$result=$conn->query($sql);
?>
<h3>Students are doing practical training Now</h3>
<table class="table table-striped">
    <thead>
      <tr>
		<th>Students_in_training</th>
    </thead>
    <tbody>
      <?php
	  //list the results of the query as table row <tr> </tr> here
	  while($row=$result->fetch_assoc()){
		  echo '<tr>';
		  echo '<td>'.$row['Students_in_training'].'</td>';
		  echo '</tr>';
	  }
	  $conn->close(); //close connection, if not needed in this script anymore
	  ?>
    </tbody>
  </table>
