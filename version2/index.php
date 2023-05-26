
<?php
/*
	file:	index.php
	desc:	This is the main User Interface for the application.
*/
//read the variable page from GET-request if it is there, otherwise page is empty
if(isset($_GET['page'])) $page=$_GET['page'];else $page='';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SupTrain V2</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
	   <link href="css/signin.css" rel="stylesheet">
     <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="index.html">SupTrain</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse"     data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" id="organizations">Organisations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=supervisors" id="supervisors" >Supervisors</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Students</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="" id="allstudents">All students</a>
              <a class="dropdown-item" href="#">In training now</a>
              <a class="dropdown-item" href="#">In training this year</a>
            </div>
          </li>
        </ul>
        <div>

    			<span id="user" style="color:white"></span><!--Name of logged in user-->

    			<span id="loginplace">
    				<button class="btn btn-outline-success my-2 my-sm-0" type="button"
    				 data-toggle="modal" data-target="#loginfrm">Login</button></a>
    			</span>
    			<span id="logoutplace">
    				<button id="logoutbtn" class="btn btn-outline-success my-2 my-sm-0" type="button">Logout</button></a>
    			</span>
    		</div>
		    &nbsp;
    		<form id="frmFilter" class="form-inline my-2 my-lg-0">
    		    <input id="myfilter" class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
    		</form>
      </div>
    </nav>

        <main role="main" class="container" >

    <div class="starter-template">
        <h4>SupTrain V2</h4>
		<div id="maininfo">
			<a href="#" id="showall">Show all</a>
		</div>
        <div id="maincontent">
			<h3>Welcome to SupTrain</h3>
			<p>You are using SupTrain application version 2</p>
		   </div>
    </div>
      <video autoplay muted loop id="myVideo">
    <source src="media/video.mp4" type="video/mp4">
    </video>
      </main><!-- /.container -->


<!--MODAL PARTS-->
	<!--loginfrm starts-->
	<div id="loginfrm" class="modal fade" role="dialog">
	 <div class="modal-dialog">
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
			<h3 class="modal-title">Login</h3>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
		 <form class="form-signin" id="frmlogin">
		  Email: <input class="form-control" type="email" id="email"   placeholder="Email" required >
		  Password: <input class="form-control" type="password" id="password"  placeholder="Password" required >
		  <input class="btn btn-lg btn-primary btn-block" type="submit" id="loginbtn" value="Login" >
		 </form>
		 <div id="logininfo"></div><!--Used to display messages, fail etc-->
	    </div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	  </div>
	 </div>
	</div>
	<!--loginfrm ends-->

	<!--showStudent starts-->
	<div class="modal" id="showStudent">
	 <div class="modal-dialog">
      <div class="modal-content">
       <!-- Modal Header -->
       <div class="modal-header">
        <h4 class="modal-title" id="modStudentID"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
       <!-- Modal body -->


       <div class="modal-body">
		<h2>Studentinfo</h2>
		<div id="modStudentText"></div>
		<div id="modTraining"></div>
		<div id="completed"></div>
       </div>
       <!-- Modal footer -->
       <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
       </div>
      </div>
	 </div>
	</div>
	<!--showStudent ends-->
	<!--addTraining starts here-->
	<div class="modal" id="addTraining">
	 <div class="modal-dialog">
      <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add training</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body" >
        <form class="form-signin" id="frmTraining">
			<input type="hidden" id="frmTrainingStudID" />
			<div class="form-group">
			  <label for="start">Starting date:</label>
			  <input type="date" class="form-control" id="start" />
			</div>
			<div class="form-group">
			  <label for="end">Ending date:</label>
			  <input type="date" class="form-control" id="end" />
			</div>
			<div class="form-group">
			  <label for="place">Select place:</label>
			  <select class="form-control" id="place">
			  </select>
			</div>
			<div class="form-group">
			  <label for="supervisor">Select supervisor:</label>
			  <select class="form-control" id="supervisor">
			  </select>
			</div>
			<div class="form-group">
			 <label for="hours">Hours for supervising:</label>
			 <input type="number" min="1" max="100" class="form-control" id="hours" />
			</div>
			<button type="submit" class="btn btn-primary">Add training</button>
		</form>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      </div>
     </div>
	</div>

	<!--addTraining ends-->
	<!--showInfo starts here-->
	<div class="modal" id="showInfo">
	 <div class="modal-dialog">
      <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Info</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body" id="infobody">
	  </div>
	  </div>
	 </div>
	</div>
	<!--showInfo ends here-->
<!--END OF MODALS-->

<div class="col-sm-8">
		<?php
			//Here is the place for selecting the content to be displayed
			//based on user actions -> clicking menus etc
			if($page=='allstudents') include('php/allstudents.php');
			elseif($page=='ontraining') include('php/ontrainingnow.php');
			elseif($page=='login') include('php/loginform.php');
			elseif($page=='userinfo') include('php/userinfo.php');
			
			elseif($page=='newSupervisor') include('php/newSupervisor.php');
			elseif($page=='supervisorinfo') include('php/supervisorinfo.php');
			elseif($page=='editSupervisor') include('php/editSupervisor.php');
      elseif($page=='1newstudent') include('php/1newstudent.php');
			elseif($page=='1studentinfo') include('php/1studentinfo.php');
			elseif($page=='1editstudent') include('php/1editstudent.php');
			else echo '<h3>Application for tutoring the training.</h3>';
		?>
		</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/myApp.js"></script><!--myApp.js is the main UI programming part-->

  </body>
</html>
