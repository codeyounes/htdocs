<?php
/*
	file:	php/supervisorinfo.php
	desc:	Shows info about the selected supervisor.
			Form for adding year+hours for that year
*/
if(isset($_GET['id'])) $id=$_GET['id']; 
else header('location:index.php?page=organization');
if(isset($_GET['add'])) $add=$_GET['add'];else $add=''; 
if(isset($_GET['edit'])) $edit=$_GET['edit'];else $edit=''; 
include('dbConnect.php');
$sql="SELECT * FROM organization WHERE organizationID=$id";
$result=$conn->query($sql);
if($result->num_rows > 0){
	//organization found
	$row=$result->fetch_assoc(); //results into a row
?>
<h1 class="h3 mb-3 font-weight-normal">Organizationinfo</h1>
<div class="card d-inline-flex">
  <div class="text-center">
	
  </div>
  <div class="card-body">
    <h4 class="card-title"><?php echo $row['name'].' '.$row['address'].' <a href="index.php?page=editOrganization&id='.$id.'">[Edit]</a></h4>';?>
    <p class="card-text">Contactperson: <?php echo  $row['contactperson'].' '.$row['email'].', Phone: '.$row['phone']?></p>
	
	
	
		
		
  </div>
</div>
<?php
}else header('location:index.php?page=organization');
?>