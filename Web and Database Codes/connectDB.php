<?php
/* Database connection settings */
	// $servername = "localhost";
    // $username = "root";		//put your phpmyadmin username.(default is "root")
    // $password = "";			//if your phpmyadmin has a password put it here.(default is "root")
    // $dbname = "db_biometric_attendance";
    
	$servername = "remotemysql.com";
    $username = "vo2WUxxjc7";		
    $password = "nydnlPj19u";			
    $dbname = "vo2WUxxjc7";
    
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }
?>