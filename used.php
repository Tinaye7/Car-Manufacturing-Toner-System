<?php include 'php_action/dbconnection.php' ;
include 'includes/header2.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Report</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> View Products Used</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>
                <?php
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];

?>
				
				
				<table class="table table-hover table-striped table-bordered" id="table">
					<thead>
						<tr>
							<th > Date Used </th>
                            <th> Product Code </th>
                            <th> Product Name </th>
							<th >Customer Name</th>
							<th > Vehicle Name</th>							
							<th >Plate Number</th>
							<th> Quantity Used</th>
							
							
						</tr>
					</thead>

                    <tbody>
                                               
                                             
                                               <?php
                                           
                                           $sql = "SELECT orders.order_id,orders.client_name,product.product_code,product.product_name, orders.order_date,orders.client_plate,orders.client_vehicle,orders.client_contact,order_item.quantity,product.product_id

                                           FROM orders 
                                         
                                         INNER JOIN order_item ON orders.order_id = order_item.order_id
                                         INNER JOIN product ON order_item.product_id = product.product_id where date(orders.order_date) between '$fdate' and '$tdate'";
                                         
                                         
                                 
                                 
 
 $query = $dbh -> prepare($sql);
 $query->execute();
 $results=$query->fetchAll(PDO::FETCH_OBJ);
 
 
  if($query->rowCount() > 0)
 {
 foreach($results as $row)
 {               ?>
 
 
                                                 <tr>
                                                     
                                                     
                                                     <td><?php  echo htmlentities($row->order_date);?></td>
                                                     <td><?php  echo htmlentities($row->product_code);?></td>
                                                     <td><?php  echo htmlentities($row->product_name);?></td>
                                                     <td><?php  echo htmlentities($row->client_name);?></td>
                                                    <td><?php  echo htmlentities($row->client_vehicle);?></td>
                                                    <td><?php  echo htmlentities($row->client_plate);?></td>
                                                    <td><?php  echo htmlentities($row->quantity);?></td>
                                                   
                                                 </tr>
                                              <?php }} ?>  
                                             
                                             </tbody>


					
				</table>
				<!-- /table -->
			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->




<script src="js/data-table/bootstrap-table.js"></script>
    <script src="js/data-table/tableExport.js"></script>
    <script src="js/data-table/data-table-active.js"></script>
    <script src="js/data-table/bootstrap-table-editable.js"></script>
    <script src="js/data-table/bootstrap-editable.js"></script>
    <script src="js/data-table/bootstrap-table-resizable.js"></script>
    <script src="js/data-table/colResizable-1.5.source.js"></script>
    <script src="js/data-table/bootstrap-table-export.js"></script>
    <script src="js/main.js"></script>
    <script src="js/main.js"></script>

  
  <script src="custom/js/test.js"></script>
<?php require_once 'includes/footer.php'; ?>