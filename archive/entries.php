<?php
include 'header.php';

$api_key = "d8bc87843a";
$private_key = "f333840f6f8d290";
$method  = "GET";
$route    = "forms/6/entries";
$expires = strtotime("+60 mins");
$string_to_sign = sprintf("%s:%s:%s:%s", $api_key, $method, $route, $expires);
$sig = calculate_signature($string_to_sign, $private_key);

$geturl =  'https://thomsonsafaris.com/gravityformsapi/'.$route.'/?api_key='.$api_key.'&signature='.$sig.'&expires='.$expires;
echo $geturl;
$response = file_get_contents($geturl);
$entries = json_decode($response, true);

foreach($entries["response"]["entries"] as $entry){
	$first = $entry['4'];
	$last = $entry['5'];
	$phone = $entry['13'];	
	$email = $entry['6'];	

	echo "<br>First: ".$first.'<br>';
    echo "Last: ".$last.'<br>';
    echo "Phone: ".$phone.'<br>';
    echo "Email: ".$email.'<br>';
}

?>
