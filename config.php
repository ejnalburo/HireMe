<?php

// type your code here

$db_hostname = 'localhost'; // Database hostname
$db_username = 'root'; // Database username
$db_password = ''; // Database password
$db_name = 'hireme'; // Database name

$conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

if(!$conn)
	{
 		echo "Unable to connect database".mysqli_error($conn);die;
	}
else
{
 // echo "Database connected successfully";
}

?>