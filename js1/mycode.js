/**
file: 	js/mycode.js
desc:	Displays JSON from file persons.json in web page div called "persons"
**/
$(document).ready(function(){
	showPersons(); //calling a function called showPersons()
	//code for the Edit-button. the class .personID is used to get the correct data-id from button
	$("#persons").on('click','.personID',function(){
		var personID=$(this).attr('data-id'); //gets the data-id -value from clicked button
		showSelectedPerson(personID);  //call function showSelectedPerson with parameter personID
	});
});

function showPersons(){
	var textToShow='';	//variable that will gather the data to be displayed
	//read the json-file and parse through the data in it
	$.getJSON("persons.json",function(data){
		//go through the "data" (reference to json-file)
		$.each(data.persons, function(key,person){
			textToShow=textToShow+'<li id="persons2" class="list-group-item">';
			textToShow=textToShow+person.id+' ';
			textToShow=textToShow+person.firstname+' '+person.lastname+', '+person.status;
			textToShow=textToShow+'<ul class="list-group">';
			//get the children from those persons who have them
			$.each(person.children,function(key,child){
				textToShow=textToShow+'<li class="list-group-item">'+child.firstname+' '+child.lastname+'</li>';
			});
			textToShow=textToShow+'</ul>';
			//show button to "edit" the selected person
			textToShow=textToShow+'<button type="button" class="btn personID" data-id="'+person.id;
			textToShow=textToShow+'" data-toggle="modal" data-target="#myModal">Edit</button>';
			textToShow=textToShow+'</li>';
		});
		$("#persons").html(textToShow);
	});
}
function showSelectedPerson(personID){
	//For example here, you can read the same "persons.json" and display only the selected person
	//Display only if person.id==personID
	$("#mymodalbody").html('<p>You selected person with ID:'+personID+'</p>');
}
