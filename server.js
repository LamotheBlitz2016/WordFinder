var app  = require('express')();
var http = require('http').Server(app);
var bodyParser  = require('body-parser');
var _    = require('underscore');

app.use(bodyParser.json());

app.post('/', function(req, res, next) {
	var result = { error: "Supplied parameters didn't match the specifications" };
	
	if (req.body.q != null && req.body.paragraphs != null){
		result = {
			teamName : "Benoit Lamothe",
			matchedParagraphs : findParagraphs(req.body.q, req.body.paragraphs),
			teamMembers : generateMembers()
		}
	}
	
	res.setHeader('Content-Type', 'application/json');
	res.end(JSON.stringify(result));
});

function findParagraphs(word, pars){
	return _.map(_.filter(pars, function(par) { 
			return par.indexOf(word) > -1;
		}), function(p, key){
		return key; 
	});
}

function generateMembers(){
	return [
		{
			firstName : "Simon",
    		lastName : "Lacoursiere",
    		email : "simon.lacoursiere@usherbrooke.ca",
    		phoneNumber: "819-350-8903",
    		educationalEstablishment : "Universite de Sherbrooke",
    		studyProgram: "Bacc. Informatique",
    		dateProgramEnd: new Date("2017-12-15").getTime(),
    		inCharge: false 
    	},
    	{
			firstName : "Jean-Philippe",
    		lastName : "Menard",
    		email : "jean-philippe.menard@usherbrooke.ca",
    		phoneNumber: "819-640-6665",
    		educationalEstablishment : "Universite de Sherbrooke",
    		studyProgram: "Bacc. Informatique",
    		dateProgramEnd: new Date("2017-12-15").getTime(),
    		inCharge: false 
    	},
    	{
			firstName : "Olivier",
    		lastName : "Boucher",
    		email : "olivier@rivusmedia.com",
    		phoneNumber: "819-960-5332",
    		educationalEstablishment : "Universite du Quebec a Trois-Rivieres",
    		studyProgram: "Bacc. Informatique",
    		dateProgramEnd: new Date("2016-10-1").getTime(),
    		inCharge: true 
    	},
    	{
			firstName : "Jeremie",
    		lastName : "Poisson",
    		email : "jeremie.poisson@mail.mcgill.ca",
    		phoneNumber: "581-998-1337",
    		educationalEstablishment : "McGill University",
    		studyProgram: "Bacc. Informatique",
    		dateProgramEnd: new Date("2017-10-1").getTime(),
    		inCharge: true 
    	}
	];
}

app.listen(8000);