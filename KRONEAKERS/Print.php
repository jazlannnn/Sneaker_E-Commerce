<?php
	include "config.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>PHP Print</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12"><br><br>
				<h1>WHITE CANVAS</h1>
				<hr>
				<h2>Invoice</h2>
				<hr>
				<table class="table table-bordered print">
					<thead>
						<tr>
							<th>Num.</th>
							<th>Shoe Name</th>
							<th>Shoe Size(UK)</th>
							<th>Shoe Quantity</th>
							<th>Shoe Price(RM)</th>
							<th>Subtotal(RM)</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sql1 = "SELECT
									Customer_Username,
									Customer_Email,
									Customer_PhoneNumber,
									Customer_Address,
									Orders_TotalPrice,
									Orders_Date
								FROM
									orders
									JOIN customer ON customer.Customer_ID = orders.Orders_CustomerFK
								WHERE
									Customer_ID = :user_id
								AND 
									orders.Orders_ID = :order_id";

						$stmt = oci_parse($dbconn, $sql1);
						oci_bind_by_name($stmt, ":user_id", $_SESSION['user_id']);
						oci_bind_by_name($stmt, ":order_id", $_SESSION['order']);
						oci_execute($stmt);

						while($user_data = oci_fetch_assoc($stmt))
						{
							?>
							<ol>
								<li><b>Username     : </b><?php echo $user_data['CUSTOMER_USERNAME']; ?></li>
								<li><b>Email        : </b><?php echo $user_data['CUSTOMER_EMAIL']; ?></li>
								<li><b>Phone Num.   : </b><?php echo $user_data['CUSTOMER_PHONENUMBER']; ?></li>
								<li><b>Address      : </b><?php echo $user_data['CUSTOMER_ADDRESS']; ?></li>
								<li><b>Total Price  : </b>RM <?php echo $user_data['ORDERS_TOTALPRICE']; ?></li>
								<li><b>Date Ordered : </b><?php echo $user_data['ORDERS_DATE']; ?></li>
							</ol>
							<?php
						}

						$sn = 1;
						$sql = "SELECT
									Product_Name,
									OrderDetails_Size,
									OrderDetails_Quantity,
									Product_Price,
									OrderDetails_SubTotal
								FROM
									order_details
									JOIN orders ON orders.Orders_ID = order_details.OrderDetails_OrderFK
									JOIN product ON product.Product_ID = order_details.OrderDetails_ProductFK
								WHERE
									orders.Orders_ID = :order_id";

						$stmt = oci_parse($dbconn, $sql);
						oci_bind_by_name($stmt, ":order_id", $_SESSION['order']);
						oci_execute($stmt);

						while($user_data = oci_fetch_assoc($stmt))
						{
							?>
							<tr>
								<td><?php echo $sn; ?></td>
								<td><?php echo $user_data['PRODUCT_NAME']; ?></td>
								<td><?php echo $user_data['ORDERDETAILS_SIZE']; ?></td>
								<td><?php echo $user_data['ORDERDETAILS_QUANTITY']; ?></td>
								<td>RM <?php echo $user_data['PRODUCT_PRICE']; ?></td>
								<td>RM <?php echo $user_data['ORDERDETAILS_SUBTOTAL']; ?></td>
							</tr>
							<?php
							$sn++;
						}
						?>
					</tbody>
				</table>

				<div class="text-center"><br>
					<button onclick="window.print();" class="btn btn-primary" id="print-btn">Print your receipt</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
