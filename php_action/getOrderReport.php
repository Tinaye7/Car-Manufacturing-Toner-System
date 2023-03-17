<?php 

require_once 'core.php';

if($_POST) {

	$startDate = $_POST['startDate'];
	$date = DateTime::createFromFormat('m/d/Y',$startDate);
	$start_date = $date->format("Y-m-d");


	$endDate = $_POST['endDate'];
	$format = DateTime::createFromFormat('m/d/Y',$endDate);
	$end_date = $format->format("Y-m-d");

	$sql = "SELECT * FROM orders WHERE order_date >= '$start_date' AND order_date <= '$end_date' and order_status = 1";
	$query = $connect->query($sql);

	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Order Date</th>
			<th>Client Name</th>
			<th>Contact</th>
			<th>Vehicle Name</th>
			<th>Plate Number</th>
			<th>Color Code</th>
			<th>Volume Used</th>
			<th>Amount Paid</th>
			
		</tr>

		<tr>';
		
		while ($result = $query->fetch_assoc()) {
			$table .= '<tr>
				<td><center>'.$result['order_date'].'</center></td>
				<td><center>'.$result['client_name'].'</center></td>
				<td><center>'.$result['client_contact'].'</center></td>
				<td><center>'.$result['client_vehicle'].'</center></td>
				<td><center>'.$result['client_plate'].'</center></td>
				<td><center>'.$result['color'].'</center></td>
				<td><center>'.$result['volume'].'</center></td>
				<td><center>'.$result['amount_paid'].'</center></td>
				
			</tr>';	
			
		}
		$table .= '
		</tr>

		
	</table>
	';	

	echo $table;

}

?>