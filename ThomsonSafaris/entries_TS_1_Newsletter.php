<?php
include_once 'header.php';

$api_key = "d8bc87843a";
$private_key = "f333840f6f8d290";
$method  = "GET";
$route    = "forms/1/entries";
$expires = strtotime("+60 mins");
$string_to_sign = sprintf("%s:%s:%s:%s", $api_key, $method, $route, $expires);
$sig = calculate_signature($string_to_sign, $private_key);

$geturl =  'http://thomsonsafaris.com/gravityformsapi/'.$route.'/?api_key='.$api_key.'&signature='.$sig.'&expires='.$expires;
$response = file_get_contents($geturl);
$entries = json_decode($response, true);

foreach($entries["response"]["entries"] as $entry){
	$fullname = $entry['1'];
	$email = $entry['2'];	
	$ip = $entry['ip'];
	$source_url = $entry['source_url'];
	$entrydate = $entry['date_created'];
	$form = 'TS Newsletter';

	$sql="call TS_1_Newsletter ('$fullname', '$email', '$ip', '$source_url', '$entrydate', '$form');";
	mysqli_query($con, $sql);
}

