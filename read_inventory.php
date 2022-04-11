<?php
include_once 'connection.php';

$select = "SELECT store_name from update_inventory GROUP BY store_name ORDER BY Id LIMIT 5";
$select_rs = mysqli_query($conn,$select);
        if(mysqli_num_rows($select_rs)>0){
while($row = mysqli_fetch_assoc($select_rs)){
$shop_name = $row['store_name'];

$barcodes_arr = array();
$barcode_qty = array();
$select_barcodes = "SELECT * from update_inventory WHERE store_name='".$shop_name."' LIMIT 5";
$select_barcodes_rs = mysqli_query($conn,$select_barcodes);
if(mysqli_num_rows($select_barcodes_rs)>0){
while($bar_row = mysqli_fetch_assoc($select_barcodes_rs)){
$barcodes = $bar_row['barcode'];
$quantity = $bar_row['quantity'];

$barcode_qty[$barcodes] = $quantity;
array_push($barcodes_arr,$barcodes);
}
$shop = $shop_name;
include 'shop_array.php';

$barcode_string = "";
        for($n=0;$n<sizeOf($barcodes_arr);$n++){
            $barcode_val = $barcodes_arr[$n];
                    if($barcode_string == ''){
                        $barcode_string = "(sku:".$barcode_val.")";
                    }
                    else{
                        $barcode_string = $barcode_string." OR (sku:".$barcode_val.")";
                    }


        }

//$barcodes_implode = implode(",",$barcodes_arr);






$url = "https://".$api_key.":".$password."@".$shop."/admin/api/unstable/graphql.json";
include 'graphql_api.php';


}


    
}


        }








?>
