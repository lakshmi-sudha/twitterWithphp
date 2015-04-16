<?php 

session_start();
require('twitter/twitteroauth.php');
require('config.php');

$connection = new TwitterOauth(CONSUMER_KEY, CONSUMER_SECRET);
$request_token = $connection->getRequesttoken(OAUTH_CALLBACK);

$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];


switch($connection->http_code){
	case 200:
		$url = $connection->getAuthorizeURL($token);
		header("Location:". $url);
		break;
	default:
		echo "OOPS ! something went wrong.Check the twitter doc for this http code:" .$connection->http_code;
		
}

?>