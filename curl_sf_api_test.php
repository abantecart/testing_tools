<?php
	/* 
	AbanteCart API curl test 

	Developer: Pavel Rojkov (projkov@abantecart.com)	
	*/
	$abc_url = 'http://[domain]/index.php';
	$data['api_key'] = 'test_apikey';	
	$url = $abc_url . '?api_key=' . $data['api_key'];

	//test connection with cart access
	echo "Testing connection, get cart ... <br>\n";
	$data['rt'] = 'a/checkout/cart';
	$return = service_post($url, $data);
	die_if_error($return);
	print_r($return);	

	//login customer
	echo "Testing customer login ... <br>\n";
	$data['email'] = 'abantecart';
	$data['password'] = '123456';
	$data['rt'] = 'a/account/login';
	$return = service_post($url, $data);
	die_if_error($return);
	if (!isset($return['token'])){
		exit;
	} else {
		echo "Authenticated with token: " . $return['token'] . "<br><br>\n";	
	}
	$token = $return['token'];

	//validate login
	echo "Validating token... <br>\n";
	$data = array();
	$data['rt'] = 'a/account/login';
	$data['token'] = $token;
	$return = service_post($url, $data);
	die_if_error($return);
	print_r($return);


	//get customer details
	echo "Testing customer details ... <br>\n";
	$data = array();
	$data['rt'] = 'a/account/account';
	$data['token'] = $token;
	$return = service_post($url, $data);
	die_if_error($return);
	print_r($return);

	echo "Test has completed!<br>\n";	

?>
    
<?php

function die_if_error($return_array = array()) {
	if(isset($return_array['error'])) {
		echo "Error: " . $return_array['error'] . "<br>\n";
		exit;
	}
}


/* curl connection functions */
function service_post($url, $data) {
  
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, count($data));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $result = curl_exec($ch);
    curl_close($ch);

    return json_decode($result, true);
} 

function service_get($url, $data) {
  
  	$fields_string = '';
	foreach($data as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url . '&'.$fields_string);    
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
} 
