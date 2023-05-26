<?php
/*
	file:	php/supervisorinfo.php
	desc:	Shows info about the selected supervisor.
			Form for adding year+hours for that year
*/
if(isset($_GET['id'])) $id=$_GET['id']; 
else header('location:index.php?page=supervisors');
if(isset($_GET['add'])) $add=$_GET['add'];else $add=''; 
if(isset($_GET['edit'])) $edit=$_GET['edit'];else $edit=''; 
include('dbConnect.php');
$sql="SELECT * FROM supervisor WHERE supervisorID=$id";
$result=$conn->query($sql);
if($result->num_rows > 0){
	//supervisor found
	$row=$result->fetch_assoc(); //results into a row
?>
<h1 class="h3 mb-3 font-weight-normal">Supervisorinfo</h1>
<div class="card d-inline-flex">
  <div class="text-center">
	<img class="img-responsive img-thumbnail" width="150" height="150" src="images/supervisors/avatar.png" alt="<?php echo $row['firstname'].' '.$row['lastname']?>">
  </div>
  <div class="card-body">
    <h4 class="card-title"><?php echo $row['firstname'].' '.$row['lastname'].' <a href="index.php?page=editSupervisor&id='.$id.'">[Edit]</a></h4>';?>
    <p class="card-text">Email: <?php echo $row['email'].', Phone: '.$row['phone']?></p>
	<p class="card-text">Resources: <a href="index.php?page=supervisorinfo&id=<?php echo $id?>&add=ok">[Add]</a></p>
	<?php
	//show the form for adding resources, if add=ok is found in GET
	if($add=='ok'){
		include('php/frmAddHours.php');
	}
	if($edit=='ok'){
		include('php/frmEditHours.php');
	}
	$sql="SELECT * FROM supervisorhours WHERE supervisorID=$id ORDER BY year DESC";
	$result=$conn->query($sql);
	?>
	<table class="table table-striped">
		<thead>
			<tr><th>Year</th><th>Total</th><th></th>
		</thead>
		<tbody>
		<?php
		while($row=$result->fetch_assoc()){
			echo '<tr>';
			echo '<td>'.$row['year'].'</td>';
			echo '<td>'.$row['hours'].'</td>';
			echo '<td><a href="index.php?page=supervisorinfo&id='.$id.'&edit=ok&rowid='.$row['supervisorhoursID'].'">[Edit]</a> ';
			echo '<a href="php/delTotalHours.php?id='.$id.'&rowid='.$row['supervisorhoursID'].'">[Delete]</a></td>';
			echo '</tr>';
		}
		?>
		</tbody>
	</table>
  </div>
</div>
<?php
}else header('location:index.php?page=supervisors');
?>