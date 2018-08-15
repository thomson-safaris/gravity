<?php
include_once 'header.php';

$api_key = "f96fb2e030";
$private_key = "fc91078a29fdc1b";
$method  = "GET";
$route    = "forms/1/entries";
$expires = strtotime("+60 mins");
$string_to_sign = sprintf("%s:%s:%s:%s", $api_key, $method, $route, $expires);
$sig = calculate_signature($string_to_sign, $private_key);

$geturl =  'http://familyadventures.com/gravityformsapi/'.$route.'/?api_key='.$api_key.'&signature='.$sig.'&expires='.$expires;
$response = file_get_contents($geturl);
$entries = json_decode($response, true);
echo $response;

foreach($entries["response"]["entries"] as $entry){
	$firstname = $entry['1.3'];
    $lastname = $entry['1.6'];
	$phone = $entry['3'];
	$email = $entry['7'];
    $comment = $entry['5'];	
    $Address = $entry['2.1'];
    $Address2 = $entry['2.2'];
    $City = $entry['2.3'];
    $State = $entry['2.4'];
    $Zip = $entry['2.5'];
    $Country = $entry['2.6'];
    $contactmethod = $entry['4'];
	$ip = $entry['ip'];
	$source_url = $entry['source_url'];
	$entrydate = $entry['date_created'];
	$form = 'TS Contact';

	$sql="call TS_2_Contact ('$firstname', '$lastname', '$phone', '$email', '$comment', '$Address', '$Address2', '$City', '$State', '$Zip', '$Country', '$contactmethod', '$ip', '$source_url', '$entrydate', '$form');";
	mysqli_query($con, $sql);
}

