<?php

	// If the form is submitted
    if (isset($_POST['SubmitNewStud']))
    {
		// Store user entered details into variables
        $id = $_POST['Username'];
        $password = $_POST['Password'];
        $firstName = $_POST['FirstName'];
        $lastName = $_POST['LastName'];
        $phoneNumber = $_POST['Number'];
        $address = $_POST['Address'];

		// Use SQL to insert details into student database
		// Start the stmt
        //$sql = "INSERT INTO student_db (ID, Password, FirstName, LastName, PhoneNumber, Address) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare("INSERT INTO student_db (ID, Password, FirstName, LastName, PhoneNumber, Address) VALUES (?, ?, ?, ?, ?, ?)");
		
		// Bind variables with the "?" values and execute
        if ($stmt) {
        $stmt->bind_param("isssss", $id, $password, $firstName, $lastName, $phoneNumber, $address);
            if ($stmt->execute()) {
                echo "New record added to database.";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
            } else {
                echo "Failed to prepare the statement.";
        }
    }

?>