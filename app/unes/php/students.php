<?php
/*
	file:	php/students.php
	desc:	Displays a list of students. Add New -link on a page
*/
include('dbConnect.php');
$sql="SELECT * FROM student ORDER BY lastname, firstname";
$result=$conn->query($sql);
?>
<div class="text-center">
	<h1 class="h3 mb-3 font-weight-normal">Students</h1>
	<p><a href="index.php?page=newSupervisor">Add New student</a></p>
	<table class="table table-striped">
     <thead>
      <tr>
	<th>StudentID</th><th>Firstname</th><th>Lastname</th><th>Email</th><th>Phone</th><th>Practicaltrainningdone</th><th>groupname</th><th>Password</th>
      </tr>
     </thead>
     <tbody>
		<?php
		//list the results of the query as table row <tr> </tr> here
		while($row=$result->fetch_assoc()){
		  echo '<tr>';
		  
		  echo '<td>'.$row['studentID'].'</td>';
		  echo '<td>'.$row['firstname'].'</td>';
		  echo '<td>'.$row['lastname'].'</td>';
		  echo '<td>'.$row['email'].'</td>';
		  echo '<td>'.$row['phone'].'</td>';
		  echo '<td>'.$row['practicaltrainingdone'].'</td>';
		  echo '<td>'.$row['groupname'].'</td>';
		  echo '<td>'.$row['password'].'</td>';
		  
		  echo '<td><a href="index.php?page=studentinfo&id='.$row['studentID'].'">Info</a></td>';
		  echo '</tr>';
		}
		$conn->close(); //close connection, if not needed in this script anymore
		?>
	 </tbody>
    </table>
</div>