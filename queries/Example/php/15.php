<?php
/*
	file:	ontrainingnow.php
	desc:	List students who are in training at the moment
*/
include('dbConnect.php');
$sql="SELECT CONCAT(supervisor.firstname,'',supervisor.lastname) AS Supervisor,supervisorhours.hours, supervisorhours.year,
supervisor.supervisorID
FROM supervisor
INNER JOIN supervisorhours
ON supervisorhours.supervisorID=supervisor.supervisorID
WHERE YEAR(now())=supervisorhours.year
AND supervisor.supervisorID NOT IN(
SELECT training.supervisorID FROM training
    WHERE YEAR(now())=YEAR(training.start)) ";
$result=$conn->query($sql);
?>
<h3>Supervisors who have resources for this year & not assigned
to any training </h3>
<table class="table table-striped">
    <thead>
      <tr>
		<th>Supervisor</th><th>hours</th><th>year</th><th>supervisorID</th>
    </thead>
    <tbody>
      <?php
	  //list the results of the query as table row <tr> </tr> here
	  while($row=$result->fetch_assoc()){
		  echo '<tr>';
		  echo '<td>'.$row['Supervisor'].'</td>';
      echo '<td>'.$row['hours'].'</td>';
      echo '<td>'.$row['year'].'</td>';
      echo '<td>'.$row['supervisorID'].'</td>';
		  echo '</tr>';
	  }
	  $conn->close(); //close connection, if not needed in this script anymore
	  ?>
    </tbody>
  </table>
