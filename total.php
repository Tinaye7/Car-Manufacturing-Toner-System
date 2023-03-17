<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; ?>
<div class="row">
	<div class="col-md-12">
  <ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active"> Products Used</li>
		</ol>
			<!-- /panel-heading -->
     
			<div class="panel-body">
       <div class="remove-messages"></div>
			  
                                                    
       <form class="form-horizontal" action="totalDetails.php" method="post" id="table">
                                                       
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
<script src="custom/js/order.js"></script>

<?php require_once 'includes/footer.php'; ?>