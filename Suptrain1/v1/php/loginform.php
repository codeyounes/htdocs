<?php
/*
	file:	php/loginform.php
	desc:	Shows the loginform
*/
?>
<div class="text-center">
	<form class="form-signin" action="php/login.php" method="post">
		<h1 class="h3 mb-3 font-weight-normal">Login in here</h1>
		<input type="email" name="inputEmail" class="form-control" 
			placeholder="Your email" required autofocus />
		<input type="password" name="inputPassword" class="form-control"
			placeholder="Password" required />
		<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
	</form>
</div>