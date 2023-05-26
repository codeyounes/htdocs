<?php
/*
	file:	ontrainingnow.php
	desc:	List students who are in training at the moment
*/
include('dbConnect.php');
$sql="SELECT count(studentID) AS Students_in_training,
organization.name AS Place
FROM `training`
INNER JOIN organization
ON training.organizationID=organization.organizationID
WHERE YEAR(training.start)=YEAR(now())
GROUP BY Place";
$result=$conn->query($sql);
?>
<h3>Students are/were in each training place this year</h3>
<table class="table table-striped">
    <thead>
      <tr>
		<th>Students_in_training</th><th>Place</th>
    </thead>
    <tbody>
      <?php
	  //list the results of the query as table row <tr> </tr> here
	  while($row=$result->fetch_assoc()){
		  echo '<tr>';
		  echo '<td>'.$row['Students_in_training'].'</td>';
      echo '<td>'.$row['Place'].'</td>';
		  echo '</tr>';
	  }
	  $conn->close(); //close connection, if not needed in this script anymore
	  ?>
    </tbody>
  </table>
