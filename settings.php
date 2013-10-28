<?php

//Configuration Options

//Full name is hack job to check that no one else can load their LinkedIn profile into your website

$fullnamelinkedin = "FULL NAME";
$password = "PASSWORD";

//Website URL
$baseurl = "YOUR WEBSITE URL";


//Information to pull in from LinkedIn
$skills = True;
$positions = True;
$courses = True;
$summary = True;
$organizations = False;
$interests = False;
$certifications = True;
$picture = True;
$full_name = True;
$email = True;
$phone_numbers = False;


//xmlfile to store resume information
$xmlfile = "profile.xml";

//----------------------
//LinkedIn API Settings
//-----------------------
//API Keys
define("CONSUMER_KEY", "KEY");
define("CONSUMER_SECRET", "SECRET");

//Permission Scope Requested
$scope = "r_fullprofile+r_basicprofile+r_network+r_contactinfo";

?>
