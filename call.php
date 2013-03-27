<?php
include "./config.php";
include "./oauth_config.php";
include_once "oauth-php/library/OAuthServer.php";
include_once "oauth-php/library/OAuthStore.php";
include_once "oauth-php/library/OAuthRequester.php";

// 取得 oauth store 和 oauth server 对象
echo "\nline 9\n";
$request_uri = $hostOptions["prefix"].'api.php';
$store = OAuthStore::instance('MySQL', $dbOptions); 
$server = new OAuthServer($request_uri);
echo "\nrun to line 12\n";
// The request uri being called.
echo "request_uri:\n";
var_dump($request_uri);
echo "\nend\n";
// Parameters, appended to the request depending on the request method.
// Will become the POST body or the GET query string.
$params = array(
           'method' => 'ping'
     );
// Obtain a request object for the request we want to make
$req = new OAuthRequester($request_uri, 'POST', $params);

// Sign the request, perform a curl request and return the results, throws OAuthException exception on an error
$result = $req->doRequest($_user_id);
echo $result["body"];
// $result is an array of the form: array ('code'=>int, 'headers'=>array(), 'body'=>string)
?>
