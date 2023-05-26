
include('dbConnect.php'); //uses the database connection created in dbConnect.php

$sql="SELECT studentID,groupname,firstname,lastname,email, practicaltrainingdone
		FROM `student`
		WHERE groupname LIKE '$group'
		ORDER BY lastname,firstname
		LIMIT $start,$howmany
		";
<table class="table">
<tr>
	<?php
	//Pager links start here
	if($start<$howmany)echo '<td>Prev</td>';
	else{
	?>
		<td><a href="index.php?page=allstudents&start=<?php echo $prev?>">Prev</a></td>
	<?php
	}
	if($total-$division>=$next){
	?>
	<td><a href="index.php?page=allstudents&start=<?php echo $next?>">Next</a></td>
	<?php
	}
	else echo '<td>Next</td>';
	//Pager links end here
	?>
</tr>
</table>

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
		  echo '<td><a href="index.php?page=allstudents&group='.$row['groupname'].'">'.$row['groupname'].'</a></td>';
		  echo '<td>'.$row['firstname'].'</td>';
		  echo '<td>'.$row['lastname'].'</td>';
		  echo '<td>'.$row['email'].'</td>';
		  echo '<td>'.$row['practicaltrainingdone'].'</td>';
		  echo '<td><a href="index.php?page=studentinfo&id='.$row['studentID'].'">Info</a></td>';
		  echo '<td><a href="index.php?page=deletestudent&id='.$row['studentID'].'">Delete</a></td>';

		  echo '</tr>';
	  }

	  $conn->close(); //close connection, if not needed in this script anymore
	  ?>
    </tbody>
  </table>
