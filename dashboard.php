<?php require_once 'includes/header.php'; ?>

<?php 
$fdate= '2022/07/01';
 $tdate= '2030/07/31';
$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM orders where date(order_date) between '$fdate' and '$tdate' && order_status = 1";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;


$cat= "SELECT categories FROM product";
if ($cat='special'){
	$lowStockSql = "SELECT * FROM product WHERE quantity <= (0.50*iquantity) AND status = 1";
	$lowStockQuery = $connect->query($lowStockSql);
	$countLowStock = $lowStockQuery->num_rows;
}else{
$lowStockSql = "SELECT * FROM product WHERE quantity <= (0.25*iquantity) AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;
}


$connect->close();

?>


<style type="text/css">
	.ui-datepicker-calendar {
		display: none;
	}
</style>

<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assests/plugins/fullcalendar/fullcalendar.print.css" media="print">
<link rel="icon" type="image/x-icon" href="./icon.jpeg">


<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']==1 || $_SESSION['userId']==4 || $_SESSION['userId']==5|| $_SESSION['userId']==6|| $_SESSION['userId']==8) { ?>
	<div class="col-md-4" style="margin-left:360px;margin-top:80px">
		<div class="panel panel-success">
			<div class="panel-heading">
				
				<a href="product.php" style="text-decoration:none;color:black;">
					Total Products
					<span class="badge pull pull-right"><?php echo $countProduct; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->

	<?php } ?>
	<div class="row" style="margin-top:160px;margin-left:400px" >
	<div class="col-md-4"  style="margin-left:-230px">
		<div class="panel panel-danger" >
			<div class="panel-heading">
				<a href="product2.php" style="text-decoration:none;color:black;">
					Low Stock
					<span class="badge pull pull-right"><?php echo $countLowStock; ?></span>	
				</a>
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div> <!--/col-md-4-->
	
	<div class="col-md-4" >
		<div  >
			<div >
				
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
	</div>
	
	  
		<div class="col-md-4">
			<div class="panel panel-info" >
			<div class="panel-heading">
				<a href="orders.php?o=manord" style="text-decoration:none;color:black;">
					Total Orders
					<span class="badge pull pull-right"><?php echo $countOrder; ?></span>
				</a>
					
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
		</div> <!--/col-md-4-->

	

	<div class="col-md-4">
		<div class="card" style="margin-left:-90px;margin-top:100px; width:400px">
		  <div class="cardHeader">
		  <div class="hero-unit-clock">
		
		<form name="clock">
		  <input style="width:250px;" type="text" class="trans" name="face" value="" disabled>
	</div>
	</form>
		  </div>

		  <div class="cardContainer">
		    <p><?php $Today = date('y:m:d',mktime());
								$new = date('l, F d, Y', strtotime($Today));
								echo $new; ?></p>
		  </div>
		</div> 
		<br/>

		

		  
	</div>
	
	<?php  if(isset($_SESSION['userId']) && $_SESSION['userId']) { ?>
	
	<?php  } ?>
	
</div> <!--/row-->

<!-- fullCalendar 2.2.5 -->
<script src="assests/plugins/moment/moment.min.js"></script>
<script src="assests/plugins/fullcalendar/fullcalendar.min.js"></script>


<script type="text/javascript">
	$(function () {
			// top bar active
	$('#navDashboard').addClass('active');

      //Date for the calendar events (dummy data)
      var date = new Date();
      var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();

      $('#calendar').fullCalendar({
        header: {
          left: '',
          center: 'title'
        },
        buttonText: {
          today: 'today',
          month: 'month'          
        }        
      });


    });

/* Visit http://www.yaldex.com/ for full source code
and get more free JavaScript, CSS and DHTML scripts! */
<!-- Begin
var timerID = null;
var timerRunning = false;
function stopclock (){
if(timerRunning)
clearTimeout(timerID);
timerRunning = false;
}
function showtime () {
var now = new Date();
var hours = now.getHours();
var minutes = now.getMinutes();
var seconds = now.getSeconds()
var timeValue = "" + ((hours >12) ? hours -12 :hours)
if (timeValue == "0") timeValue = 12;
timeValue += ((minutes < 10) ? ":0" : ":") + minutes
timeValue += ((seconds < 10) ? ":0" : ":") + seconds
timeValue += (hours >= 12) ? " P.M." : " A.M."
document.clock.face.value = timeValue;
timerID = setTimeout("showtime()",1000);
timerRunning = true;
}
function startclock() {
stopclock();
showtime();
}
window.onload=startclock;
// End -->
</SCRIPT>	
<?php require_once 'includes/footer.php'; ?>