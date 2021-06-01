$(function() {
	
	console.log("Loading generate people");
	
	function loadPeople() {
		$.getJSON( "/api/people/", function ( people ) {
			console.log(people);
			var person1 = people[0].FirstName + " " + people[0].LastName ;
			var text1 = "Mon âge est de " + people[0].Age + " ans. " + "Mon mail est : " + people[0].Email;
			
			$("#nom1").text(person1);
			$("#p1").text(text1);
			
		});
	};
	
	loadPeople();
	setInterval( loadPeople, 5000);
	
});