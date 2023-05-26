<?php
/*
	file:	php/edittraining.php
	desc:	Form to edit training
			Displays $_SESSION['insNewMsg'] -variable if exists to show
			messages from inserting script (success or errors)
*/

if(isset($_GET['id'])) $id=$_GET['id'];else $id='';
if(isset($_GET['studentID'])) $studentID=$_GET['studentID'];else $studentID='';
echo '<h3>Edit training</h3>';

include('dbConnect.php');


$start='';
if(isset($_POST['start']))$start=$_POST['start'];
$end='';
if(isset($_POST['end']))$end=$_POST['end'];
$organizationID='';
if(isset($_POST['organizationID']))$organizationID=$_POST['organizationID'];
$supervisorID='';
if(isset($_POST['supervisorID'])){$supervisorID=$_POST['supervisorID'];
					$sql="UPDATE training SET start='$start',
						end='$end', studentID='$studentID', organizationID='$organizationID' ,supervisorID='$supervisorID'
						WHERE trainingID='$id'";
					if($conn->query($sql)=== TRUE){
						echo "<br>success";
						$_SESSION['insNewMsg']='<p class="alert alert-success">Student updated!</p>';
					header('Location:../index.php?page=trainingatthemoment');
					}else{
						$_SESSION['insNewMsg']='<p class="alert alert-danger">Was not able to update!</p>';
					}
}
if(isset($_SESSION['insNewMsg'])) echo $_SESSION['insNewMsg'];
$_SESSION['insNewMsg']='';

$sql="SELECT * FROM training WHERE trainingID='".$id."'";
$result=$conn->query($sql);
if($result->num_rows > 0){
	//supervisor found
	$row=$result->fetch_assoc(); //results into a row
}else echo "sql error, student ID incorrect:  ".$sql;
?>
<div class="row">
 <div class="col-sm-8">
   <h3>Basic info</h3>
   <form action="php/edittraining.php?id=<?php echo $id; ?>&studentID=<?php echo $studentID; ?>" method="post">
				<input type="hidden" name="id"  value="<?php echo $id; ?>" />
				<input type="hidden" name="studentID" value="<?php echo $studentID; ?>" />
				<input type="hidden" name="trainingID" value="<?php echo $row['trainingID']; ?>" />
				<div class="form-group">
					<label for="start">Starting date</label>
					<input type="text" name="start" class="form-control" autofocus required
						value="<?php echo $row['start']; ?>" />
				</div>
				<div class="form-group">
					<label for="end">Ending date</label>
					<input type="text" name="end" class="form-control" required
						value="<?php echo $row['end']?>"/>

				</div>
				<div class="form-group">
					<label for="organizationID">Select place</label>
					<select class="form-control" name="organizationID">
						  <?php $sql="SELECT organizationID,name
											FROM organization
											";

									$result=$conn->query($sql);
									while($row2=$result->fetch_assoc()){
											  echo '<option value="'.$row2['organizationID'].'" >';

											echo $row2['name']	  ;
											echo '</option>';
										  }?>
										  </select>

				</div>
				<div class="form-group">
					<label for="supervisorID">Select supervisor</label>
					<select class="form-control" name="supervisorID">
						  <?php $sql="SELECT  supervisorID,lastname
											FROM supervisor
											";

									$result=$conn->query($sql);
									while($row3=$result->fetch_assoc()){
									echo '<option value="'.$row3['supervisorID'].'">';
									echo $row3['lastname'] ;

											  echo '</option>';
										  }?>
						  </select>
				</div>
				<button type="submit" class="btn btn-primary btn-block">Update</button>
   </form>
 </div>



 </div>
