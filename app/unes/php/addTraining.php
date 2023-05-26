<?php include('dbConnect.php'); //uses the database connection created in dbConnect.php
if(isset($_POST['start'],$_POST['end'],$_POST['place'],$_POST['supervisor'])){ //echo "test 2";
	$start=$_POST['start'];
	$end=$_POST['end'];
	$place=$_POST['place'];
	$supervisor=$_POST['supervisor'];
	$hours=$_POST['hours'];
	$sql="INSERT INTO training(studentID,start,end,organizationID,supervisorID,supervisorhours)
			values('".$_GET['id']."','".$start."','".$end."','".$place."','".$supervisor."','".$hours."')";
			//echo $sql;
	if($conn->query($sql)===TRUE){ echo 'Ok';
              header('location:index.php?page=ontraining&id='.$_GET["id"]);
  }
	else echo 'Fail'; //this is tested in jQuery part
}?>

<div class="modal-body" >
        <form class="form-signin" id="frmTraining" method="post" action="index.php?page=addTraining&id=<?php
echo $_GET["id"];
        ?>" >
			<div class="form-group">
			  <label for="start">Starting date:</label>
			  <input type="date" class="form-control" id="start" name="start" />
			</div>
			<div class="form-group">
			  <label for="end">Ending date:</label>
			  <input type="date" class="form-control" id="end" name="end"/>
			</div>
			<div class="form-group">
			  <label for="place">Select place:</label>
			  <select class="form-control" name="place">
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
			  <label for="supervisor">Select supervisor:</label>
			  <select class="form-control" name="supervisor">
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
			<div class="form-group">
			  <label for="hours">Hours for supervising:</label>
			  <input type="number" min="1" max="100" class="form-control" id="hours" name="hours"/>
			</div>
			<button type="submit" class="btn btn-primary">Add training</button>
		</form>
      </div>