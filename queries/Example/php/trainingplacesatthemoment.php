<?php
/*
	file:	ontrainingnow.php
	desc:	List students who are in training at the moment
*/
include('dbConnect.php');
$sql="SELECT organization.name AS Place,
CONCAT(student.firstname,' ',student.lastname) AS Student,
training.start AS Started, training.end AS Training_ends
FROM `organization`
INNER JOIN training
ON organization.organizationID=training.organizationID
INNER JOIN student
ON training.studentID=student.studentID
WHERE now() BETWEEN training.start AND training.end
ORDER BY Place, Student, Started";
$result=$conn->query($sql);
?>
<h3>Training places at the moment</h3>
<table class="table table-striped">
    <thead>
      <tr>
		<th>Place</th><th>Student</th><th>Started</th><th>Training_ends</th>
      </tr>
    </thead>
    <tbody>
      <?php
	  //list the results of the query as table row <tr> </tr> here
	  while($row=$result->fetch_assoc()){
		  echo '<tr>';
		  echo '<td>'.$row['Place'].'</td>';
		  echo '<td>'.$row['Student'].'</td>';
		  echo '<td>'.$row['Started'].'</td>';
      echo '<td>'.$row['Training_ends'].'</td>';
		  echo '</tr>';
	  }
	  $conn->close(); //close connection, if not needed in this script anymore
	  ?>
    </tbody>
  </table>
