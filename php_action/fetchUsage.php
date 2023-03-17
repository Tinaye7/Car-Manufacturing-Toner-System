<?php 	



require_once 'core.php';

$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];
$sql = "SELECT orders.order_id,orders.client_name, orders.order_date,orders.client_plate,orders.client_vehicle,orders.client_contact,order_item.quantity,product.product_id

 		 FROM orders 
		
		INNER JOIN order_item ON orders.order_id = order_item.order_id
        INNER JOIN product ON order_item.product_id = product.product_id where date(orders.order_date) between '$fdate' and '$tdate'";
        
		

$result = $connect->query($sql);

$output = array('data' => array());

	

	

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 

 while($row = $result->fetch_array()) {
 	
 	// active 
 	

	 
	
 	

	// $brandId = $row[3];
	// $brandSql = "SELECT * FROM brands WHERE brand_id = $brandId";
	// $brandData = $connect->query($sql);
	// $brand = "";
	// while($row = $brandData->fetch_assoc()) {
	// 	$brand = $row['brand_name'];
	// }
	
	

	

 	$output['data'][] = array( 		
 		// image
 		
		 $row['order_date'],
 		// product name
 		$row['client_name'], 
 		// rate
 		$row['client_vehicle'],
 		// quantity 
 		$row['client_plate'],		 	
 		// brand
 		$row['quantity'],
 				
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);