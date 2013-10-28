<?php
require_once('settings.php');
$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
if ($_SERVER["SERVER_PORT"] != "80")
{
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
} 
else 
{
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}

//$fields = '(formatted-name,courses,skills:(skill,proficiency,years),summary,positions,associations,educations,volunteer,picture-urls::(original))';

$fields = Array();
if ($full_name == True){
	array_push($fields, "formatted-name");
}
if ($skills == True){
	array_push($fields, "skills:(skill,proficiency,years)");
}
if ($positions == True){
	array_push($fields, "positions");
}
if ($courses == True){
	array_push($fields, "courses,educations");
}
if ($summary == True){
	array_push($fields, "summary");
}
if ($organizations == True){
	array_push($fields, "volunteer,associations");
}
if ($picture == True){
	array_push($fields, "picture-urls::(original)");
}
if ($email == True){
	array_push($fields, "email-address");
}
if ($phone_numbers == True){
	array_push($fields, "phone-numbers");
}
if ($interests == True){
	array_push($fields, "interests");
}
if ($certifications == True){
	array_push($fields, "certifications");
}
$fields = implode(",",$fields);

$callback_url = $pageURL;
$oauth = new OAuth(CONSUMER_KEY, CONSUMER_SECRET);
session_start();

//Clears the authenticated sessions
if (isset($_GET['clear_session'])){
	unset($_SESSION['token']);
}
if (!isset($_GET['oauth_token']) && !isset($_SESSION['token']) && isset($_POST['linkaccount'])){
	if ($_POST['password'] == $password){
		unset($_SESSION['temp_request_token']);
		//Initiate Token Request
		$_SESSION['updatepassword'] = sha1($_POST['password']);
		
		//Get Request Token (Stage 1)
		$request_token_response = $oauth->getRequestToken('https://api.linkedin.com/uas/oauth/requestToken?scope='.$scope."&oauth_callback=".$callback_url);
		 
		if($request_token_response === FALSE) {
				throw new Exception("Failed fetching request token, response was: " . $oauth->getLastResponse());
		} else {
				$request_token = $request_token_response;
				//set session and redirect user to linkedin authorization page
				$_SESSION['temp_request_token'] = $request_token;
				session_write_close();
				$location = "https://api.linkedin.com/uas/oauth/authorize?oauth_token=".$request_token['oauth_token'];
				header ( "location: $location" );
		}
	}else{
		echo "<b>Invalid Password</b> <br />";
	}
}elseif (isset($_GET['oauth_token']) && isset($_GET['oauth_verifier']) && !isset($_SESSION['token'])){
	if (isset($_SESSION['temp_request_token'])){
		//Get Access Token (Stage 2)
		$request_token = $_SESSION['temp_request_token'];
		$oauth_verifier = $_GET['oauth_verifier'];
		$oauth->setToken($request_token['oauth_token'], $request_token['oauth_token_secret']);
		$access_token_url = 'https://api.linkedin.com/uas/oauth/accessToken';
		$access_token_response = $oauth->getAccessToken($access_token_url, "", $oauth_verifier);
		 
		if($access_token_response === FALSE) {
				throw new Exception("Failed fetching request token, response was: " . $oauth->getLastResponse());
		} else {
				$access_token = $access_token_response;
		}
		
		//Cleaning up session and reconfiguring for authorized user
		unset($_SESSION['temp_request_token']);
		$_SESSION['token'] = $access_token;
		session_write_close();

	}
}
if (isset($_SESSION['token']) && (isset($_SESSION['updatepassword']))){
	//If user is authorized, open the session token
	$access_token = $_SESSION['token'];
	$oauth->setToken($access_token['oauth_token'], $access_token['oauth_token_secret']);
	$params = array();
	$headers = array();
	$method = OAUTH_HTTP_METHOD_GET;

	$url = "http://api.linkedin.com/v1/people/~:(".$fields.")";
	$oauth->fetch($url, $params, $method, $headers);
	$xml = $oauth->getLastResponse();
	$person = simplexml_load_string($oauth->getLastResponse());
	$oauth->getLastResponse();
	$fullname = $person->{'formatted-name'};
	//If the passwords and full name matches, write the new information to the profile.xml file.
	if (($fullname == $fullnamelinkedin) && ($_SESSION['updatepassword'] == sha1($password))){
		$fh = fopen($xmlfile, 'w');
		fwrite($fh, $xml);
		fclose($fh);
		echo "Local XML File Updated <br />";
	}else{
		$person = null;
		echo "Error loading profile, names or password do not match. <br />";
	}
	echo "<a href='".$baseurl."/update.php?clear_session'>Clear Session</a>";
}else{
	echo "<form name='link' action='update.php' method='post'> <input type='hidden' name='linkaccount'>Password: <input type='password' name='password'> <br /><input type='submit' value='Link Account'></form>";
}
?>
