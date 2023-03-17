<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 

if($_GET['o'] == 'add') { 
// add order
	echo "<div class='div-request div-hide'>add</div>";
} else if($_GET['o'] == 'manord') { 
	echo "<div class='div-request div-hide'>manord</div>";
} else if($_GET['o'] == 'editOrd') { 
	echo "<div class='div-request div-hide'>editOrd</div>";
} // /else manage order


?>

<ol class="breadcrumb">
  <li><a href="dashboard.php">Home</a></li>
  <li>Order</li>
  <li class="active">
  	<?php if($_GET['o'] == 'add') { ?>
  		Add Order
		<?php } else if($_GET['o'] == 'manord') { ?>
			Manage Order
		<?php } // /else manage order ?>
  </li>
</ol>


<h4>
	<i class='glyphicon glyphicon-circle-arrow-right'></i>
	<?php if($_GET['o'] == 'add') {
		echo "Add Order";
	} else if($_GET['o'] == 'manord') { 
		echo "Manage Order";
	} else if($_GET['o'] == 'editOrd') { 
		echo "Edit Order";
	}
	?>	
</h4>



<div class="panel panel-default">
	<div class="panel-heading">

		<?php if($_GET['o'] == 'add') { ?>
  		<i class="glyphicon glyphicon-plus-sign"></i>	Add Order
		<?php } else if($_GET['o'] == 'manord') { ?>
			<i class="glyphicon glyphicon-edit"></i> Manage Order
		<?php } else if($_GET['o'] == 'editOrd') { ?>
			<i class="glyphicon glyphicon-edit"></i> Edit Order
		<?php } ?>

	</div> <!--/panel-->	
