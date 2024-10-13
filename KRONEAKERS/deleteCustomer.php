<?php
    $id = $_GET['id'];

    //Connect DB
    $host="localhost";
	$user="root";
	$password="";
	$dbName="whitecanvas";
	
    // Check connection
	$connect = mysqli_connect($host,$user,$password,$dbName);
	if (!$connect) 
	{
		die("Connection failed: " . mysqli_connect_error());
	}

   //query : delete where Staff_id = $id
   $sql = "DELETE FROM customer WHERE Customer_ID = '$id'";

   //on success delete : redirect the page to original page using header() method
    if (mysqli_query($connect, $sql)) {

        mysqli_close($connect);
        header('Location: adminCust.php');
        echo"<script> alert('Customer account deleted successfully!'); </script>";
        
        exit;
    } else {
        echo "Error deleting record";
    }

    