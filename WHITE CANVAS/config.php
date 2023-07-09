<?php

	session_start();
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




