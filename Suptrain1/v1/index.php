<?php
/*
	file:	index.php
	desc:	This is the main User Interface for the application.
*/
//read the variable page from GET-request if it is there, otherwise page is empty
if(isset($_GET['page'])) $page=$_GET['page'];else $page='';
session_start(); //Uses session to check if user is logged in
if(!isset($_SESSION['user'])) $page='login'; //if not logged in, page is 'login'
header('Cache-control:no-cache, no-store, must-revalidate');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--link rel="icon" href="favicon.ico"-->

    <title>SupTrain Application</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
	<link href="css/signin.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
  </head>

  <body>

   <!--<video autoplay muted loop id="myVideo">
  <source src="media/video.mp4" type="video/mp4">
  </video>-->


    <nav class="navbar navbar-expand-md navbar bg fixed-top" id="navigation">
      <a href="https://www.lapinamk.fi/en"><img src="images/1.jpg" alt="pic" width="240px" height="70px"></a>
      <a style="color:White; font-size: 25px;" class="navbar-brand" href="index.php" id="aaronsnav"><h2>SupTrain</h2></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto" id="navbar">
          <li class="nav-item <?php if($page=='') echo 'active'?>">
            <a style="color:White; font-size: 20px;" class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item <?php if($page=='organisations') echo 'active'?>">
            <a style="color:White; font-size: 20px;" class="nav-link" href="index.php?page=organisations">Organisations</a>
          </li>
          <li class="nav-item <?php if($page=='supervisors') echo 'active'?>">
            <a style="color:White; font-size: 20px;" class="nav-link" href="index.php?page=supervisors">Supervisors</a>
          </li>
          <li class="nav-item dropdown <?php if($page=='allstudents') echo 'active'?>">
            <a style="color:White; font-size: 20px;" class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Students</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="index.php?page=allstudents">All students</a>
              <a class="dropdown-item" href="index.php?page=ontraining">Students on training</a>
              <a class="dropdown-item" href="index.php?page=notfinishtraining">Students not finished training</a>
              <a class="dropdown-item" href="index.php?page=finishedtraining">Students finished training</a>
              <a class="dropdown-item" href="index.php?page=trainingatthemoment">Students in training this year</a>
              <a class="dropdown-item" href="index.php?page=trainingplacesthisyear">Students in training & selected organization at the moment</a>



            </div>
          </li>
        </ul>

        <div>
		 <?php
			//displays user's name, if logged in
			if(isset($_SESSION['user'])){
				echo '<a href="index.php?page=userinfo">';
				echo '<span style="color:white">'.$_SESSION['user'].'</span> ';
				echo '</a>';
				echo '<a href="php/logout.php"><button class="btn btn-outline-success my-2 my-sm-0" ';
				echo 'type="button" id="button">Logout</button></a>';
			}
		 ?>
		</div>
    &nbsp;
		<form id="frmFilter" class="form-inline my-2 my-lg-0">
		 <input id="myfilter" class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
		</form>
      </div>
    </nav>

    <main role="main" class="container" style="margin-top: 50px;
    position: absolute;
    top: 0px;left: 15vw;">

      <div class="starter-template">
        <h4>SupTrain Version 1.0</h1>
      </div>
	  <div class="row">
		<div class="col-sm-2">
			<h5>Info</h5>
			<?php
				include('php/NrInTraining.php');
			?>
		</div>
		<div class="col-sm-8">
		<?php
			//Here is the place for selecting the content to be displayed
			//based on user actions -> clicking menus etc
			if($page=='allstudents') include('php/allstudents.php');
			elseif($page=='ontraining') include('php/ontrainingnow.php');
      elseif($page=='notfinishtraining') include('php/notfinishtraining.php');
      elseif($page=='finishedtraining') include('php/finishedtraining.php');
      elseif($page=='trainingplacesthisyear') include('php/trainingplacesthisyear.php');
      elseif($page=='trainingatthemoment') include('php/trainingatthemoment.php');
      elseif($page=='studenttrainingplaces') include('php/studenttrainingplaces.php');
			elseif($page=='login') include('php/loginform.php');
			elseif($page=='userinfo') include('php/userinfo.php');
			elseif($page=='supervisors') include('php/supervisors.php');
			elseif($page=='newSupervisor') include('php/newSupervisor.php');
			elseif($page=='supervisorinfo') include('php/supervisorinfo.php');
			elseif($page=='editSupervisor') include('php/editSupervisor.php');
			elseif($page=='organisations') include('php/organisations.php');
			elseif($page=='newOrganisation') include('php/newOrganisation.php');
			elseif($page=='insertStudent') include('php/insertStudent.php');
			elseif($page=='students') include('php/students.php');
			elseif($page=='newStudent') include('php/newStudent.php');
			elseif($page=='deletestudent') include('php/deletestudent.php');
			elseif($page=='deletesupervisor') include('php/deletesupervisor.php');
			elseif($page=='studentinfo') include('php/studentinfo.php');
      elseif($page=='addstudenttraining') include('php/addstudenttraining.php');
			elseif($page=='editStudent') include('php/editStudent.php');
			elseif($page=='updateStudent') include('php/updateStudent.php');
			elseif($page=='deleteorganization') include('php/deleteorganization.php');
			elseif($page=='organizationinfo') include('php/organizationinfo.php');
			elseif($page=='editOrganization') include('php/editOrganization.php');
      	elseif($page=='edittraining') include('php/edittraining.php');
			elseif($page=='updateOrganization') include('php/updateOrganization.php');
			else echo '<h3>Application for tutoring the training.</h3>';
		?>
		</div>

	  </div>

    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/deletestudent.js"></script>
    <script src="js/search.js"></script>


  </body>
</html>
