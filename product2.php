<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Products</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Products</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-success button1" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Product </button>
				</div> <!-- /div-action -->				
				
				<table class="table table-hover table-striped table-bordered" id="manageProductTable2">
					<thead>
						<tr>
							
							<th style="width:15%;">Product Code</th>							
							<th>Product Name</th>
							<th> Initial Quantity</th>
							<th> Available Quantity</th>
						
							<th style="width:20%;"> Category</th>
							<th>Status</th>
							
						</tr>
					</thead>




					
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->





<script src="custom/js/product2.js"></script>

<?php require_once 'includes/footer.php'; ?>