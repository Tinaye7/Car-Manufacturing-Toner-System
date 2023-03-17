var manageProductTable3;

$(document).ready(function() {
	// top nav bar 
	$('#navProduct').addClass('active');
	// manage product data table
	manageProductTable3 = $('#manageProductTable2').DataTable({
		'ajax': 'php_action/fetchUsage.php',
		'order': []
	});
});