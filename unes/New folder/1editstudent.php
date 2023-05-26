<?php
/*
	file:	php/editSupervisor.php
	desc:	Form to edit supervisor
			Displays $_SESSION['insNewMsg'] -variable if exists to show
			messages from inserting script (success or errors)
*/
if(isset($_GET['id'])) $id=$_GET['id'];else $id='';
echo '<h3>Edit Student</h3>';
if(isset($_SESSION['insNewMsg'])) echo $_SESSION['insNewMsg'];
$_SESSION['insNewMsg']='';
include('dbConnect.php');
$sql="SELECT * FROM student WHERE studentID='$id'";

$result=$conn->query($sql);
if($result->num_rows > 0){
	//supervisor found
	$row=$result->fetch_assoc(); //results into a row
}else header('location:../index.php?page=error');
?>
<form action="php/1updateStudent.php" method="post">
	<input type="hidden" name="id" value="<?php echo $id?>" />
	<div class="form-group">
		<label for="studentID">StudentID</label>
		<input type="text" name="studentID" class="form-control" autofocus required
			value="<?php echo $row['studentID']?>" />
	</div>
	<div class="form-group">
		<label for="firstname">Firstname</label>
		<input type="text" name="firstname" class="form-control" autofocus required
			value="<?php echo $row['firstname']?>" />
	</div>
	<div class="form-group">
		<label for="lastname">Lastname</label>
		<input type="text" name="lastname" class="form-control" required
			value="<?php echo $row['lastname']?>"/>
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" class="form-control" required
			value="<?php echo $row['email']?>"/>
	</div>
	<div class="form-group">
		<label for="phone">Phone</label>
		<input type="text" name="phone" class="form-control" autofocus required
			value="<?php echo $row['phone']?>" />
	</div>
	<div class="form-group">
		<label for="practicaltrainingdone">Practicaltrainingdone</label>
		<input type="text" name="practicaltrainingdone" class="form-control" required
			value="<?php echo $row['practicaltrainingdone']?>"/>
	</div>
	<div class="form-group">
		<label for="groupname">Group name</label>
		<input type="text" name="groupname" class="form-control" autofocus required
			value="<?php echo $row['groupname']?>" />
	</div>
	<button type="submit" class="btn btn-primary btn-block">Update</button>
</form>
