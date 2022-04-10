<?php

include_once 'connection.php';

$_HEADERS = apache_request_headers();

$_DOMAIN  = explode(".",$_HEADERS['X-Shopify-Shop-Domain']);

$shop = $_DOMAIN[0];

$datak     = (file_get_contents('php://input'));

$fhd   = fopen('order.txt', 'w')  or die("Utyftyftf");

fwrite($fhd, $datak);

$shop = "local-primary-store.myshopify.com";

$fh   = fopen('order.txt', 'r')  or die("Utyftyftf");

$filename = 'order.txt';



$data = fread($fh, filesize($filename));

$arraydata=json_decode($data,true);

//var_dump($arraydata);

$line_items = $arraydata['line_items'];

$plan_exist_item = false;

$plan_id = '';

$rent_item_exist = false;
$rent_item_qty=0;

$product_arr = array();

$skus = array();

$ids=array();
foreach($line_items as $key => $value){

 $product_id = $value['product_id'];
 $sku = $value['sku'];
 $variant_id = $value['variant_id'];

array_push($ids,$product_id);
array_push($skus,$sku);

}
$shops_array = array("local-primary-store.myshopify.com","primary-dressinventory.myshopify.com","local-child-store-2.myshopify.com","local-child-store-1.myshopify.com");

switch ($shop) {
	case $shops_array[0]:
		$api_key="f144e10537940291d73c0eef308203f1";   /* api key of the app */
		$password="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";  /* token */
		break;
	case $shops_array[1]:
		$api_key="c81141a619dc1df19d0b6730d1cc35d8";   /* api key of the app */
		$password="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";  /* token */
		break;
	case $shops_array[2]:
		$api_key="3875e7586d7f05f5cf797d8f5553b3d1";      /* api key of the app */
		$password="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";  /* token */
		break;
	case $shops_array[3]:
		$api_key="b7e1aaef3a63791aebbf5f24fd39401d";   /* api key of the app */
		$password="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";  /* token */
		break;
  }


$ids=implode(",",$ids);

$url = "https://".$api_key.":".$password."@".$shop."/admin/api/unstable/products.json?ids=".$ids;
var_dump($url);
//Use CURL to send the data	
//open connection
$ch = curl_init();
		
//set the url, number of GET vars, GET data
curl_setopt($ch,CURLOPT_URL, $url);

//Set the curl to POST, not GET	
//curl_setopt($ch,CURLOPT_POST, 1);

//Use the php function http_build_query to create a data array to be send with your metadata
//curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($data));

//Set your Shopify login tokens
	
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);
//var_dump($result);

$json_data = json_decode($result,true);

echo "<pre>";
print_r($json_data);
echo "</pre>";

$products = $json_data['products'];

	foreach($products as $key=>$value){
		$pro_id = $value['id'];
		$variants = $value['variants'];
				foreach($variants as $variant_key=>$variant_value){
						$quantity = $variant_value['inventory_quantity'];
						$get_sku = $variant_value['sku'];
						$get_variant_id = $variant_value['id'];

						if (in_array($get_sku, $skus))
						{
							for($i=0;$i<4;$i++){
							$get_shop = $shops_array[$i];		
									if($get_shop != $shop){
	$insert = "INSERT INTO update_inventory (barcode,store_name,quantity) VALUES('".$get_sku."','".$get_shop."','".$quantity."')";
	$insert_rs = mysqli_query($conn,$insert);		

									}
							}
						}




				}	


	}


?>