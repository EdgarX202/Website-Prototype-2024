<?php

	// LOGOUT LOGIC
	if (isset($_POST['Logout'])) {
		
		// Unset superglobal variables
		unset($_SESSION['User']);
		unset($_SESSION['PHPSESSID']);
		
		// Destroy the session
		session_destroy();
		// Remove the cookie -- otherwise it will stay for an hour (can leave if needed)
		//setcookie('User', $row['ID'], time() - 3600, '/');
		// Remove the session cookie as well -- otherwise it wont go away after logout?
		setcookie(session_name(), '', time() - 3600, '/');
		// Redirect back to the login page
		header('Location: ../login.htm');
		
		exit;
	}
?>