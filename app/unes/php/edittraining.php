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
if(isset($_SESSION['insNewMsg'])) echo $_SESSION['insNewMsg'];
$_SESSION['insNewMsg']='';
include('dbConnect.php');
$sql="SELECT * FROM training WHERE studentID='".$studentID."'";
$result=$conn->query($sql);
if($result->num_rows > 0){
	//supervisor found
	$row=$result->fetch_assoc(); //results into a row
}else echo "sql error, student ID incorrect:  ".$sql;
?>
<div class="row">
 <div class="col-sm-8">
   <h3>Basic info</h3>
   <form action="php/updatetraining.php" method="post">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<input type="hidden" name="studentID" value="<?php echo $studentID; ?>" />
				<div class="form-group">
					<label for="start">Starting date</label>
					<input type="text" name="start" class="form-control" autofocus required 
						value="<?php echo $row['start']?>" />
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
									while($row=$result->fetch_assoc()){
											  echo '<option value="'.$row['organizationID'].'" >';

											echo $row['name']	  ;
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
									while($row=$result->fetch_assoc()){
									echo '<option value="'.$row['supervisorID'].'">';
									echo $row['lastname'] ;

											  echo '</option>';
										  }?>
						  </select>
				</div>
				<button type="submit" class="btn btn-primary btn-block">Update</button>
   </form>
 </div>
 
		
	
 </div>





