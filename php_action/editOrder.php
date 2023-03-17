<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$orderId = $_POST['orderId'];

	$orderDate 						= date('Y-m-d', strtotime($_POST['orderDate']));
  $clientName 					= $_POST['clientName'];
  $clientContact 				= $_POST['clientContact'];
  $clientContact 				= $_POST['clientContact'];
  $clientVehicle 				= $_POST['clientVehicle'];
  $clientPlate 				= $_POST['clientPlate'];
  $clientAmount 				= $_POST['clientAmount'];
  $color 				= $_POST['color'];
  $volume 				= $_POST['volume'];
	$userid 				= $_SESSION['userId'];
				
	
	$sql = "UPDATE orders SET order_date = '$orderDate', client_name = '$clientName',amount_paid = '$clientAmount', color='$color',volume='$volume',client_contact = '$clientContact' ,user_id = '$userid',client_vehicle = '$clientVehicle',client_plate = '$clientPlate' WHERE order_id = {$orderId}";	
	$connect->query($sql);
	
	$readyToUpdateOrderItem = false;
	// add the quantity from the order item to product table
	for($x = 0; $x < count($_POST['productCode']); $x++) {		
		//  product table
		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productCode'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);			
			
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			// order item table add product quantity
			$orderItemTableSql = "SELECT order_item.quantity FROM order_item WHERE order_item.order_id = {$orderId}";
			$orderItemResult = $connect->query($orderItemTableSql);
			$orderItemData = $orderItemResult->fetch_row();

			$editQuantity = $updateProductQuantityResult[0] + $orderItemData[0];							

			$updateQuantitySql = "UPDATE product SET quantity = $editQuantity WHERE product_id = ".$_POST['productCode'][$x]."";
			$connect->query($updateQuantitySql);		
		} // while	
		
		if(count($_POST['productCode']) == count($_POST['productCode'])) {
			$readyToUpdateOrderItem = true;			
		}
	} // /for quantity

	// remove the order item data from order item table
	for($x = 0; $x < count($_POST['productCode']); $x++) {			
		$removeOrderSql = "DELETE FROM order_item WHERE order_id = {$orderId}";
		$connect->query($removeOrderSql);	
	} // /for quantity

	if($readyToUpdateOrderItem) {
			// insert the order item data 
		for($x = 0; $x < count($_POST['productCode']); $x++) {			
			$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productCode'][$x]."";
			$updateProductQuantityData = $connect->query($updateProductQuantitySql);
			
			while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
				$updateQuantity[$x] = $updateProductQuantityResult[0] - $_POST['quantity'][$x];							
					// update product table
					$updateProductTable = "UPDATE product SET quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$_POST['productCode'][$x]."";
					$connect->query($updateProductTable);

					// add into order_item
				$orderItemSql = "INSERT INTO order_item (order_id, product_id, quantity,order_item_status) 
				VALUES ({$orderId}, '".$_POST['productCode'][$x]."', '".$_POST['quantity'][$x]."', 1)";

				$connect->query($orderItemSql);		
			} // while	
		} // /for quantity
	}

	

	$valid['success'] = true;
	$valid['messages'] = "Successfully Updated";		
	
	$connect->close();

	header('Location: ../orders.php?o=manord');
 
} // /if $_POST
// echo json_encode($valid);