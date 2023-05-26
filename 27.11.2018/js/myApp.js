/*
	file:	js/myApp.js
	desc:	This is the Javasript file that gets the data (JSON) from webserver and
			displays it in index.html -> id:s in index.html
*/
//the address to the webservers PHP-folder used in AJAX-calls
var path="http://localhost/Bit17/suptrain_v2/php/"; 
$(document).ready(function(){
	$("#showall").hide();
	isLoggedIn();	//calling a function to check if user is logged in
	$("#frmlogin").submit(function(){
		//When button in form frmlogin is clicked->submit() event happens
		login(); //call login()-function
		return false; //prevent page from reloading (form stays visible)
	});
	$("#logoutbtn").click(function(){
		logout(); //when logoutbtn is clicked, call function logout()
	});
	$("#allstudents").click(function(){
		var search='';	//these two variables are passed as parameter
		var group='';	//to showStudents(), but they are empty in this
		showStudents(search,group); //call. Displays all the students.
	});
	$("#myfilter").keyup(function(){
		var search=$("#myfilter").val(); //take value from search-box
		var group='';
		$("#showall").show();
		showStudents(search,group);
	});
	$("#maincontent").on('click','.groupname',function(){
		var search='';
		var group=$(this).attr('data-groupid'); //value from class="groupname"->data-groupid
		$("#showall").show();
		showStudents(search,group);
	})
	$("#showall").click(function(){
		var search='';	//these two variables are passed as parameter
		var group='';	//to showStudents(), but they are empty in this
		$("#showall").hide();
		showStudents(search,group);
	});
});
function showStudents(search,group){
	var target=path+'students.php?search='+search+'&group='+group;
	var txtData='<div class="well"><h3>Students</h3></div>';
	if(search!='' || group!=''){
		$("#showall").show();
	}else $("#showall").hide();
	txtData=txtData+'<div class="card-columns">'; //used to create html to display
	$.get(target,function(data){
		if(data!='Fail'){
			//data is coming, parse through the data in JSON
			var result=$.parseJSON(data); //creates array result from data
			$.each(result.students,function(key,student){
			 txtData=txtData+'<div class="card">';
			 txtData=txtData+'<div class="card-body text-center">';
			 txtData=txtData+'<h5 class="card-title">'+student.studentID+'</h5>'
			 txtData=txtData+'<p class="card-text">'+student.firstname+' '+student.lastname+'</p>';
			 txtData=txtData+'<p class="card-text groupname" data-groupid="'+student.groupname+'">'+student.groupname+'</p>';
			 if(student.practicaltrainingdone==1){
			  txtData=txtData+'<p class="card-text"><img src="images/ok.png" class="img-responsive" width="20px" />Finished training!</p>';
			 }else{
			  txtData=txtData+'<p class="card-text"><img src="images/cancel.png" class="img-responsive" width="20px" />Training not finished!</p>';
			 }
			 txtData=txtData+'</div>'; //ends "card-body"
			 txtData=txtData+'</div>'; //ends "card"
			});
			txtData=txtData+'</div>'; //ends the "card-columns" div
			$("#maincontent").html(txtData);
		}else $("#maincontent").html('<p class="alert alert-info">Login first!</p>');
	});
}
function logout(){
	var targed=path+'logout.php';
	$.get(targed,function(data){
		var result=JSON.parse(data,function(key,value){
			return value;  //gets the status, user from JSON
		})
		$("#maininfo").html('<h3 class="alert alert-info">'+result.status+'</h3>');
		$("#user").html('');	//removes username from navbar
		$("#loginplace").show(); //shows login-button in navbar
		$("#logoutplace").hide();//hides logout-button in navbar
		$("#maincontent").hide();//hides maincontent from page
		setTimeout(function(){
			$("#maininfo").html(''); //clears text from maininfo
			$("#maincontent").html(''); //clears maincontent
			$("#maincontent").show(); //shows maincontent again
			location.reload();
		},2000);
		
	});
}
function login(){
	var targed=path+'login.php';
	var email=$("#email").val(); //value from the formfield email
	var password=$("#password").val();
	$.post(targed,{
		inputEmail:email,
		inputPassword:password
	},function(data){
		var result=JSON.parse(data,function(key,value){
			return value;  //gets the status, user from JSON
		})
		if(result.status=='ok'){
			$("#user").html(result.user);
			$("#logininfo").html('<p class="alert alert-success">Login ok!</p>');			
			$("#loginplace").hide(); //hides Login-button (span id="loginplace")
			$("#logoutplace").show();//shows Logout-button
			$("#maincontent").html('<h3>Welcome to SupTrain</h3>');
			setTimeout(function(){
				$("#loginfrm").modal('hide'); //closes modal form
				$("#email").val(''); //clear email-field
				$("#password").val(''); //clear password-field
				$("#logininfo").html('');
			},2000); //runs the parts inside this block after 2 seconds
			
		}else{
			$("#logininfo").html('<p class="alert alert-danger">Login failed!</p>');
			$("#email").val(''); //clear email-field
			$("#password").val(''); //clear password-field
		}
	});
}
function isLoggedIn(){
	var target=path+'session.php';
	$.get(target,function(data){
		var result=JSON.parse(data,function(key,value){
			return value;  //gets the status from JSON
		})
		if(result.status=='ok'){
			$("#loginplace").hide(); //hides Login-button (span id="loginplace")
			$("#logoutplace").show();//displays Logout-button (span id="logoutplace")
		}else{
			$("#loginplace").show(); //hides Login-button (span id="loginplace")
			$("#logoutplace").hide();//displays Logout-button (span id="logoutplace")
		};
	});
}