<?php
/*
	file:	php/supervisorinfo.php
	desc:	Shows info about the selected supervisor.
			Form for adding year+hours for that year
*/
if(isset($_GET['id'])) $id=$_GET['id'];
else header('location:index.php?page=allstudents');
include('dbConnect.php');
$sql="SELECT * FROM student WHERE studentID='$id'";
$result=$conn->query($sql);
if($result->num_rows > 0){
	//supervisor found
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


	<img class="img-responsive img-thumbnail" width="150" height="150" src="images/allstudents/avatar.png" alt="<?php echo $row['firstname'].' '.$row['lastname']?>">
  </div>
	<?php
	echo '<a href="php/delStudent.php?id='.$row['studentID'].'">[Delete]</a>';
	?>




  <div class="card-body">
    <h4 class="card-title"><?php echo $row['firstname'].' '.$row['lastname'].' <a href="index.php?page=editStudent&id='.$id.'">[Edit]</a></h4>';?>
		<p class="card-text">StudentID: <?php echo $row['studentID']?></p>
				<p class="card-text">Email: <?php echo $row['email']?></p>
				<p class="card-text">Phone: <?php echo $row['phone']?></p>
				<p class="card-text">Training Finished: <?php echo $row['practicaltrainingdone']?></p>
				<p class="card-text">Group name: <?php echo $row['groupname']?></p>


  </div>
</div>
<?php
}else header('location:index.php?page=studentinfo');
?>
