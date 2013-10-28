<?php
require_once('settings.php');
$person = simplexml_load_file($xmlfile);
$fullname = $person->{'formatted-name'};

//Perform final check to make sure that the profile is correct (Full name matches full name in settings)
if ($fullname != $fullnamelinkedin){
	$person = null;
	echo "Error loading profile";
}
foreach($person->{'picture-urls'}->children() as $data){
	$photo = $data;
}
$summary = $person->summary;

$total_jobs = $person->positions["total"];
$job_title_array = array();
$job_location_array = array();
$job_start_year_array = array();
$job_current_array = array();
$job_description_array = array();
$job_end_year_array = array();

foreach($person->positions->children() as $data){
	array_push($job_title_array, $data->title);
	array_push($job_location_array, $data->company->name);
	array_push($job_start_year_array, $data->{'start-date'}->year);
	array_push($job_current_array, $data->{'is-current'});
	array_push($job_description_array, $data->{'summary'});
	array_push($job_end_year_array, $data->{'end-date'}->year);
}

$total_skills = $person->skills["total"];
$skill_array = array();
foreach($person->skills->children() as $data){
	array_push($skill_array, $data->skill->name);
}

$total_courses = $person->courses["total"];
$course_array = array();
foreach($person->courses->children() as $data){
	array_push($course_array, $data->name);
}

$total_certifications = $person->certifications["total"];
$certifications_array = array();
foreach($person->certifications->children() as $data){
	array_push($certifications_array, $data->name);
}

?>
