<?php
/*
	file:	php/supervisors.php
	desc:	Displays a list of supervisors. Add New -link on a page
*/
include('dbConnect.php');
$sql="SELECT * FROM supervisor ORDER BY lastname, firstname";
$result=$conn->query($sql);
?>
<div class="text-center">
	<h1 class="h3 mb-3 font-weight-normal">Supervisors</h1>
	<p><a href="index.php?page=newSupervisor">Add New Supervisor</a></p>
	<table class="table table-striped">
     <thead>
      <tr>
		<th>Firstname</th><th>Lastname</th><th>Email</th><th>Phone</th>
      </tr>
     </thead>
     <tbody>
		<?php
		//list the results of the query as table row <tr> </tr> here
		while($row=$result->fetch_assoc()){
		  echo '<tr>';
		  echo '<td>'.$row['firstname'].'</td>';
		  echo '<td>'.$row['lastname'].'</td>';
		  echo '<td>'.$row['email'].'</td>';
		  echo '<td>'.$row['phone'].'</td>';
		  echo '<td><a href="index.php?page=supervisorinfo&id='.$row['supervisorID'].'">Info</a></td>';
		  echo '</tr>';
		}
		$conn->close(); //close connection, if not needed in this script anymore
		?>
	 </tbody>
    </table>
</div>
