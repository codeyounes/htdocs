--
<?php
/*
	file:	ontrainingnow.php
	desc:	List students who are in training at the moment
*/
include('dbConnect.php');
$sql="SELECT student.firstname,
 student.lastname,
 student.groupname,
start,
 end,
 organization.name
FROM student
INNER JOIN training
ON student.studentID=training.studentID
INNER JOIN organization
ON training.organizationID=organization.organizationID
WHERE now() BETWEEN start AND end";
$result=$conn->query($sql);
?>
<h3>Students in training this year</h3>
<table class="table table-striped">
    <thead>
      <tr>
		<th>Groupname</th><th>Firstname</th><th>Lastname</th><th>start</th><th>end</th><th>organization</th>
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
			 echo '<td>'.$row['start'].'</td>';
			  echo '<td>'.$row['end'].'</td>';
			echo '<td>'.$row['name'].'</td>';
		  echo '</tr>';
	  }
	  $conn->close(); //close connection, if not needed in this script anymore
	  ?>
    </tbody>
  </table>
