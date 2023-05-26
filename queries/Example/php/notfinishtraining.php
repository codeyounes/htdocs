<?php
/*
	file:	ontrainingnow.php
	desc:	List students who are in training at the moment
*/
include('dbConnect.php');
$sql="SELECT groupname,firstname,lastname,email, practicaltrainingdone
FROM `student`
WHERE groupname='T42D17S' AND practicaltrainingdone=false
ORDER BY lastname,firstname";
$result=$conn->query($sql);
?>
<h3>Students in training at the moment</h3>
<table class="table table-striped">
    <thead>
      <tr>
		<th>Groupname</th><th>Firstname</th><th>Lastname</th><th>notfifnishtraining</th>
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
			echo '<td>'.$row['practicaltrainingdone'].'</td>';
		  echo '</tr>';
	  }
	  $conn->close(); //close connection, if not needed in this script anymore
	  ?>
    </tbody>
  </table>
