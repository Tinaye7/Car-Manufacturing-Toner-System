<?php 	
//ALTER TABLE `orders` ADD `payment_place` INT NOT NULL AFTER `payment_status`;
//TER TABLE `orders` ADD `gstn` VARCHAR(255) NOT NULL AFTER `payment_place`;
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// print_r($valid);
if($_POST) {	

	$orderDate 						= date('Y-m-d', strtotime($_POST['orderDate']));	
  $clientName 					= $_POST['clientName'];
  $clientContact 				= $_POST['clientContact'];
  $clientVehicle 				= $_POST['clientVehicle'];
  $clientPlate 				= $_POST['clientPlate'];
  $color				= $_POST['color'];
  $volume 				= $_POST['volume'];
  $clientAmount 				= $_POST['clientAmount'];
  
  $userid 				= $_SESSION['userId'];

				
	$sql = "INSERT INTO orders (order_date, client_name, client_contact,client_vehicle,client_plate,color,volume,amount_paid,order_status,user_id) VALUES ('$orderDate', '$clientName', '$clientContact', '$clientVehicle', '$clientPlate', '$color','$volume','$clientAmount',1,$userid)";
	
	$order_id;
	$orderStatus = false;
	if($connect->query($sql) === true) {
		$order_id = $connect->insert_id;
		$valid['order_id'] = $order_id;	

		$orderStatus = true;
	}

		
	// echo $_POST['productName'];
	$orderItemStatus = false;

	for($x = 0; $x < count($_POST['productCode']); $x++) {			
		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productCode'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
		
		
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			$updateQuantity[$x] = $updateProductQuantityResult[0] - $_POST['quantity'][$x];							
				// update product table
				$updateProductTable = "UPDATE product SET quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$_POST['productCode'][$x]."";
				$connect->query($updateProductTable);

				// add into order_item
				$orderItemSql = "INSERT INTO order_item (order_id, product_id, quantity, order_item_status) 
				VALUES ('$order_id', '".$_POST['productCode'][$x]."', '".$_POST['quantity'][$x]."',  1)";

				$connect->query($orderItemSql);		

				if($x == count($_POST['productCode'])) {
					$orderItemStatus = true;
				}		
		} // while	
	} // /for quantity

	
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	

	
	
	
	$connect->close();

	header('Location: ../orders.php?o=manord');
	
} // /if $_POST
// echo json_encode($valid);