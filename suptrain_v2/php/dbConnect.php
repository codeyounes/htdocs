<?php
/*
	file:	dbConnect.php
	desc:	Connects to the database suptrain and uses it with webuser account
			suptrain
*/
$dbServer='localhost'; 	//MySQL and Webserver on the same computer -> localhost
$dbName='suptrain'; 	//database to be connected
$dbUsername='suptrain';	//User created in MySQL to access suptrain database
$dbPassword='suptrain';	//Password for user suptraing

//use mysqli-object to connected
$conn=new mysqli($dbServer,$dbUsername,$dbPassword,$dbName);

//check if there were errors on connecting
if($conn->connect_error){
	die('Problem with connection.'.$conn->connect_error);
}
//Special characters available in connection (ÅÄÖåäö etc)
mysqli_set_charset($conn,"utf8");
?>