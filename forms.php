<?php
include 'header.php';

$api_key = "f96fb2e030";
$private_key = "fc91078a29fdc1b";
$method  = "GET";
$route    = "forms/1";
$expires = strtotime("+60 mins");
$string_to_sign = sprintf("%s:%s:%s:%s", $api_key, $method, $route, $expires);
$sig = calculate_signature($string_to_sign, $private_key);

$geturl =  'http://familyadventures.com/gravityformsapi/'.$route.'/?api_key='.$api_key.'&signature='.$sig.'&expires='.$expires;
echo $geturl;
$response = file_get_contents($geturl);
$entries = json_decode($response, true);
#echo $response;

foreach($entries["response"]["fields"] as $field){
    $id = $field['id'];
    $label = $field['label'];
	echo "<br>id: ".$id.'  ';
    echo "label: ".$label.'<br>';    
    if (isset($field["choices"])&&$field["choices"]<>""){
        foreach($field["choices"] as $part){
            $subvalue = $part['value'];
            $subtext = $part['text'];

            echo "<br>id: ".$id.'  ';
            echo "value: ".$subvalue.'  ';
            echo "text: ".$subtext.'<br>';
        }
    }
    if (isset($field["inputs"])){
        foreach($field["inputs"] as $part){
            $subid = $part['id'];
            $sublabel = $part['label'];

            echo "<br>id: ".$id.'  ';
            echo "subid: ".$subid.'  ';
            echo "label: ".$sublabel.'<br>';
        }
    }

}

?>
