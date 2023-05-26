<?php
/*
	file:	allstudents.php
	desc:	Lists all students ordered by groupname, lastname, firstname
			Displays results in a table (use bootstrap styles)
*/
include('dbConnect.php'); //uses the database connection created in dbConnect.php

//SQL-query used for this script
$sql="SELECT groupname,firstname,lastname,email, practicaltrainingdone
		FROM `student` ORDER BY groupname,lastname,firstname";

		//run the query and create a resultset (array of records in query)
$result=$conn->query($sql);
?>
<h3>All students in database</h3>
<table class="table table-striped">
    <thead>
      <tr>
		<th>Groupname</th><th>Firstname</th><th>Lastname</th><th>Email</th>
		<th>Training finished</th>
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
		  echo '<td>'.$row['email'].'</td>';
		  echo '<td>'.$row['practicaltrainingdone'].'</td>';
		  echo '</tr>';
	  }
	  $conn->close(); //close connection, if not needed in this script anymore
	  ?>
    </tbody>
  </table>
