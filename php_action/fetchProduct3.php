<?php 	



require_once 'core.php';

$sql = "SELECT order_id,client_name,client_contact,client_vehicle,client_plate,color,volume,amount_paid FROM orders";
		
		
		
$result = $connect->query($sql);

$output = array('data' => array());

	

	

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 

 while($row = $result->fetch_array()) {
 	$orderId = $row[0];
 	// active 
 	

	 
	
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct('.$orderId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$orderId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

	// $brandId = $row[3];
	// $brandSql = "SELECT * FROM brands WHERE brand_id = $brandId";
	// $brandData = $connect->query($sql);
	// $brand = "";
	// while($row = $brandData->fetch_assoc()) {
	// 	$brand = $row['brand_name'];
	// }
	
	$orderdate = $row['order_date'];
	$client = $row['client_name'];
	$contact = $row['client_contact'];
	$vehicle = $row['client_vehicle'];
	$plate = $row['client_plate'];
	$color = $row['color'];
	$volume = $row['volume'];
	$amount = $row['amount_paid'];
	
	

 	$output['data'][] = array( 		
 		// image
 		$row[1],
		 $orderdate,
	$client,
	$contact,
	$vehicle,
	$plate,
	$color,
	$volume,
	$amount,		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);