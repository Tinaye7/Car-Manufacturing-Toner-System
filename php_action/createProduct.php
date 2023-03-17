<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$productCode 		= $_POST['productCode'];
	$productName 		= $_POST['productName'];
	$iquantity 			= $_POST['iquantity'];
    $quantity 			= $_POST['quantity'];
	$purchase 			= $_POST['purchase'];
  $categoryName 	= $_POST['categoryName'];
  $productStatus 	= $_POST['productStatus'];

		
				$sql = "INSERT INTO product (product_code,product_name, categories_id,iquantity, quantity, purchase,active, status) 
				VALUES ('$productCode','$productName','$categoryName', '$iquantity','$quantity', '$purchase','$productStatus',1)";

				if($connect->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Added";	
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
				}		

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST