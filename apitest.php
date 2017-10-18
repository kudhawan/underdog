<?php
//$output = shell_exec('curl -X GET https://jsonodds.com/api/results/getbyeventid/{f5002ffd-d85a-4e1f-9bae-7270c8631d20} -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');



//$output = shell_exec('curl -X GET https://jsonodds.com/api/results/{string: sport} -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');
//$output = shell_exec('curl -X GET https://jsonodds.com/api/odds/{c4c66b95-a826-49a9-ac1f-c6fd9ea84c1a} -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');

//$output = shell_exec('curl -X GET https://jsonodds.com/api/test/odds -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');

//$output = shell_exec('curl -X GET https://jsonodds.com/api/results/nfl -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');
$output = shell_exec('curl -X GET https://jsonodds.com/api/results/{8f1885f1-f988-43d2-b52d-facacb383bed} -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');
	
	
//$output = shell_exec('curl -X GET https://jsonodds.com/api/leagues/nfl -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');

//$output = shell_exec('curl -X GET https://jsonodds.com/api/regions -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');
//$output = shell_exec('curl -X GET https://jsonodds.com/api/odds/byleagues -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');
 
//$output = shell_exec('curl -X GET https://jsonodds.com/api/odds/nfl -H "JsonOdds-API-Key: f97bb413-6a06-40ee-b307-a592b2cbbac9"');
echo "<pre>".$output."</pre>";

$testarray=json_decode($output);
//print_r($testarray);



/*$api_key = "f97bb413-6a06-40ee-b307-a592b2cbbac9";
$ch = curl_init("https://jsonodds.com/api/odds?source=3");
curl_setopt_array($ch, array(
    CURLOPT_HTTPHEADER => array("JsonOdds-API-Key: " . $api_key),
    CURLOPT_RETURNTRANSFER => true));
$response = curl_exec($ch);
var_dump(curl_getinfo($ch))	*/		
?>

