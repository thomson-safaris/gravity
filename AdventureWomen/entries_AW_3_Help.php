<?php
include_once 'header.php';

$api_key = "bacd94b18b";
$private_key = "bfad9094405ce6d";
$method  = "GET";
$route    = "forms/3/entries";
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
	$email = $entry['3'];	
	$phone = $entry['5'];
	$interest = $entry['19'];	
    $comments = $entry['9'].' Activity Level: '.$entry['22']. 'About Me: '.$entry['17'].' My Perfect Adventure: '.$entry['18'];
	$ip = $entry['ip'];
	$source_url = $entry['source_url'];
	$self_source = $entry['12'];
	$entrydate = $entry['date_created'];
    $traveldate = $entry['20'];
    $form = 'AW Help Deciding';

	$sql="call AW_3_Help ('$first', '$last', '$phone', '$email', '$interest', '$comments', '$ip', '$source_url', '$self_source', '$entrydate', '$form');";
	mysqli_query($con, $sql);
}

/**/