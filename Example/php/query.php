<?php
/*
	file:	allstudents.php
	desc:	Lists all students ordered by groupname, lastname, firstname
			Displays results in a table (use bootstrap styles)
*/
//read the group from GET-variables if it is coming
if(isset($_GET['group'])) $group=$_GET['group'];else $group='%%';

//read the start value for paging if it comes, otherwise 0
if(isset($_GET['start'])) $start=$_GET['start']; else $start=0;
$howmany=20; //nr of rows on page
$next=$start+$howmany; //value for the next link
$prev=$start-$howmany; //value for the previous link
if($prev<0)$prev=0;

include('dbConnect.php'); //uses the database connection created in dbConnect.php

//calculate the total nr of records in query
$sql="SELECT count(studentID) AS Total FROM student";
$result=$conn->query($sql);
if($row=$result->fetch_assoc()){
	$total=$row['Total'];
}
$division=$total%$howmany; //used to check if Next-link is needed

//calculate if next-link will be needed or not


//SQL-query used for this script
$sql="SELECT *
		FROM `student`
		WHERE groupname LIKE '$group'
		ORDER BY groupname,lastname,firstname
		LIMIT $start,$howmany
		";

		//run the query and create a resultset (array of records in query)
$result=$conn->query($sql);
?>
<h3 class="text-center">All students in database</h3>
<p class="text-center"><a href="index.php?page=Sewstudent">Add New Student</a></p>
<?php if($group!='%%') echo '<p><a href="index.php?page=query1_2_11">Show all</a>';?>

<table class="table">
</table>
<div>
<table class="table table-striped">
    <thead>
      <tr>
		<th>Groupname</th>	<th>StudentID</th> <th>Firstname</th><th>Lastname</th><th>Email</th>
		<th>Training finished</th>
      </tr>
    </thead>
    <tbody>
      <?php
	  //list the results of the query as table row <tr> </tr> here
	  while($row=$result->fetch_assoc()){
		  echo '<tr>';
		  echo '<td><a href="index.php?page=allstudents&group='.$row['groupname'].'">'.$row['groupname'].'</a></td>';
			echo '<td>'.$row['studentID'].'</td>';
			echo '<td>'.$row['firstname'].'</td>';
		  echo '<td>'.$row['lastname'].'</td>';
			echo '<td>'.$row['email'].'</td>';
			echo '<td>'.$row['practicaltrainingdone'].'</td>';
			echo '<td><a href="index.php?page=studentinfo&id='.$row['studentID'].'">Info</a></td>';
			echo '<td><a href="index.php?page=1delstudent&id='.$row['studentID'].'">Delete</a></td>';
			echo '</tr>';
	  }
	  $conn->close(); //close connection, if not needed in this script anymore
	  ?>
    </tbody>
  </table>
  </div>
