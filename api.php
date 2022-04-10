<?php
// $date = date('Y-m-d');

// $member = true;
// $last_purchase = $date;
// $subscription_type = 'best-value';
// $pending_products = $pending_products;
// $customer_id = 5848781062307;


$url = "https://7690ccb209ce8596dc64023361c10f2f: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@carat-closet-new.myshopify.com/admin/api/unstable/customers/".$customer_id."/metafields.json";

var_dump($url);
/* Member Metafields Shopify */

$data = array(
	'metafield'=>array( 
		'namespace' => "subscription",
		'key' => "member",
		'value'=>"true",
		'type'=> "string",
		'description'=>"subscription membership plan purchase or not"
		)
);
//Use CURL to send the data	
//open connection
$ch = curl_init();
		
//set the url, number of GET vars, GET data
curl_setopt($ch,CURLOPT_URL, $url);

//Set the curl to POST, not GET	
curl_setopt($ch,CURLOPT_POST, 1);

//Use the php function http_build_query to create a data array to be send with your metadata
curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($data));

//Set your Shopify login tokens
	
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);
$get_data = json_decode($result,true);
//$member_id = $get_data['metafield']['id'];

/* End Member Metafields Shopify */


/* Last Purchase Metafields Shopify */

$data = array(
	'metafield'=>array( 
		'namespace' => "subscription",
		'key' => "last_purchase",
		'value'=>$last_purchase,
		'type'=> "string",
		'description'=>"last_purchase"
		)
);
//Use CURL to send the data	
//open connection
$ch = curl_init();
		
//set the url, number of GET vars, GET data
curl_setopt($ch,CURLOPT_URL, $url);

//Set the curl to POST, not GET	
curl_setopt($ch,CURLOPT_POST, 1);

//Use the php function http_build_query to create a data array to be send with your metadata
curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($data));

//Set your Shopify login tokens
	
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);
var_dump($result);

/* End Member Metafields Shopify */




/* Member Metafields Shopify */

$data = array(
	'metafield'=>array( 
		'namespace' => "subscription",
		'key' => "subscription_type",
		'value'=>$subscription_type,
		'type'=> "string",
		'description'=>"subscription_type"
		)
);
//Use CURL to send the data	
//open connection
$ch = curl_init();
		
//set the url, number of GET vars, GET data
curl_setopt($ch,CURLOPT_URL, $url);

//Set the curl to POST, not GET	
curl_setopt($ch,CURLOPT_POST, 1);

//Use the php function http_build_query to create a data array to be send with your metadata
curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($data));

//Set your Shopify login tokens
	
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);
var_dump($result);

/* End Member Metafields Shopify */




/* Member Metafields Shopify */

$data = array(
	'metafield'=>array( 
		'namespace' => "subscription",
		'key' => "pending_products",
		'value'=>$pending_products,
		'type'=> "integer",
		'description'=>"pending_products"
		)
);
//Use CURL to send the data	
//open connection
$ch = curl_init();
		
//set the url, number of GET vars, GET data
curl_setopt($ch,CURLOPT_URL, $url);

//Set the curl to POST, not GET	
curl_setopt($ch,CURLOPT_POST, 1);

//Use the php function http_build_query to create a data array to be send with your metadata
curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($data));

//Set your Shopify login tokens
	
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);


echo 'Curl error: ' . curl_error($ch);
var_dump($pending_products);

/* End Member Metafields Shopify */










/* Update Customer Tags */


$url_customer = "https://7690ccb209ce8596dc64023361c10f2f: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@carat-closet-new.myshopify.com/admin/api/2021-10/customers/".$customer_id.".json";


/* Member Metafields Shopify */

$data_customer = array(
	'customer'=>array( 
		'tags'=>''
		)
);
//Use CURL to send the data	
//open connection
$ch_customer = curl_init();
		
//set the url, number of GET vars, GET data
curl_setopt($ch_customer,CURLOPT_URL, $url_customer);

//Set the curl to POST, not GET	
    curl_setopt($ch_customer, CURLOPT_CUSTOMREQUEST, "PUT");


//Use the php function http_build_query to create a data array to be send with your metadata
curl_setopt($ch_customer,CURLOPT_POSTFIELDS, http_build_query($data_customer));

//Set your Shopify login tokens
	
curl_setopt($ch_customer, CURLOPT_RETURNTRANSFER, 1);

$result_customer = curl_exec($ch_customer);
var_dump($result_customer);













































?>