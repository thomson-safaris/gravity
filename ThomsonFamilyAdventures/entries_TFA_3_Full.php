<?php
include_once 'header.php';

$api_key = "f96fb2e030";
$private_key = "fc91078a29fdc1b";
$method  = "GET";
$route    = "forms/3/entries";
$expires = strtotime("+60 mins");
$string_to_sign = sprintf("%s:%s:%s:%s", $api_key, $method, $route, $expires);
$sig = calculate_signature($string_to_sign, $private_key);

$geturl =  'http://familyadventures.com/gravityformsapi/'.$route.'/?api_key='.$api_key.'&signature='.$sig.'&expires='.$expires;
#echo $geturl;
$response = file_get_contents($geturl);
$entries = json_decode($response, true);

foreach($entries["response"]["entries"] as $entry){
    $firstname = $entry['2.3'];
    $lastname = $entry['2.6'];
	$phone = $entry['5'];
	$email = $entry['3'];
    $comment = $entry['10'];	
    $Address = $entry['4.1'];
    $Address2 = $entry['4.2'];
    $City = $entry['4.3'];
    $State = $entry['4.4'];
    $Zip = $entry['4.5'];
    $Country = $entry['4.6'];
    $contactmethod = $entry['6'];
    $TripInterest = $entry['1'];
    $planning = $entry['7'];
    $selfsource = $entry['8'];
    $travelmonth = $entry['16'];
    $travelyear = $entry['17'];
    $download = $entry['14'];
	$ip = $entry['ip'];
	$source_url = $entry['source_url'];
	$entrydate = $entry['date_created'];
    $form = 'TFA Full';

	$sql="call TFA_3_Full ('$firstname', '$lastname', '$phone', '$email', '$comment', '$Address', '$Address2', '$City', '$State', '$Zip', '$Country', '$contactmethod', '$TripInterest', '$planning', '$selfsource', '$travelmonth', '$travelyear', '$download', '$ip', '$source_url', '$entrydate', '$form');";
    mysqli_query($con, $sql);
    echo $sql;
}

