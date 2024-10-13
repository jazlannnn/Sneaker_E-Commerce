<link rel="stylesheet" href="CSS/GeneralStyling.css" type="text/css" />
<?php




	// Stores all related fucntions
	//----------------------------------------------------------------------------
	
	// output product card on catalog page 
	function component($ProductName, $ProductPrice, $ProductImg, $Product_ID, $ProductDesc){
		
		$element = " 
		
		<div style='border: none; outline: 0; padding: 12px; text-align: center; cursor: pointer; width: 100%; font-size: 18px;'>
			<form class='card' method='post' action=''>
				<img src='$ProductImg'  style='width:100%'>
				<h1>$ProductName</h1>
				<p>RM $ProductPrice</p>
				<p>Description : $ProductDesc</p>
				Size(UK): <input type='text' name='product_size' value='7.5' style='width:20%' ><br><br>
				Quantity : <input type='text' name='product_quantity' value='1' style='width:20%' >
				<p><button name='Add'>Add to Cart</button></p>
				<input type='hidden' name='product_id' value='$Product_ID' >
				<input type='hidden' name='product_name' value='$ProductName' >
				<input type='hidden' name='product_price' value='$ProductPrice' >
			</form>
		</div>
			
		";
		echo $element;
	}
	
	// cart items displayed on cart page
	function cartElement($ProductName,$ProductImg,$ProductPrice,$ProductID,$ProductQuan, $ProductDescription, $ProductGender,$ProductSize){
		
		$element = " 
		
			<div style='display:flex;'>
				
				<div style='width:50%'>				
					<img src='$ProductImg' style='width:  450px; height: 450px; object-fit: cover;'>
				</div>
										
				<div style='width:50%:'>
					
					<form action='CartPage.php?action=remove&id=$ProductID' method='post' style='padding:20px;'>
										
							<h2 style='margin-bottom:25px'>$ProductName</h2>
							<h5>RM $ProductPrice</h5>	
							<h5>Shoe Description: $ProductDescription</h5>
							<h5>Gender: $ProductGender</h5>
							<h5>Quantity : $ProductQuan</h5>
							<h5>Size(UK): $ProductSize</h5><br>
								<input type='text' name='Inputquantity' style='width:15%; height:10%'>
								<button  name ='updateQuantity' id='quantity' style='margin-bottom:25px' class='UpdateButton'>Change Quantity</button><br>
								
								<input type='text' name='InputSize' style='width:15%; height:10%'>
								<button  name ='updateSize' id='quantity' style='margin-bottom:25px' class='UpdateButton'>Change Size</button><br>
								
								<button type='submit' name ='remove' class='removeButton'>Remove</button>
							
					</form>		
					
				</div>
				
			</div>
			<hr><br>
			
		";
		echo $element;
	}
	
	// function to view order details on view details page 
	function GetOrderDetails($Order_ID) {
    global $dbconn;
	include "config.php";
    
    $sql = "SELECT
                Product_Name,
                OrderDetails_Size,
                OrderDetails_Quantity,
                Product_Price,
                OrderDetails_SubTotal,
                Orders_TotalPrice,
                Orders_Date,
                Product_Image,
                Payment_Proof
            FROM
                order_details
                INNER JOIN orders ON orders.Orders_ID = order_details.OrderDetails_OrderFK
                INNER JOIN product ON product.Product_ID = order_details.OrderDetails_ProductFK
                INNER JOIN customer ON customer.Customer_ID = orders.Orders_CustomerFK
                INNER JOIN payment ON payment.Payment_OrderFK = orders.Orders_ID
            WHERE
                orders.Orders_ID = :order_id";

    $stmt = oci_parse($dbconn, $sql);
    oci_bind_by_name($stmt, ":order_id", $Order_ID);
    oci_execute($stmt);
    
    return $stmt;
}
		
		// if($result)
		// {
		// 	if(mysqli_num_rows($result) > 0)
		// 	{	
		// 		return $result; 								
		// 	}
		// 	else 
		// 		"query fails"; 
		// }
		
	
	
	// function logout alert
	function Logout(){
		
		$element = " 
			<script>alert('You have successfully log out !!!')</script>
		";
		echo $element;
	}

?>