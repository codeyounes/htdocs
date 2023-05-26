<?php
/*
	file:	php/supervisorinfo.php
	desc:	Shows info about the selected supervisor.
			Form for adding year+hours for that year
*/
if(isset($_GET['id'])) $id=$_GET['id']; 
else header('location:index.php?page=supervisors');
if(isset($_GET['add'])) $add=$_GET['add'];else $add=''; 
include('dbConnect.php');
$sql="SELECT * FROM supervisor WHERE supervisorID=$id";
$result=$conn->query($sql);
if($result->num_rows > 0){
	//supervisor found
	$row=$result->fetch_assoc(); //results into a row
?>
<h1 class="h3 mb-3 font-weight-normal">Supervisorinfo</h1>
<div class="card" style="width:600px">
  <img class="card-img-top" src="" alt="">
  <div class="card-body">
    <h4 class="card-title"><?php echo $row['firstname'].' '.$row['lastname'].' <a href="index.php?page=editSupervisor&id='.$id.'">[Edit]</a></h4>';?>
    <p class="card-text">Email: <?php echo $row['email'].', Phone: '.$row['phone']?></p>
	<p class="card-text">Resources: <a href="index.php?page=supervisorinfo&id=<?php echo $id?>&add=ok">[Add]</a></p>
	<?php
	//show the form for adding resources, if add=ok is found in GET
	if($add=='ok'){
		echo '<form class="card" action="php/addhours.php" method="post">';
		echo 'Year: <input type="number" name="year" required/>';
		echo 'Hours: <input type="number" name="hours" required/>';
		echo '<button class="btn btn-primary">Save</button>';
		echo '</form>';
	}
	$sql="SELECT * FROM supervisorhours WHERE supervisorID=$id ORDER BY year DESC";
	$result=$conn->query($sql);
	?>
	<ul class="card">
		<?php
		while($row=$result->fetch_assoc()){
			echo '<li class="card">Year: ';
			echo $row['year'].', Hours: '.$row['hours'];
			echo '</li>';
		}
		?>
	</ul>
  </div>
</div>
<?php
}else header('location:index.php?page=supervisors');
?>