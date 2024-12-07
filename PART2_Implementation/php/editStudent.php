<?php
	
	// If search button was pressed
    if (isset($_POST['Search'])) {
		// Use the ID provided by user to search the database
        $searchId = $_POST['SearchId'];
		// Prepare SQL statement, bind variables and execute
        //$sql = "SELECT * FROM student_db WHERE ID = ?";
        $stmt = $conn->prepare("SELECT * FROM student_db WHERE ID = ?");
        $stmt->bind_param("i", $searchId);
        $stmt->execute();
        $result = $stmt->get_result();
		
		// If there is a match, display the form with student details
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>

            <h2>Student Details</h2>
        <form action="connect.php" method="post">
			<!-- Hide the first two columns, UNHIDE if needed for update -->
            <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
            <input type="hidden" name="password" value="<?php echo $row['Password']; ?>"><br>
            <label for="firstName">First Name:</label>
            <input type="text" name="firstName" value="<?php echo $row['FirstName']; ?>"><br>
            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" value="<?php echo $row['LastName']; ?>"><br>
            <label for="phoneNumber">Phone Number:</label>
            <input type="text" name="phoneNumber" value="<?php echo $row['PhoneNumber']; ?>"><br>
            <label for="address">Address:</label>
            <input type="text" name="address" value="<?php echo $row['Address']; ?>"><br>
            <input type="submit" value="UPDATE" name="Update"/>
            <input type="submit" value="DELETE" name="Delete"/>
        </form>

        <?php
        } else {
            echo "Student record not found";
        }
	} elseif (isset($_POST['Update'])) {
		// UPDATE RECORD if update button is pressed
		// Create variables to store user entered details
		$id = $_POST['id'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$phoneNumber = $_POST['phoneNumber'];
		$address = $_POST['address'];
		
		// Prepare SQL statement, bind variables and execute
		//$sql = "UPDATE student_db SET FirstName=?, LastName=?, PhoneNumber=?, Address=? WHERE ID=?";
		$stmt = $conn->prepare("UPDATE student_db SET FirstName=?, LastName=?, PhoneNumber=?, Address=? WHERE ID=?");
		$stmt->bind_param("ssssi", $firstName, $lastName, $phoneNumber, $address, $id);
		$stmt->execute();

		// If any column was updated, success.
		if ($stmt->affected_rows > 0) {
			echo "Student record updated successfully!";
			// Return to DB page
			header('Location: ../studentsDB.htm');
			exit;
		} else {
			echo "Error updating student record.";
		}
	} elseif (isset($_POST['Delete'])) {
		// DELETE RECORD if delete button was pressed
		// Create a variable to store user ID
		$id = $_POST['id'];
		
		// Prepare SQL statement, bind variable and execute
		// Basically, find the ID and delete that record
		//$sql = "DELETE FROM student_db WHERE ID=?";
		$stmt = $conn->prepare("DELETE FROM student_db WHERE ID=?");
		$stmt->bind_param("i", $id);

		if ($stmt->execute()) {
			echo "Student record deleted successfully!";
			header('Location: ../studentsDB.htm');
			exit;
		} else {
			echo "Error deleting student record.";
		}
	}
?>