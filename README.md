# magento2-GuestOrderHistory

# Decription

implement guest order history feature. Please implement with a new controller that takes parameter(s) to query a single order and returns a json with information about order status, total, items (sku, item_id, price) and total invoiced.

## Installation

### Composer Package

1. Go to Magento® 2 root folder

2. Enter following commands to install module:

   ```
   composer require born/module-ordercontroller dev-master
   ```

   Wait while dependencies are updated.

3. Enter following commands to enable module:

   ```
   php bin/magento module:enable Born_OrderController
   php bin/magento setup:upgrade
   php bin/magento cache:clean
   ```
   
### Manually

1. Go to Magento® 2 root folder

2. paste all code in a foler app/code/Born/OrderController

3. Enter following commands to enable module:

   ```
   php bin/magento module:enable Born_OrderController
   php bin/magento setup:upgrade
   php bin/magento cache:clean
   ```
   

### How to use
   
   by calling rest api
   
   end point:
   ```
   rest/V1/guestorder/getGuestOrderHistory/:param
   ```
   
   param can be 1,2,.. all
   
   ```
   <?php
	/*
	 * init curl
	 */
	/*
	$ch = curl_init();
	 
	curl_setopt($ch,CURLOPT_URL,'http://hostname/rest/V1/guestorder/getGuestOrderHistory/1');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_HEADER, false); 

	$output=curl_exec($ch);

	curl_close($ch);

	echo $output;
	?>
   ```
   
   or by calling simple controller
   
   ```
   <?php
	/*
	 * init curl
	 */
	$ch = curl_init();  
	 
	curl_setopt($ch,CURLOPT_URL,'http://hostname/ordercontroller/guestorderhistory?total_guest_order=1');
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_HEADER, false); 

	$output=curl_exec($ch);

	curl_close($ch);

	echo $output;
	?>
   ```