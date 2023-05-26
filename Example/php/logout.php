<?php
/*
	file:	php/logout.php
	desc:	Removes session information, back to index.php -page
*/
session_start();
session_destroy();
header('location:../index.php');
?>