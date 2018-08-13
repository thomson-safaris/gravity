<?php
include_once 'header.php';

$api_key = "20fd969cae";
$private_key = "b9277b645fc07ca";
$method  = "GET";
$route    = "forms/2/entries";
$expires = strtotime("+60 mins");
$string_to_sign = sprintf("%s:%s:%s:%s", $api_key, $method, $route, $expires);
$sig = calculate_signature($string_to_sign, $private_key);

$geturl =  'http://experience.thomsonsafaris.com/gravityformsapi/'.$route.'/?api_key='.$api_key.'&signature='.$sig.'&expires='.$expires;
echo $geturl;
$response = file_get_contents($geturl);
$entries = json_decode($response, true);

foreach($entries["response"]["entries"] as $entry){
	$first = $entry['4'];
	$last = $entry['5'];	
	$email = $entry['2'];	
	$phone = $entry['26'];
	$address1 = $entry['17'];
	$address2 = $entry['19'];
	$city = $entry['20'];
	$state = $entry['21'];
	$zip = $entry['22'];
	$country = $entry['23'];
	$comments = $entry['3'];
	$ip = $entry['ip'];
	$source_url = $entry['source_url'];
	$self_source = $entry['28'];
	$entrydate = $entry['date_created'];
	$form = 'TS Landing Page';

	$sql="call TSL_1_Landing ('$first', '$last', '$email', '$address1', '$address2', '$city', '$state', '$zip', '$country', '$comments', '$ip', '$source_url', '$self_source',  '$entrydate', '$form');";
	mysqli_query($con, $sql);
	echo $sql;
}

/**/