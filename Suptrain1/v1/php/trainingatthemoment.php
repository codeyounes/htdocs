<?php
/*
	file:	ontrainingnow.php
	desc:	List students who are in training at the moment
*/
include('dbConnect.php');

if(isset($_POST["delete"])){

    $studentID=$_POST["delete"];
    $sql="DELETE FROM training WHERE studentID='$studentID'";
    if($conn->query($sql)===TRUE){
      //header("location:index.php?page=trainingatthemoment");
    }//else header('location:index.php?page=trainingatthemoment');
    $sql="DELETE FROM student WHERE studentID='$studentID'";
    if($conn->query($sql)===TRUE){
    	//header("location:index.php?page=trainingatthemoment");
    }//else header('location:index.php?page=trainingatthemoment');
}

$sql="SELECT training.trainingID, student.studentID,student.firstname, student.lastname, student.groupname,
start, end, organization.name as Place, CONCAT(supervisor.firstname,'
',supervisor.lastname) AS Supervisor
FROM student
INNER JOIN training
ON student.studentID=training.studentID
INNER JOIN organization
ON training.organizationID=organization.organizationID
INNER JOIN supervisor
ON training.supervisorID=supervisor.supervisorID
WHERE now() BETWEEN start AND end ";
$result=$conn->query($sql);
?>
<h3>Students in training at the moment</h3>
<table class="table table-striped">
    <thead>
      <tr>
		<th>Groupname</th><th>Firstname</th><th>Lastname</th><th>Supervisor</th><th>organization</th>
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
			 echo '<td>'.$row['Supervisor'].'</td>';
			echo '<td>'.$row['Place'].'</td>';
		  echo '<td><a  href="index.php?page=edittraining&id='.$row['trainingID'].'&studentID='.$row['studentID'].'" >Edit</a></td>';
      echo "<td><a onclick=\"deletestudent('".$row['studentID']."')\"";
      echo  "href=\"index.php?page=trainingatthemoment&id=".$row['studentID']."\" data-toggle='modal' data-target='#myModal'>Delete</a></td>";
      echo '</tr>';

?>

      <div class="container">


        <!-- The Modal -->
        <div class="modal" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Delete Students in training at the moment</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                Are you sure you want to delete this student..
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                      <button type="submit" onclick="yesdelete();" class="btn btn-danger" data-dismiss="modal">Yes</button>


              </div>

            </div>
          </div>
        </div>
      </div>

      <form id="deleteform" method="POST" action="index.php?page=trainingatthemoment">
             <input id='deletestudent' type="hidden" name='delete'>
    </form>
<?php
	  }
	  $conn->close(); //close connection, if not needed in this script anymore
	  ?>
    </tbody>
  </table>
