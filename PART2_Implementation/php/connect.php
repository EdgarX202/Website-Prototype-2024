<?php
	
	// Connection details
	// Connecting to the database that holds student/staff records
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "studentstaff";
	
	// Attempt to connect
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// Check connection 
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connection_error);
	}
	 // echo "Connected Successfully"; // <-- Testing if works
	 
	 // Run a specific php script based on which button user clicked
	 // LOGIN, ADD STUDENT, EDIT STUDENT
	 if (isset($_POST['SubmitLogin'])) {
		require "loginQuery.php";
	 } elseif (isset($_POST['SubmitNewStud'])) {
		 require "addStudent.php";
	 } elseif (isset($_POST['Search'])) {
		 require "editStudent.php";
	 } elseif (isset($_POST['Update'])) {
		 require "editStudent.php";
	 } elseif (isset($_POST['Delete'])) {
		 require "editStudent.php";
	 }
	 
	 // Close the connection
	 $conn->close();
?>
