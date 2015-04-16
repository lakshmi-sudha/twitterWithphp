<?php

require('twitter/twitteroauth.php');
require('config.php');
session_start();
if(isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] != $_REQUEST['oauth_token']){

	$_SESSION['status'] = "old status";
	header("Location:clearsession.php"); 	
}

$connection = new TwitterOauth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

$_SESSION['access_token'] = $access_token;
unset($_SESSION['oauth_token']);
unset($_SESSION['oauth_token_secret']);

if($connection->http_code == 200){
	$_SESSION['status'] = 'verified';
	header("Location:index.php");
}
else{
	header("Location:clearsession.php");
}
 
?>