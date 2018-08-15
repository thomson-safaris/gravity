<?php
include_once 'header.php';

$api_key = "d8bc87843a";
$private_key = "f333840f6f8d290";
$method  = "GET";
$route    = "forms/2/entries";
$expires = strtotime("+60 mins");
$string_to_sign = sprintf("%s:%s:%s:%s", $api_key, $method, $route, $expires);
$sig = calculate_signature($string_to_sign, $private_key);

$geturl =  'http://thomsonsafaris.com/gravityformsapi/'.$route.'/?api_key='.$api_key.'&signature='.$sig.'&expires='.$expires;
$response = file_get_contents($geturl);
$entries = json_decode($response, true);
echo $response;

foreach($entries["response"]["entries"] as $entry){
	$firstname = $entry['1'];
	$lastname = $entry['2'];
	$email = $entry['5'];
	$comment = $entry['4'];	
	$ip = $entry['ip'];
	$source_url = $entry['source_url'];
	$entrydate = $entry['date_created'];
	$form = 'TS Contact';

	$sql="call TS_2_Contact ('$firstname', '$lastname', '$email', '$comment', '$ip', '$source_url', '$entrydate', '$form');";
	mysqli_query($con, $sql);
}

