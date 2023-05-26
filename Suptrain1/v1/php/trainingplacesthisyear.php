<?php
/*
	file:	ontrainingnow.php
	desc:	List students who are in training at the moment
*/if(isset($_GET['group'])) $group=$_GET['group']; else $group='%%';
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

include('dbConnect.php');
$sql="SELECT training.studentID, training.supervisorID, organization.name AS Place,
CONCAT(student.firstname,' ',student.lastname) AS Student,
training.start AS Started, training.end AS Training_ends
FROM `organization`
INNER JOIN training
ON organization.organizationID=training.organizationID
INNER JOIN student
ON training.studentID=student.studentID
WHERE organization.name LIKE '$group' AND YEAR(now())=YEAR(training.start)
ORDER BY Place, Started, Student";
$result=$conn->query($sql);
?>
<h3>Students who are in training in selected organization at the moment</h3>
<table class="table table-striped">
    <thead>
      <tr>
		<th>Place</th><th>Student</th><th>Started</th><th>Training_ends</th>
      </tr>
    </thead>
    <tbody>
      <?php
	  //list the results of the query as table row <tr> </tr> here
	  while($row=$result->fetch_assoc()){
		  echo '<tr>';
		  echo '<td><a href="index.php?page=trainingplacesthisyear&group='.$row['Place'].'">'.$row['Place'].'</a></td>';
		  echo '<td>'.$row['Student'].'</td>';
		  echo '<td>'.$row['Started'].'</td>';
      echo '<td>'.$row['Training_ends'].'</td>';
      echo '<td><a href="index.php?page=studentinfo&id='.$row['studentID'].'">Info</a></td>';
      echo "<td><a onclick=\"deletestudent('".$row['studentID']."')\"";
      echo  "href=\"index.php?page=trainingplacesthisyear&id=".$row['studentID']."\" data-toggle='modal' data-target='#myModal'>Delete</a></td>";
      echo '</tr>';



            ?>

                  <div class="container">


                    <!-- The Modal -->
                    <div class="modal" id="myModal">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Delete Training places and their students this year</h4>
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

                  <form id="deleteform" method="POST" action="index.php?page=trainingplacesthisyear">
                         <input id='deletestudent' type="hidden" name='delete'>
                </form>
            <?php






	  }
	  $conn->close(); //close connection, if not needed in this script anymore
	  ?>
    </tbody>
  </table>
