<?php

//Configuration Options

//Full name is hack job to check that no one else can load their LinkedIn profile into your website

$fullnamelinkedin = "Ben Virgilio";
$password = "*&BVhajwmfnfsf";

//Website URL
$baseurl = "http://benvirgilio.com";


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
define("CONSUMER_KEY", "ty3gtkw0kkec");
define("CONSUMER_SECRET", "WAoT2DHLTLGXZf3c");

//Permission Scope Requested
$scope = "r_fullprofile+r_basicprofile+r_network+r_contactinfo";

?>
