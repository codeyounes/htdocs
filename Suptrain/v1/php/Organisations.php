<?php
/*
	file:	php/organisations.php
	desc:	Displays a list of organisations. 
*/
include('dbConnect.php');
$sql="SELECT * FROM organization ORDER BY name";
$result=$conn->query($sql);
?>
<div class="text-center">
	<h1 class="h3 mb-3 font-weight-normal">Organisations</h1>
	<p><a href="index.php?page=newOrganisation">Add New organization</a></p>
	<table class="table table-striped">
     <thead>
      <tr>
		<th>name</th><th>address</th><th>Contactperson</th><th>email</th><th>phone</th>
      </tr>
     </thead>
     <tbody>
		<?php
		//list the results of the query as table row <tr> </tr> here
		while($row=$result->fetch_assoc()){
		  echo '<tr>';
		  echo '<td>'.$row['name'].'</td>';
		  echo '<td>'.$row['address'].'</td>';
		  echo '<td>'.$row['contactperson'].'</td>';
		  echo '<td>'.$row['email'].'</td>';
		   echo '<td>'.$row['phone'].'</td>';
		  
		  echo '</tr>';
		}
		$conn->close(); //close connection, if not needed in this script anymore
		?>
	 </tbody>
    </table>
</div>