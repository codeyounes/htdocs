<?php
/*
	file:	php/uploadImage.php
	desc:	Uploads selected imagefile into given folder.
			Finally updates database table supervisor with imagefile name
*/
if(empty($_POST)) header('location:../index.php');
else{
	session_start();
	$id=$_POST['id']; 		  //supervisorID or studentID etc
	$folder=$_POST['folder']; //which folder under images to save file
	$imagefile=basename($_FILES['imagefile']['name']); //name of the file
	$target_dir="../images/$folder/"; //defining the folder to save file
	$target_file=$target_dir.$id.'_'.$imagefile; //this is used later
	$imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$uploadOK=1; //this is used to check if error happens somewhere in script
	//checking of different file properties later here
	
	//if all the checking is ok, upload the file
	if($uploadOK==0){
		//something went wrong when checking the properties
	}else{
		//upload the file
		if(move_uploaded_file($_FILES['imagefile']['tmp_name'],$target_file)){
			echo 'File uploaded';
		}
	}
}
?>


