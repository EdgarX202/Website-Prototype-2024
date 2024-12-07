function formValidation() {

	// Create form variables
	const name = document.getElementById("username").value;
	const password = document.getElementById("password").value;
	
	// Create error message variables
	const nameErr = document.getElementById("usernameError");
	const passErr = document.getElementById("passwordError");
	
	// Regex for checking digits if needed
	const regex = "/^\d+$/";
	
	// Empty strings for error messages
	nameErr.textContent = "";
	passErr.textContent = "";
	
	// Validation variable
	let isValid = true;
	
	// Check for empty fields
	if (name === "") {
		nameErr.textContent = "Cannot be empty!";
		isValid = false;
	}
	if (password === "") {
		passErr.textContent = "Cannot be empty!";
		isValid = false;
	}
	
	// Check if length is valid
	if (name.length < 5) {
		nameErr.textContent = "ID too short!";
		isValid = false;
	}
	if (password.length < 5) {
		passErr.textContent = "Password too short!";
		isValid = false;
	}
	
	// Check if input is not a digit
	if (isNaN(name)) {
		nameErr.textContent = "Only digits allowed!";
		isValid = false;
	}
	
	return isValid;
}