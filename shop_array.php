<?php
$shops_array = array("local-primary-store.myshopify.com","primary-dressinventory.myshopify.com","local-child-store-2.myshopify.com","local-child-store-1.myshopify.com");

switch ($shop) {
	case $shops_array[0]:
		$api_key="f144e10537940291d73c0eef308203f1";   /* api key of the app */
		$password="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";  /* token */
        $location_id = 62091755556;
		break;
	case $shops_array[1]:
		$api_key="c81141a619dc1df19d0b6730d1cc35d8";   /* api key of the app */
		$password="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";  /* token */
		$location_id = 68244504826;
        break;
	case $shops_array[2]:
		$api_key="3875e7586d7f05f5cf797d8f5553b3d1";      /* api key of the app */
		$password="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";  /* token */
		$location_id = 68740153593;
        break;
	case $shops_array[3]:
		$api_key="b7e1aaef3a63791aebbf5f24fd39401d";   /* api key of the app */
		$password="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";  /* token */
		$location_id = 68445700337;
        break;
  }
?>