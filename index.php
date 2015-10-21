<?php
/**
 * Created by PhpStorm.
 * User: olivier
 * Date: 2015-10-21
 * Time: 10:43 AM
 */
date_default_timezone_set('America/Montreal');

$json = file_get_contents('php://input');

$payload = json_decode($json, true);

$matches = array();

foreach ($payload["paragraphs"] as $id => $paragraph) {
    if (stripos( $paragraph, $payload["q"]) !== false){
        $matches[] = $id;
    }
}

$team = new stdClass();

$team->teamName = "Benoit Lamothe";
$team->matchedParagraphs = $matches;
$team->teamMembers = array();

class TeamMember implements JsonSerializable
{

    private $firstName;
    private $lastName;
    private $email;
    private $phoneNumber;
    private $educationalEstablishment;
    private $studyProgram;
    private $dateProgramEnd;
    private $inCharge;

    public function __construct($firstName, $lastName, $email, $phoneNumber, $educationalEstablishment, $studyProgram, $dateProgramEnd, $inCharge)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->educationalEstablishment = $educationalEstablishment;
        $this->studyProgram = $studyProgram;
        $this->dateProgramEnd = $dateProgramEnd;
        $this->inCharge = $inCharge;
    }

    public function jsonSerialize()
    {
        return [
            "firstName" => $this->firstName,
            "lastName" => $this->lastName,
            "email" => $this->email,
            "phoneNumber" => $this->phoneNumber,
            "educationalEstablishment" => $this->educationalEstablishment,
            "studyProgram" => $this->studyProgram,
            "dateProgramEnd" => $this->dateProgramEnd,
            "inCharge" => $this->inCharge,
        ];
    }
}

$team->teamMembers[] = new TeamMember(
    "Olivier",
    "Boucher",
    "olivier@rivusmedia.com",
    "819-960-5332",
    "Université du Québec à Trois-Rivières",
    "Bacc. Informatique",
    strtotime('2016-08-01'),
    true
);

$team->teamMembers[] = new TeamMember(
    "Jeremie",
    "Poisson",
    "jeremie.poisson@mail.mcgill.ca",
    "581-998-1337",
    "McGill University",
    "Software Engineering",
    strtotime('2017-08-01'),
    false
);

$team->teamMembers[] = new TeamMember(
    "Simon",
    "Lacoursiere",
    "simon.lacoursiere@usherbrooke.ca",
    "819-350-8903",
    "Université de Sherbrooke",
    "Bacc. Informatique",
    strtotime('2017-12-15'),
    false
);

$team->teamMembers[] = new TeamMember(
    "Jean-Philippe",
    "Menard",
    "jean-philippe.menard@usherbrooke.ca",
    "819-640-6665",
    "Université de Sherbrooke",
    "Bacc. Informatique",
    strtotime('2017-12-15'),
    false
);

header('Content-Type: application/json');
echo json_encode($team);
