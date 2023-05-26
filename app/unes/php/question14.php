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
$howmany=5; //nr of rows on page
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
$sql="SELECT count(studentID) AS Students_in_training,
YEAR(now()) AS Thisyear
FROM `training`
WHERE YEAR(start)=YEAR(now())
		"; 

		//run the query and create a resultset (array of records in query)
$result=$conn->query($sql);
?>
<h3>All students in database</h3>
<?php if($group!='%%') echo '<p><a href="index.php?page=allstudents">Show all</a>';?>

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
		<th>Students_in_training</th>
		
      </tr>
    </thead>
    <tbody>
      <?php
	  //list the results of the query as table row <tr> </tr> here
	  while($row=$result->fetch_assoc()){
		  echo '<tr>';
		  echo '<td>'.$row['Students_in_training'].'</td>';
		 
		 
		  echo '</tr>';
	  }
	  $conn->close(); //close connection, if not needed in this script anymore
	  ?>
    </tbody>
  </table>
  
  
  
  
  
  
  