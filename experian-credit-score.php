<?php


// Getting the endpoints of webservice
$soapUrl = "https://creditservices-demo.experian.com.au/nextgen-aus-pds/cxf/reporting-WS";

// Loading XML file and assigning to a string variable

/*  For Experian credit score integration,experian team will forward TEST ENV PROJECT document,if not provided kindly ask for it.Once you have document follow below steps.
Step 1: Download & Install SOAP UI for testing. (Soap UI is tool for soap webservice testing).
Step 2: Launch SOAP UI & Click on file button present at upper left navigation bar.
Step 3: Click on import project and select import project sent by experian team.
Step 4: Explore your project by clicking on + symbol here you will see all request methods.
Step 5: For Credit Score request select method get_Product_2_0 (OR the method which experian have assigned you).
Step 6: Fill up the necessary detail and click on green icon to send request.
Step 7: If successfully completed copy the request file and name it as request.xml

Note: Now you can make changes dynamically directly by assigning file to a variable.
if any doubt during integration , you can reach me at abhishekmoore@gmail.com.

*/

$xml_post_string = file_get_contents('request.xml');

// Initiatize cURL request by POST method.
$url = $soapUrl;
if (!$ch = curl_init())
{
            throw new \Exception('could not initialize curl');
}


$username=''; // Your Experian Developer UserName
$password='';  // Your Experian Developer Password

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_TIMEOUT, 120); //timeout after 30 seconds
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [ "Authorization: Basic ".base64_encode($username.":".$password)]);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);


$response = curl_exec($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
echo $status_code;
if (curl_error($ch))
{
    var_dump($response);           // Check Response here
}
else
{
	var_dump($response);          //  Check Response here
    curl_close($ch);
}


?>