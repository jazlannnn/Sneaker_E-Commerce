<?php
	// session_start();
	// $host="localhost";
	// $user="root";
	// $password="123456";
	// $dbName="whitecanvas";
	
	// // connection 
	// $connect = mysqli_connect($host,$user,$password,$dbName);
	// if (!$connect) 
	// {
	// 	die("Connection failed: " . mysqli_connect_error());
	// }

 
// session_start();
// $host = 'localhost';
// $port = '1521';
// $db_service_name = 'xe';
// $db_user = 'whitecanvas';
// $db_pass = 'system';

// // Establish the Oracle database connection
// $connect = oci_connect($db_user, $db_pass, "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$host)(PORT=$port))(CONNECT_DATA=(SERVICE_NAME=$db_service_name)))");

// if (!$connect) {
//     $error = oci_error();
//     die("Connection failed: " . $error['message']);
// }

// // Connection successful, perform further operations here
// // ...

// oci_close($connect); // Close the connection




/* php & Oracle DB connection file */
$user="whitecanvas"; //Oracle username
$pass="system"; //Oracle password
$host="localhost/XE"; //server name or ip address
$dbconn=oci_connect($user, $pass, $host);

if(!$dbconn) {
$e =oci_error(); trigger_error (htmlentities ($e ['message'], ENT_QUOTES), E_USER_ERROR);
} else {

}

 
 
  
  
?>




