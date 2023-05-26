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
  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="index.php">SupTrain</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php if($page=='') echo 'active'?>">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item <?php if($page=='organisations') echo 'active'?>">
            <a class="nav-link" href="index.php?page=organisations">Organisations</a>
          </li>
          <li class="nav-item <?php if($page=='supervisors') echo 'active'?>">
            <a class="nav-link" href="index.php?page=supervisors">Supervisors</a>
          </li>
          <li class="nav-item dropdown <?php if($page=='allstudents') echo 'active'?>">
            <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Students</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="index.php?page=allstudents">All students</a>
              <a class="dropdown-item" href="index.php?page=ontraining">Students on training</a>
              <a class="dropdown-item" href="index.php?page=notfinishtraining">Students not finished training</a>
              <a class="dropdown-item" href="index.php?page=studenttrainingplaces">Students training place</a>

              <a class="dropdown-item" href="index.php?page=Supervisorandtheirstudent">Students this year</a>

              <a class="dropdown-item" href="index.php?page=trainingatthemoment">Training at the moment</a>

              <a class="dropdown-item" href="index.php?page=trainingplacesatthemoment">Training places Now</a>
              <a class="dropdown-item" href="index.php?page=trainingplacesthisyear">Training places this year</a>
              <a class="dropdown-item" href="index.php?page=placesandcontactperson">Trainig places & contact person</a>
              <a class="dropdown-item" href="index.php?page=studentdoingpracticaltrainingnow">Students doing PT Now</a>
              <a class="dropdown-item" href="index.php?page=studentineachtrainingnow">Students in each Pt Now </a>
              <a class="dropdown-item" href="index.php?page=13">Students are/were in each PT this year</a>
              <a class="dropdown-item" href="index.php?page=13a">Students who ended their PT this year</a>
              <a class="dropdown-item" href="index.php?page=14">Total of students in PT this year</a>
              <a class="dropdown-item" href="index.php?page=14a">Students who ended PT this year</a>
              <a class="dropdown-item" href="index.php?page=15">Supervisors for this year & not assigned for PT</a>
              <a class="dropdown-item" href="index.php?page=16">Select student & display all PT with organization and supervisors</a>
  <a class="dropdown-item" href="index.php?page=supervisors">supervisors</a>
  <a class="dropdown-item" href="index.php?page=organisations">organisations</a>
  <a class="dropdown-item" href="index.php?page=allstudents">allstudents</a>
              <a class="dropdown-item" href="#">Something else here</a>
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
				echo 'type="button">Logout</button></a>';
			}
		 ?>
   </div>
       <form class="form-inline my-2 my-lg-0">
         <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
         <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
       </form>
     </div>
   </nav>

    <main role="main" class="container">

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
elseif($page=='studenttrainingplaces') include('php/studenttrainingplaces.php');
elseif($page=='trainingatthemoment') include('php/trainingatthemoment.php');
elseif($page=='Supervisorandtheirstudent')
include('php/Supervisorandtheirstudent.php');
elseif($page=='trainingplacesatthemoment') include('php/trainingplacesatthemoment.php');
elseif($page=='trainingplacesthisyear') include('php/trainingplacesthisyear.php');
elseif($page=='placesandcontactperson') include('php/placesandcontactperson.php');
elseif($page=='studentdoingpracticaltrainingnow') include('php/studentdoingpracticaltrainingnow.php');
elseif($page=='studentineachtrainingnow') include('php/studentineachtrainingnow.php');
elseif($page=='13') include('php/13.php');
elseif($page=='13a') include('php/13a.php');
elseif($page=='14') include('php/14.php');
elseif($page=='14a') include('php/14a.php');
elseif($page=='15') include('php/15.php');
elseif($page=='16') include('php/16.php');
elseif($page=='supervisors') include('php/supervisors.php');
elseif($page=='organisations') include('php/organisations.php');
elseif($page=='allstudents_original') include('php/allstudents_original.php');
			else echo '<h3>Application for tutoring the training.</h3>';
      //Here is the place for selecting the content to be displayed
			//based on user actions -> clicking menus etc
			if($page=='allstudents') include('php/allstudents.php');
			elseif($page=='ontraining') include('php/ontrainingnow.php');
			elseif($page=='login') include('php/loginform.php');
			elseif($page=='userinfo') include('php/userinfo.php');
			else echo '<h3>Application for tutoring the training.</h3>';
		?>
		</div>
		<div class="col-sm-2"></div>
	  </div>
    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
