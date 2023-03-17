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
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> View All Orders</div>
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
							
						
            <th>#</th>
						<th>Order Date</th>
						<th>Client</th>
						<th>Contact</th>
						<th>Vehicle Name</th>
						<th>Plate Number</th>
						<th> Color Code</th>
						<th>Volume Used (ml)</th>
						<th>Amount Paid</th>
						<th>Options</th>
            
						</tr>
					</thead>

                                            <tbody>
                                               
                                             
                                              <?php
                                          
$sql="SELECT * from orders where date(order_date) between '$fdate' and '$tdate' && order_status = 1";

$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
$orderId = $cnt;

$result= ("SELECT SUM(amount_paid) as 'TOTAL AMOUNT' FROM orders  where date(order_date) between '$fdate' and '$tdate' && order_status=1");

$row = $dbh->query($result); 

$sum = $row->fetch(PDO::FETCH_ASSOC);
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>

<script>
     $remove = $this->database->query("REMOVE * FROM klant WHERE ????");
            $removeResult = $this->database->single();
            return $removeResult;
 </script>
                                                <tr>
                                                    
                                                    <td><?php echo htmlentities($cnt);?></td>
                                                    <td><?php  echo htmlentities($row->order_date);?></td>
                                                    <td><?php  echo htmlentities($row->client_name);?></td>
                                                   <td><?php  echo htmlentities($row->client_contact);?></td>
												   <td><?php  echo htmlentities($row->client_vehicle);?></td>
												   <td><?php  echo htmlentities($row->client_plate);?></td>
												   <td><?php  echo htmlentities($row->color);?></td>
												   <td class="volume"><?php  echo htmlentities($row->volume);?></td>
												   <td class="test"><?php  echo htmlentities($row->amount_paid);?></td>
                                                 <td class="datatable-ct"><a href="orders.php?o=editOrd&i=<?php echo htmlentities ($row->order_id);?>"><i class="fa fa-eye" aria-hidden="true"></i>  View</a><br>
												 
                                                </tr>
                                             <?php $cnt=$cnt+1;}} ?>  
                                            
                                            </tbody>
											
                                </div>
								<tfoot align="right">
		<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
	</tfoot>
								
                                        </table>
				<!-- /table -->
			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<script>

    	var sum = 0;
var table = document.getElementById("table");
var ths = table.getElementsByTagName('th');
var tds = table.getElementsByClassName('test');
for(var i=0;i<tds.length;i++){
	sum += isNaN(tds[i].innerText) ? 0 : Number(tds[i].innerText);
}
var result = parseFloat(sum).toFixed(2);
var row = table.insertRow(table.rows.length);
var cell = row.insertCell(0);
cell.setAttribute('colspan', ths.length);

var totalBalance  = document.createTextNode('TOTAL AMOUNT PAID = ' + result);
cell.appendChild(totalBalance);

        
   
</script>

<script>

    	var sum = 0;
var table = document.getElementById("table");
var ths = table.getElementsByTagName('th');
var tds = table.getElementsByClassName('volume');
for(var i=0;i<tds.length;i++){
	sum += isNaN(tds[i].innerText) ? 0 : Number(tds[i].innerText);
}
var result = parseFloat(sum).toFixed(2);
var row = table.insertRow(table.rows.length);
var cell = row.insertCell(0);
cell.setAttribute('colspan', ths.length);

var totalBalance  = document.createTextNode('TOTAL VOLUME USED = ' + result + '' + 'ml');
cell.appendChild(totalBalance);

        
   
</script>
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
	<script src="custom/js/order.js"></script>
  <script src="custom/js/test.js"></script>

<?php require_once 'includes/footer.php'; ?>