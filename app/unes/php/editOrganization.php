<?php
/*
	file:	php/editOrganization.php
	desc:	Form to edit organization
			Displays $_SESSION['insNewMsg'] -variable if exists to show
			messages from inserting script (success or errors)
*/
if(isset($_GET['id'])) $id=$_GET['id'];else $id='';
echo '<h3>Edit Organization</h3>';
if(isset($_SESSION['insNewMsg'])) echo $_SESSION['insNewMsg'];
$_SESSION['insNewMsg']='';
include('dbConnect.php');
$sql="SELECT * FROM organization WHERE organizationID=$id";
$result=$conn->query($sql);
if($result->num_rows > 0){
	//supervisor found
	$row=$result->fetch_assoc(); //results into a row
}else header('location:../index.php?page=error');
?>
<div class="row">
 <div class="col-sm-8">

 
   <form action="php/updateOrganization.php" method="post">
	<input type="hidden" name="id" value="<?php echo $id?>" />
	<div class="form-group">
		<label for="name">name</label>
		<input type="text" name="name" class="form-control" autofocus required 
			value="<?php echo $row['name']?>" />
	</div>
	<div class="form-group">
		<label for="address">Address</label>
		<input type="text" name="address" class="form-control" required 
			value="<?php echo $row['address']?>"/>
	</div>
	<div class="form-group">
		<label for="contactperson">Contactperson</label>
		<input type="text" name="contactperson" class="form-control" required 
			value="<?php echo $row['contactperson']?>"/>
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" class="form-control" required 
			value="<?php echo $row['email']?>"/>
	</div>
	<div class="form-group">
		<label for="phone">Phone</label>
		<input type="text" name="phone" class="form-control" required 
			value="<?php echo $row['phone']?>"/>
	</div>
	<button type="submit" class="btn btn-primary btn-block">Update</button>
   </form>
 </div>
 
</div>




