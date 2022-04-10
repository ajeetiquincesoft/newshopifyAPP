<?php
var_dump($url);

//$url = "https://f144e10537940291d73c0eef308203f1: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@local-primary-store.myshopify.com/admin/api/unstable/graphql.json";

//var_dump($url);
/* Member Metafields Shopify */

//$skus_data = "(sku:MAN123) OR (sku:123SE)";
if($barcode_string != ''){
$graphql_data = '{
    products(first: 5, query: "'.$barcode_string.'") {
        edges {
            node {
              id
              handle
    variants(first: 90) {
          edges {
            node {
              legacyResourceId
              sku
              inventoryItem {
                        id
                        legacyResourceId
                    }
            }
          }
        }   
        
        
        }
          }
      pageInfo {
        hasNextPage
      }
    }
  }';



  var_dump($graphql_data);
//Use CURL to send the data	
//open connection
$ch = curl_init();
		
//set the url, number of GET vars, GET data
curl_setopt($ch,CURLOPT_URL, $url);

//Set the curl to POST, not GET	
curl_setopt($ch,CURLOPT_POST, 1);

//Use the php function http_build_query to create a data array to be send with your metadata
curl_setopt($ch,CURLOPT_POSTFIELDS, $graphql_data)
;


curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'content-type: application/graphql',
    'x-shopify-access-token:'.$password
));


//Set your Shopify login tokens
	
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);
$get_data = json_decode($result,true);
//$member_id = $get_data['metafield']['id'];

/* End Member Metafields Shopify */

$products_get = $get_data['data']['products']['edges'];

        foreach($products_get as $key=>$value){
            $variant_sku = $value['node']['sku'];
        }










echo "<pre>";
print_r($get_data);
echo "</pre>";
}

?>