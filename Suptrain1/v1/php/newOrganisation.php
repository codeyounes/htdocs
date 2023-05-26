<?php
/*
	file:	php/NewOrganisation.php
	desc:	Form to add new organisation
			Displays $_SESSION['insNewMsg'] -variable if exists to show
			messages from inserting script (success or errors)
*/
echo '<h3>Add New Organisation</h3>';
if(isset($_SESSION['insNewMsg'])) echo $_SESSION['insNewMsg'];
$_SESSION['insNewMsg']='';
?>
<form action="php/insertOrganisation.php" method="post">
	<div class="form-group">
		<label for="name">name</label>
		<input type="text" name="name" class="form-control" autofocus required />
	</div>
	<div class="form-group">
		<label for="lastname">address</label>
		<input type="text" name="address" class="form-control" required />
	</div>
	<div class="form-group">
		<label for="contactperson">Contactperson</label>
		<input type="text" name="contactperson" class="form-control" required />
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" class="form-control" required />
	</div>
	<div class="form-group">
		<label for="phone">Phone</label>
		<input type="text" name="phone" class="form-control" required />
	</div>
	<button type="submit" class="btn btn-primary btn-block">Insert</button>
</form>
