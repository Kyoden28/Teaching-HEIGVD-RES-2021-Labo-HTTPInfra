/*
* Auteurs : Christian Gomes & Johann Werkle
* Date : 30.05.2021
* 
* Etape 2 du laboratoire de RES - Utilisation du framework Express
*
*/

var express = require('express');
var dummyjson = require('dummy-json');
var app = express();

app.get('/',function(req,res){
	res.send(generateFivePeople());
});

app.listen(3000,function(){
	console.log('En ecoute sur le port 3000.');
});

function generateFivePeople(){
	
	var template = `{
  "FirstName": "{{firstName}}",
  "LastName": "{{lastName}}",
  "Age": "{{int 18 30}}",
  "Company": "{{company}}",
  "Email": "{{email}}",
  "Stree": "{{street}}",
  "City": "{{city}}",
  "Country": "{{country}}"
}`;
	var result;
	var obj = [];
	for(var i=0; i < 5; ++i){
		result = dummyjson.parse(template);
		obj.push(JSON.parse(result));
	}
	
	return obj;
	
}