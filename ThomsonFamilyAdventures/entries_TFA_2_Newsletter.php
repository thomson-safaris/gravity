<?php
include_once 'header.php';

$api_key = "f96fb2e030";
$private_key = "fc91078a29fdc1b";
$method  = "GET";
$route    = "forms/2/entries";
$expires = strtotime("+60 mins");
$string_to_sign = sprintf("%s:%s:%s:%s", $api_key, $method, $route, $expires);
$sig = calculate_signature($string_to_sign, $private_key);

$geturl =  'http://familyadventures.com/gravityformsapi/'.$route.'/?api_key='.$api_key.'&signature='.$sig.'&expires='.$expires;
$response = file_get_contents($geturl);
$entries = json_decode($response, true);

foreach($entries["response"]["entries"] as $entry){
	$email = $entry['1'];
	$ip = $entry['ip'];
	$source_url = $entry['source_url'];
	$entrydate = $entry['date_created'];
	$form = 'TFA Newsletter';

	$sql="call TFA_2_Newsletter('$email', '$ip', '$source_url', '$entrydate', '$form');";
    mysqli_query($con, $sql);
    #echo $sql;
}

