function validate() {
	$user = document.forms["login"]["user"].value;		// Fetch the value of the user textbox
	
	//Regex to check if name entered is legal
	if(/^[a-zA-Z]*$/.test($user)) {
		return true;
	}
	else {
		alert("Please enter a valid username (Must only contain characters, sorry ROBOT*475 !)");
		return false;
	}
}

