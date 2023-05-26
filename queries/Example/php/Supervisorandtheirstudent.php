<?php
/*
	file:	ontrainingnow.php
	desc:	List students who are in training at the moment
*/
include('dbConnect.php');
$sql="SELECT CONCAT(
supervisor.firstname,' ',supervisor.lastname) AS
Teacher, CONCAT(student.firstname,' ',student.lastname) AS Student,
training.start, training.end, training.supervisorhours AS Hours
FROM supervisor
INNER JOIN training
ON supervisor.supervisorID=training.supervisorID
INNER JOIN student
ON training.studentID=student.studentID
WHERE YEAR(now())=YEAR(start)
ORDER BY Teacher, training.start";
$result=$conn->query($sql);
?>
<h3>Students this year</h3>
<table class="table table-striped">
    <thead>
      <tr>
		<th>Teacher</th><th>Student</th><th>Hours</th>
      </tr>
    </thead>
    <tbody>
      <?php
	  //list the results of the query as table row <tr> </tr> here
	  while($row=$result->fetch_assoc()){
		  echo '<tr>';
		  echo '<td>'.$row['Teacher'].'</td>';
		  echo '<td>'.$row['Student'].'</td>';
		  echo '<td>'.$row['Hours'].'</td>';
		  echo '</tr>';
	  }
	  $conn->close(); //close connection, if not needed in this script anymore
	  ?>
    </tbody>
  </table>
