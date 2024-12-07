<?php

	 // Start the session
	 session_start();
	
	 // Check if the login form is submitted
	 if (isset($_POST['SubmitLogin'])) {
		 
		 // Retrieve users inputed details
		 $username = $_POST['Username'];
		 $password = $_POST['Password'];
		 
		 // stmt preparing SQL statement --> "?" placeholder to prevent SQL injection
		 $stmt = $conn->prepare("SELECT * FROM student_db WHERE ID = ? AND Password = ?");
		 // Bind variables to "?" placeholders --> more secure? 
		 // "is" integer,string
		 $stmt->bind_param("is", $username, $password);
		 // Execute SQL statement
		 $stmt->execute();
		 
		 // Store results
		 $result = $stmt->get_result();
		 
		 // Checking if the query returned a row --> meaning login details are there
		 if ($result->num_rows > 0) {
			 // Fetch the first row of results
			 $row = $result->fetch_assoc();
			 
			 // Store username session variable
			 $_SESSION['ID'] = $row['ID'];
			 
			 // Store user ID in the cookie and set the expiration time to 1 hour
			 setcookie('User', $row['ID'], time() + 3600, '/');

			 // Check if a user is a staff member and direct them to admin homepage
			 // Otherwise, its a student a direct them to student homepage
			 if ($row['Staff?'] == 'YES') {
				header('Location: ../adminHome.htm');
				exit;
			 } else {
				 header('Location: ../studentHome.htm');
				 exit;
			 }
		 } else {
			 echo "User not found or invalid details.";
		 }
		 
		 // Close prepared statement
		 $stmt->close();
	 }
	
     ?>