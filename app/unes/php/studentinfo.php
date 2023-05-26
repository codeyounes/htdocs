<?php
/*
	file:	php/studentinfo.php
	desc:	Shows info about the selected student.
			Form for adding year+hours for that year
*/
if(isset($_GET['id'])) $id=$_GET['id']; 
else header('location:index.php?page=student');

include('dbConnect.php');
$sql="SELECT * FROM student WHERE studentID='$id'";
$result=$conn->query($sql);
if($result->num_rows > 0){
	//student found
	$row=$result->fetch_assoc(); //results into a row
?>
<h1 class="h3 mb-3 font-weight-normal">studentinfo</h1>
<div class="card d-inline-flex">
  <div class="text-center">
	<?php
	//displays profile image, if exists. Default avatar.png otherwise
	if(empty($row['image'])){
		echo '<img class="img-responsive img-thumbnail" width="150px" src="images/avatar.png" />';
	}else{
		echo '<img class="img-responsive img-thumbnail" width="150px" src="images/supervisors/'.$row['image'].'" />';
	}
	?>
  </div>
  <div class="card-body">
    <h4 class="card-title"><?php echo $row['firstname'].' '.$row['lastname'].' <a href="index.php?page=editStudent&id='.$id.'">[Edit]</a></h4>';?>
    <p class="card-text">Email: <?php echo $row['email'].', Phone: '.$row['phone']?></p>
	<p class="card-text">Add trainaing: <a href="index.php?page=addTraining&id=<?php echo $id?>&add=ok">[Add]</a></p>

	
  </div>
</div>
<?php
}else header('location:index.php?page=students');
?>
