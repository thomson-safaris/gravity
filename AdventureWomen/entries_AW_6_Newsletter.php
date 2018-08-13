<?php
include_once 'header.php';

$api_key = "bacd94b18b";
$private_key = "bfad9094405ce6d";
$method  = "GET";
$route    = "forms/6/entries";
$expires = strtotime("+60 mins");
$string_to_sign = sprintf("%s:%s:%s:%s", $api_key, $method, $route, $expires);
$sig = calculate_signature($string_to_sign, $private_key);

$geturl =  'http://adventurewomen.com/gravityformsapi/'.$route.'/?api_key='.$api_key.'&signature='.$sig.'&expires='.$expires;
echo $geturl;
$response = file_get_contents($geturl);
$entries = json_decode($response, true);

foreach($entries["response"]["entries"] as $entry){
	$first = $entry['1'];
	$last = $entry['4'];	
	$email = $entry['3'];	
	$phone = $entry['9'];
	$ip = $entry['ip'];
	$source_url = $entry['source_url'];
	$self_source = $entry['7'];
	$entrydate = $entry['date_created'];
	$form = 'AW Newsletter';

	$sql="call AW_6_Newsletter ('$first', '$last', '$email', '$phone', '$ip', '$source_url', '$self_source',  '$entrydate', '$form');";
	mysqli_query($con, $sql);
}

/**/