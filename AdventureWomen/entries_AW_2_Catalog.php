<?php
include_once 'header.php';

$api_key = "bacd94b18b";
$private_key = "bfad9094405ce6d";
$method  = "GET";
$route    = "forms/2/entries";
$expires = strtotime("+60 mins");
$string_to_sign = sprintf("%s:%s:%s:%s", $api_key, $method, $route, $expires);
$sig = calculate_signature($string_to_sign, $private_key);

$geturl =  'http://adventurewomen.com/gravityformsapi/'.$route.'/?api_key='.$api_key.'&signature='.$sig.'&expires='.$expires;
echo $geturl;
$response = file_get_contents($geturl);
$entries = json_decode($response, true);

foreach($entries["response"]["entries"] as $entry){
	$first = $entry['1'];
	$last = $entry['2'];	
	$email = $entry['7'];	
	$phone = $entry['11'];
	$address1 = $entry['3.1'];
	$address2 = $entry['3.2'];
	$city = $entry['3.3'];
	$state = $entry['3.4'];
	$zip = $entry['3.5'];
	$country = $entry['3.6'];
	$comments = $entry['6'];
	$interest = $entry['4'];
	$ip = $entry['ip'];
	$source_url = $entry['source_url'];
	$self_source = $entry['9'];
	$entrydate = $entry['date_created'];
	$form = 'AW Catalog';

	$sql="call AW_2_Catalog ('$first', '$last', '$phone', '$email', '$address1', '$address2', '$city', '$state', '$zip', '$country', '$comments', '$interest', '$ip', '$source_url', '$self_source', '$entrydate', '$form');";
	mysqli_query($con, $sql);
}

/**/