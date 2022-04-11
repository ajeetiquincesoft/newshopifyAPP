<?php

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



  //var_dump($graphql_data);
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
echo "<pre>";
print_r($products_get);
echo "</pre>";
        foreach($products_get as $key=>$value){
          $variants = $value['node']['variants']['edges'];
              foreach($variants as $variant_key=>$variant_value){
                $variant_sku = $variant_value['node']['sku'];
                $variant_id = $variant_value['node']['legacyResourceId'];
                $inventory_item_id = $variant_value['node']['inventoryItem']['legacyResourceId'];

                  $new_quantity = $barcode_qty[$variant_sku];

                  var_dump($new_quantity);

                  //$url = "https://".$api_key.":".$password."@".$shop."/admin/api/unstable/graphql.json";

           $inventory_url = "https://".$api_key.":".$password."@".$shop."/admin/api/unstable/inventory_levels/set.json";

                  $data_inventory = array(
                      'location_id' => $location_id,
                      'inventory_item_id' =>$inventory_item_id,
                      'available'=>$new_quantity
                  );
                  //Use CURL to send the data	
                  //open connection
                  $ch_inventory = curl_init();
                      
                  //set the url, number of GET vars, GET data
                  curl_setopt($ch_inventory,CURLOPT_URL, $inventory_url);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'content-type: application/json',
                    'x-shopify-access-token:'.$password
                ));
                  //Set the curl to POST, not GET	
                  curl_setopt($ch_inventory,CURLOPT_POST, 1);
                  
                  //Use the php function http_build_query to create a data array to be send with your metadata
                  curl_setopt($ch_inventory,CURLOPT_POSTFIELDS, http_build_query($data_inventory));
                  
                  //Set your Shopify login tokens
                    
                  curl_setopt($ch_inventory, CURLOPT_RETURNTRANSFER, 1);
                  
                 // $result_inventory = curl_exec($ch_inventory);
                  //$get_data_inventory = json_decode($result_inventory,true);
                  
                  if(curl_exec($ch_inventory) === false)
                  {
                      echo 'Curl error: ' . curl_error($ch_inventory);
                  }
                  else
                  {
                    $delete = "DELETE FROM update_inventory WHERE barcode='".$variant_sku."' AND store_name='".$shop."'";
                    $delete_rs = mysqli_query($conn,$delete);


                      echo 'Operation completed without any errors';
                  }


              }

            



        }










}

?>
