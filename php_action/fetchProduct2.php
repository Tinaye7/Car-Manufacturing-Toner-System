<?php 	



require_once 'core.php';
$cat= "SELECT categories FROM product";
if($cat='Special'){
$sql = "SELECT product.product_id,product.product_code, product.product_name, 
 		product.categories_id, product.iquantity,product.quantity, product.active, product.status, 
 		 categories.categories_name FROM product 
		
		INNER JOIN categories ON product.categories_id = categories.categories_id  
		WHERE product.status = 1 && product.quantity< (0.50*product.iquantity)";

$result = $connect->query($sql);



}else{
	$sql = "SELECT product.product_id,product.product_code, product.product_name, 
 		product.categories_id, product.iquantity,product.quantity, product.active, product.status, 
 		 categories.categories_name FROM product 
		
		INNER JOIN categories ON product.categories_id = categories.categories_id  
		WHERE product.status = 1 && product.quantity< (0.25*product.iquantity)";

$result = $connect->query($sql);


}

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $active = ""; 

 while($row = $result->fetch_array()) {
 	$productId = $row[0];
 	// active 
 	if($row[6] == 1) {
 		// activate member
 		$active = "<label class='label label-success'>Available</label>";
 	} else {
 		// deactivate member
 		$active = "<label class='label label-danger'>Not Available</label>";
 	} // /else

	 
	
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct('.$productId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$productId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

	// $brandId = $row[3];
	// $brandSql = "SELECT * FROM brands WHERE brand_id = $brandId";
	// $brandData = $connect->query($sql);
	// $brand = "";
	// while($row = $brandData->fetch_assoc()) {
	// 	$brand = $row['brand_name'];
	// }
	
	$category = $row['categories_name'];

	

 	$output['data'][] = array( 		
 		// image
 		
		 $row[1],
 		// product name
 		$row['product_name'], 
 		// rate
 		$row['iquantity'],
 		// quantity 
 		$row['quantity'],		 	
 		// brand
 		
 		// category 		
 		$category,
 		// active
 		$active,
 		// button
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);