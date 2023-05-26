<?php
/*
	file:	first.php
	desc:	Basic syntas example of PHP
*/
$name="Yrjö Koskenniemi"; //defining a variable called $name
?>
<!DOCTYPE html>
<html>
	<head>
		<title>My First PHP-script</title>
	</head>
	<body>
		<h3>My first PHP-script<h3>
		<h4>Hello <?php echo $name?>!</h3>
		<?php
			echo "<p>This text is written with PHP echo-command.</p>";
			echo '<p>Here is another text.</p>';
			echo "<p>Your name is $name.</p>"; //this works fine
			echo '<p>Your name is $name.</p>'; //No variables can be placed inside ''
		?>
		<h3>Variables</h3>
		<?php
			$number=56; //defining a variable and type is integer
			$divider=12;
			$division=round($number/$divider,2); //calculation and round-function
			echo "<p>Number $number divided with $divider is $division</p>";
			$size=55.5; //decimal value defined
			$itemcount="5 items"; //text value -> do not use text variable for numbers
			$totalsize=$size*$itemcount;
			echo "<p>Totalsize is $totalsize.</p>";
		?>
	</body>
</html>
