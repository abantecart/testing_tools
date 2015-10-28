<?php
	/* 
		AbanteCart Admin API curl test 

		Developer: Pavel Rojkov (projkov@abantecart.com)	
	
	
		Fill in your URL,admin and key parameters below
	*/
	$abc_url = 'http://[domain]/index.php';
	$admin = 'admin_path';
	$url = $abc_url . "?s=" . $admin;
	$data['username'] = 'admin';
	$data['password'] = 'admin';
	$data['api_key'] = 'test_admin_apikey';	

	//Test login process
	echo "Testing authentication ... <br>\n";
	$data['rt'] = 'a/index/login';
	$return = service_post($url, $data);
	die_if_error($return);
	if (!isset($return['token'])){
		exit;
	} else {
		echo "Authenticated with token: " . $return['token'] . "<br><br>\n";	
	}
	$token = $return['token'];

	//get customer details
	$customer_id = 12;
	echo "Testing customer lookup ... <br>\n";
	$data = array();
	$data['rt'] = 'a/customer/details';
	$data['token'] = $token;
	$data['customer_id'] = $customer_id;
	$data['api_key'] = 'test_admin_apikey';	
	$return = service_get($url, $data);
	die_if_error($return);
	echo "Customer ID: ".$customer_id." look up name " . $return['firstname'] . " " .$return['lastname'] . "<br><br>\n";	
	$customer_id = $return['customer_id'];

	//get customer orders
	echo "Testing orders list ... <br>\n";
	$data = array();
	$data['rt'] = 'a/customer/orders';
	$data['token'] = $token;
	$data['customer_id'] = $customer_id;
	$data['start'] = 0;
	$data['limit'] = 40;
	$data['api_key'] = 'test_admin_apikey';	
	$return = service_get($url, $data);
	die_if_error($return);
	echo "Customer ID: ".$customer_id." orders count " . count($return). "<br><br>\n";	
	$first_order_id = $return[0]['order_id'];

	//get customer orders
	echo "Testing order lookup ... <br>\n";
	$data = array();
	$data['rt'] = 'a/order/details';
	$data['token'] = $token;
	$data['order_id'] = $first_order_id;
	$data['api_key'] = 'test_admin_apikey';	
	$return = service_get($url, $data);
	die_if_error($return);
	echo "Order ID: ".$first_order_id." Total " . $return['total']. "<br><br>\n";	

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
