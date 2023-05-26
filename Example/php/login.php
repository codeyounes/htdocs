<?php
/*
	file:	php/login.php
	Desc: 	Checks if login is ok. Adds SESSION-variables user and userID
			to session. Always returns the view to index.php
*/
if(!empty($_POST)){
								//coming from the form
								$email=$_POST['inputEmail'];
								$password=$_POST['inputPassword'];
								include('dbConnect.php');
								$sql="SELECT userID,password,firstname,lastname FROM user
										WHERE email='$email'";
								//echo $sql;
								$result=$conn->query($sql);

											ECHO "TEST3";
								if($result->num_rows > 0){
													//found the email given in form + other fields
																$password=$conn->real_escape_string($password); //removes unwanted characters
																$row=$result->fetch_assoc();	//get the row results

																ECHO "TEST2";
													if(password_verify($password,$row['password'])){
																			//login ok
																			session_start();
																			$_SESSION['user']=$row['firstname'].' '.$row['lastname'];
																			$_SESSION['userID']=$row['userID'];

																			ECHO "TEST";
													}	//passwords did not match
								}
								else{	$sql="SELECT studentID,password,firstname,lastname FROM student
											WHERE email='$email'";
									//echo $sql;
									$result=$conn->query($sql);

												ECHO "TEST4";
									if($result->num_rows > 0){
														//found the email given in form + other fields
																	$password=$conn->real_escape_string($password); //removes unwanted characters
																	$row=$result->fetch_assoc();	//get the row results

																	ECHO "TEST5";
														if(password_verify($password,$row['password'])){
																				//login ok
																				session_start();
																				$_SESSION['user']=$row['firstname'].' '.$row['lastname'];
																				$_SESSION['studentID']=$row['studentID'];

																				ECHO "TEST6";
														}	//passwords did not match
									}		//email was not found}		//email was not found
								}
}
header('location:../index.php');  //everytime goes back to index.php
?>