<div class="panel-body">
			
		<?php if($_GET['o'] == 'add') { 
			// add order
			?>			

			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/createOrder.php" id="createOrderForm" enctype="multipart/form-data">

			  <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Order Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientName" class="col-sm-2 control-label">Client Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label">Client Contact</label>
			    <div class="col-sm-10">
			      <input type="number" class="form-control" id="clientContact" name="clientContact" placeholder="Contact Number" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->			  
			  <div class="form-group">
			    <label for="clientVehicle" class="col-sm-2 control-label">Vehicle Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientVehicle" name="clientVehicle" placeholder="Vehicle Name" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->	
			  <div class="form-group">
			    <label for="clientPlate" class="col-sm-2 control-label">Plate Number</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientPlate" name="clientPlate" placeholder="Plate Number" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->	
			  <div class="form-group">
			    <label for="color" class="col-sm-2 control-label">Color Code</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="color" name="color" placeholder="Color Code" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->	
			  <div class="form-group">
			    <label for="volume" class="col-sm-2 control-label">Volume Used</label>
			    <div class="col-sm-10">
			      <input type="float" class="form-control" id="volume" name="volume" placeholder="Volume used" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->	
			  <div class="form-group">
			    <label for="clientAmount" class="col-sm-2 control-label">Amount Paid</label>
			    <div class="col-sm-10">
			      <input type="float" class="form-control" id="clientAmount" name="clientAmount" placeholder="Amount Paid" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->				
			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:20%;">Product Code</th>
			  			<th style="width:40%;">Product Name</th>
			  			<th style="width:10%;">Available Quantity</th>
			  			<th style="width:15%;">Quantity <br><small>(Enter Units used)</small></th>			  			
			  					  			
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php
			  		$arrayNumber = 0;
			  		for($x = 1; $x < 2; $x++) { ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:20px;">
			  					<div class="form-group">

			  					<select class="form-control" name="productCode[]" id="productCode<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			  						<option value="">~~SELECT~~</option>
			  						<?php
			  							$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 ";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."'>".$row['product_code']."</option>";
										 	} // /while 

			  						?>
		  						</select>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="productName[]" id="productName<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
			  					<input type="hidden" name="productName[]" id="productName<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
							<td style="padding-left:20px;">
			  					<div class="form-group">
									<p id="available_quantity<?php echo $x; ?>"></p>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="float" name="quantity[]" id="quantity<?php echo $x; ?>"  autocomplete="off" class="form-control"  />
			  					</div>
			  				</td>
			  				
			  				<td>

			  					<button class="btn btn-danger removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>

			  


			  <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <button type="button" class="btn btn-success" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>

			      <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>

			      <button type="reset" class="btn btn-danger" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
			    </div>
			  </div>
			</form>           

</div>
			    <!-- /panel-body -->
	
</div>
</div>
	<!-- /col-dm-12 -->
</div>
<?php } else if($_GET['o'] == 'manord') { 
			// manage order
			?>

			<div id="success-messages"></div>
			
			<div class="row">
	<div class="col-md-12">
  <ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active"> Orders</li>
		</ol>
			<!-- /panel-heading -->
     
			<div class="panel-body">
       <div class="remove-messages"></div>
			  
                                                    
       <form class="form-horizontal" action="orderreport.php" method="post" id="table">
                                                       
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">From Date:</label>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                     <input type="date" class="form-control" id="fromdate" name="fromdate" value="" required='true'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label class="login2 pull-right pull-right-pro">To Date:</label>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                     <input type="date" class="form-control" id="todate" name="todate" value="" required='true'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       
                                                    
                                                        <div class="form-group-inner">
                                                            <div class="login-btn-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-3"></div>
                                                                    <div class="col-lg-9">
                                                                        <div class="login-horizental cancel-wp pull-left">
                                                                            
                                                                            <button class="btn btn-sm btn-primary login-submit-cs" type="submit" name="submit">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                               

</div>
			    <!-- /panel-body -->
	
</div>
</div>
	<!-- /col-dm-12 -->
</div>
		<?php 
		// /else manage order
		} else if($_GET['o'] == 'editOrd') {
			// get order
			?>
			
			<div class="success-messages"></div> <!--/success-messages-->

  		
<form class="form-horizontal" method="POST" action="php_action/editOrder.php" id="editOrderForm">

<?php $orderId = $_GET['i'];

$sql = "SELECT orders.order_id, orders.order_date, orders.client_name, orders.client_contact, orders.client_vehicle, orders.client_plate,orders.volume,orders.color, orders.amount_paid FROM orders 	
WHERE orders.order_id = {$orderId}";

$result = $connect->query($sql);
$data = $result->fetch_row();
?>

<div class="form-group">
<label for="orderDate" class="col-sm-2 control-label">Order Date</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" value="<?php echo $data[1] ?>" />
</div>
</div> <!--/form-group-->
<div class="form-group">
<label for="clientName" class="col-sm-2 control-label">Client Name</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" autocomplete="off" value="<?php echo $data[2] ?>" />
</div>
</div> <!--/form-group-->
<div class="form-group">
<label for="clientContact" class="col-sm-2 control-label">Client Contact</label>
<div class="col-sm-10">
<input type="number" class="form-control" id="clientContact" name="clientContact" placeholder="Contact Number" autocomplete="off" value="<?php echo $data[3] ?>" />
</div>
</div> <!--/form-group-->			  
<div class="form-group">
<label for="clientVehicle" class="col-sm-2 control-label">Vehicle Name</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="clientVehicle" name="clientVehicle" placeholder="Vehicle Name" autocomplete="off" value="<?php echo $data[4] ?>" />
</div>
</div> <!--/form-group-->			 
<div class="form-group">
<label for="clientPlate" class="col-sm-2 control-label">Plate Number</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="clientPlate" name="clientPlate" placeholder="Plate Number" autocomplete="off" value="<?php echo $data[5] ?>" />
</div>
</div> <!--/form-group-->		
<div class="form-group">
<label for="color" class="col-sm-2 control-label">Color Code</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="color" name="color" placeholder="Color Code" autocomplete="off" value="<?php echo $data[7] ?>" />
</div>
</div> <!--/form-group-->
<div class="form-group">
<label for="volume" class="col-sm-2 control-label">Volume Used</label>
<div class="col-sm-10">
<input type="float" class="form-control" id="volume" name="volume" placeholder="Volume used" autocomplete="off" value="<?php echo $data[6] ?>" />
</div>
</div> <!--/form-group-->		
<div class="form-group">
<label for="clientAmount" class="col-sm-2 control-label">Amount Paid</label>
<div class="col-sm-10">
<input type="float" class="form-control" id="clientAmount" name="clientAmount" placeholder="Amount Paid" autocomplete="off" value="<?php echo $data[8] ?>" />
</div>
</div> <!--/form-group-->			  	   
<table class="table" id="productTable">
<thead>
<tr>			  			
<th style="width:40%;">Product Code</th>
<th style="width:40%;">Product Name</th>
<th style="width:15%;">Available Quantity</th>			  			
<th style="width:15%;">Quantity Used</th>			  			
						  
<th style="width:10%;"></th>
</tr>
</thead>
<tbody>
<?php

$orderItemSql = "SELECT order_item.order_item_id, order_item.order_id, order_item.product_id, order_item.quantity FROM order_item WHERE order_item.order_id = {$orderId}";
$orderItemResult = $connect->query($orderItemSql);
// $orderItemData = $orderItemResult->fetch_all();						

// print_r($orderItemData);
$arrayNumber = 0;
// for($x = 1; $x <= count($orderItemData); $x++) {
$x = 1;
while($orderItemData = $orderItemResult->fetch_array()) { 
// print_r($orderItemData); ?>
<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
	<td style="margin-left:20px;">
		<div class="form-group">

		<select class="form-control" name="productCode[]" id="productCode<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			<option value="">~~SELECT~~</option>
			<?php
				$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 ";
				$productData = $connect->query($productSql);

				while($row = $productData->fetch_array()) {									 		
					$selected = "";
					if($row['product_id'] == $orderItemData['product_id']) {
						$selected = "selected";
					} else {
						$selected = "";
					}

					echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."' ".$selected." >".$row['product_code']."</option>";
				   } // /while 

			?>
		</select>
		</div>
	</td>
	<td style="padding-left:20px;">
		<div class="form-control">
		  <?php
				$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 ";
				$productData = $connect->query($productSql);

				while($row = $productData->fetch_array()) {									 		
					$selected = "";
					if($row['product_id'] == $orderItemData['product_id']) { 
						echo "<p id='productName".$row['product_id']."'>".$row['product_name']."</p>";
				  }
					 else {
						$selected = "";
					}

					//echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."' ".$selected." >".$row['product_name']."</option>";
				   } // /while 

			?>
		  
		</div>
	</td>
  <td style="padding-left:20px;">
		<div class="form-group">
		  <?php
				$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 ";
				$productData = $connect->query($productSql);

				while($row = $productData->fetch_array()) {									 		
					$selected = "";
					if($row['product_id'] == $orderItemData['product_id']) { 
						echo "<p id='available_quantity".$row['product_id']."'>".$row['quantity']."</p>";
				  }
					 else {
						$selected = "";
					}

					//echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."' ".$selected." >".$row['product_name']."</option>";
				   } // /while 

			?>
		  
		</div>
	</td>
	<td style="padding-left:20px;">
		<div class="form-group">
		<input type="float" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" value="<?php echo $orderItemData['quantity']; ?>" />
		</div>
	</td>
	
	<td>

		<button class="btn btn-danger removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
	</td>
</tr>
<?php
$arrayNumber++;
$x++;
} // /for
?>
</tbody>			  	
</table>




<div class="form-group editButtonFooter">

  <div class="col-sm-offset-2 col-sm-10">
  <?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1 || $_SESSION['userId']==4 || $_SESSION['userId']==8|| $_SESSION['userId']==5|| $_SESSION['userId']==6) { ?>
  <button type="button" class="btn btn-success" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button> <?php }?>
  
  <input type="hidden" name="orderId" id="orderId" value="<?php echo $_GET['i']; ?>" />
  <?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1 || $_SESSION['userId']==4 || $_SESSION['userId']==8) { ?>
  <button type="submit" id="editOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button> <?php } ?>
	
  </div>
  
</div>

</form>

<?php
} // /get order else  ?>


</div> <!--/panel-->	
</div> <!--/panel-->	



<!-- edit order -->
<div class="modal fade" tabindex="-1" role="dialog" id="paymentOrderModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i> Edit</h4>
      </div>      

      
      <div class="modal-footer">
      	<button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="updatePaymentOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>	
      </div>           
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit order-->

<!-- remove order -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Order</h4>
      </div>
      <div class="modal-body">

      	<div class="removeOrderMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove order-->


<script src="custom/js/order.js"></script>

<?php require_once 'includes/footer.php'; ?>


	