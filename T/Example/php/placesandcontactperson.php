<?php
/*
	file:	ontrainingnow.php
	desc:	List students who are in training at the moment
*/
include('dbConnect.php');
$sql="SELECT name AS Place, contactperson AS Contact, email
FROM `organization`
ORDER BY Place";
$result=$conn->query($sql);
?>
<h3>Training places and contact persons</h3>
<table class="table table-striped">
    <thead>
      <tr>
		<th>Place</th><th>Contact</th><th>email</th>
    </thead>
    <tbody>
      <?php
	  //list the results of the query as table row <tr> </tr> here
	  while($row=$result->fetch_assoc()){
		  echo '<tr>';
		  echo '<td>'.$row['Place'].'</td>';
		  echo '<td>'.$row['Contact'].'</td>';
		  echo '<td>'.$row['email'].'</td>';
		  echo '</tr>';
	  }
	  $conn->close(); //close connection, if not needed in this script anymore
	  ?>
    </tbody>
  </table>
