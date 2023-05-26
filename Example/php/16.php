<?php
/*
	file:	ontrainingnow.php
	desc:	List students who are in training at the moment
*/
include('dbConnect.php');
$sql="SELECT student.studentID, student.firstname, student.lastname,
organization.name AS Place,
CONCAT(supervisor.firstname,' ',supervisor.lastname) AS Supervisor,
CONCAT(training.start,' - ',training.end) AS Trainingtime
FROM `student`
INNER JOIN training
ON student.studentID=training.studentID
INNER JOIN organization
ON training.organizationID=organization.organizationID
INNER JOIN supervisor
ON training.supervisorID=supervisor.supervisorID
WHERE student.studentID='A123449'
ORDER BY Trainingtime";
$result=$conn->query($sql);
?>
<h3>Select student & display all PT with
organization name and supervisors name</h3>
<table class="table table-striped">
    <thead>
      <tr>
		<th>Place</th><th>Supervisor</th><th>Trainingtime</th>
    </thead>
    <tbody>
      <?php
	  //list the results of the query as table row <tr> </tr> here
	  while($row=$result->fetch_assoc()){
		  echo '<tr>';
		  echo '<td>'.$row['Place'].'</td>';
      echo '<td>'.$row['Supervisor'].'</td>';
      echo '<td>'.$row['Trainingtime'].'</td>';
		  echo '</tr>';
	  }
	  $conn->close(); //close connection, if not needed in this script anymore
	  ?>
    </tbody>
  </table>
