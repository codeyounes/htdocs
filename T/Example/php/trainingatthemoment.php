<?php
/*
	file:	ontrainingnow.php
	desc:	List students who are in training at the moment
*/
include('dbConnect.php');
$sql="SELECT student.firstname, student.lastname, student.groupname,
start, end, organization.name as Place, CONCAT(supervisor.firstname,'
',supervisor.lastname) AS Supervisor
FROM student
INNER JOIN training
ON student.studentID=training.studentID
INNER JOIN organization
ON training.organizationID=organization.organizationID
INNER JOIN supervisor
ON training.supervisorID=supervisor.supervisorID
WHERE now() BETWEEN start AND end";
$result=$conn->query($sql);
?>
<h3>Students in training at the moment</h3>
<table class="table table-striped">
    <thead>
      <tr>
		<th>Groupname</th><th>Firstname</th><th>Lastname</th><th>Supervisor</th><th>organization</th>
      </tr>

    </thead>
    <tbody>
      <?php
	  //list the results of the query as table row <tr> </tr> here
	  while($row=$result->fetch_assoc()){
		  echo '<tr>';
		  echo '<td>'.$row['groupname'].'</td>';
		  echo '<td>'.$row['firstname'].'</td>';
		  echo '<td>'.$row['lastname'].'</td>';
			 echo '<td>'.$row['Supervisor'].'</td>';
			echo '<td>'.$row['Place'].'</td>';
		  echo '</tr>';
	  }
	  $conn->close(); //close connection, if not needed in this script anymore
	  ?>
    </tbody>
  </table>
