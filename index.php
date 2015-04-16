<?php 

require('twitter/twitteroauth.php');
require('config.php');

session_start();


if(empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])){
	header("Location:clearsession.php");	
}

$access_token = $_SESSION['access_token'];


$connection = new TwitterOauth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

$content = $connection->get('account/verify_credentials');

//echo "<pre>".print_r($content,true)."</pre>";

echo "<b>Hi </b>". $content->name. "<br/>";
echo "<b>Your Current status </b>". $content->status->text. "<br/>";
echo "<b>You posted this on </b>". $content->status->created_at. "<br/>";
echo "<b>is this you? </b>". $content->name. "<br/>";
echo "<img src=" . $content->profile_image_url. " />";

echo "<a href='clearsession.php'>Logout</a>";


?>