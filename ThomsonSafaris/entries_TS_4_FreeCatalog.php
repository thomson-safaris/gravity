<?php
include_once 'header.php';

$api_key = "d8bc87843a";
$private_key = "f333840f6f8d290";
$method  = "GET";
$route    = "forms/4/entries";
$expires = strtotime("+60 mins");
$string_to_sign = sprintf("%s:%s:%s:%s", $api_key, $method, $route, $expires);
$sig = calculate_signature($string_to_sign, $private_key);

$geturl =  'http://thomsonsafaris.com/gravityformsapi/'.$route.'/?api_key='.$api_key.'&signature='.$sig.'&expires='.$expires;
//echo $geturl;
$response = file_get_contents($geturl);
$entries = json_decode($response, true);

foreach($entries["response"]["entries"] as $entry){
	$first = $entry['4'];
	$last = $entry['5'];
	$phone = $entry['13'];	
	$email = $entry['6'];	
	$address1 = $entry['12.1'];
	$address2 = $entry['12.2'];
	$city = $entry['12.3'];
	$state = $entry['12.4'];
	$zip = $entry['12.5'];
	$country = $entry['12.6'];
	$interest = $entry['9.1'].' | '.$entry['9.2'];
	$ip = $entry['ip'];
	$source_url = $entry['source_url'];
	$travel_date = $entry['14'];
	$my_group = $entry['15'];
	$questions = $entry['16'];
	$friend = $entry['7'];
	$catalog_type = $entry['18'];
	$entrydate = $entry['date_created'];
	$form = 'TS Free Catalog';

	$sql="call TS_4_FreeCatalog ('$first', '$last', '$phone', '$email', '$address1', '$address2', '$city', '$state', '$zip', '$country', '$interest', '$ip', '$source_url', '$travel_date', '$my_group', '$questions', '$friend', '$catalog_type', '$entrydate', '$form');";
	mysqli_query($con, $sql);
}




/*
echo "<table><tr><tr> <th>First</th>
<th>Last</th>
<th>Phone</th>
<th>Email</th>
<th>Address1</th>
<th>Address2</th>
<th>City</th>
<th>State</th>
<th>Zip</th>
<th>Interest</th>
<th>IP</th>
<th>Source URL</th>
<th>Travel Date</th>
<th>My Group</th>
<th>Questions</th>
<th>Refered By Friend</th>
<th>Catalog Type</th></tr>";
foreach($entries["response"]["entries"] as $entry){
	$first = $entry['4'];
	$last = $entry['5'];
	$phone = $entry['13'];	
	$email = $entry['6'];	
	$address1 = $entry['12.1'];
	$address2 = $entry['12.2'];
	$city = $entry['12.3'];
	$state = $entry['12.4'];
	$zip = $entry['12.5'];
	$interest = $entry['9.1'].' | '.$entry['9.2'];
	$ip = $entry['ip'];
	$source_url = $entry['source_url'];
	$travel_date = $entry['14'];
	$my_group = $entry['15'];
	$questions = $entry['16'];
	$friend = $entry['7'];
	$catalog_type = $entry['18'];

	echo "<td>$first</td>
	<td>$last</td>
    <td>$phone</td>
	<td>$email</td>
	<td>$address1</td>
	<td>$address2</td>
	<td>$city</td>
	<td>$state</td>
	<td>$zip</td>
	<td>$interest</td>
	<td>$ip</td>
	<td>$source_url</td>
	<td>$travel_date</td>
	<td>$my_group</td>
	<td>$questions</td>
	<td>$friend</td>
	<td>$catalog_type</td></tr>";
}echo "</table>";
*/