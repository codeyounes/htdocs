<?php
/*
	file: php/getSupervisors.php
	desc: Gets supervisors from database and puts the 
		  results into JSON-data object.
*/
header("Access-Control-Allow-Origin: * ");
session_start();
if(isset($_SESSION['user'])){
	$JSON = array(); //array for results as JSON
	include('dbConnect.php');
	$sql="SELECT * FROM supervisor ";
	if(isset($_GET['id'])) $sql.=" WHERE supervisorID=".$_GET['id'];
	$sql.=" ORDER BY lastname, firstname";
	$result=$conn->query($sql);
	while($row=$result->fetch_assoc()){
		$JSON["supervisors"][]=$row; //name of JSON-array "supervisors"
	}
	echo json_encode($JSON); //encodes the data into JSON-object
}else echo 'Fail';
?>