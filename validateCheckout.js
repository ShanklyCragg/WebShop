function validateCheckout() {
	
	$nameV = document.forms["PLS"]["Name"].value;
	
	$creditV = document.forms["PLS"]["CreditCard"].value;
	
	alert("THIS IS GETTING CALLED LOOK AT THIS ALERT");
	
	//Regex to check if name entered is legal
	if(/^[a-zA-Z]*$/.test($nameV)) {
		
		//Regex to check for 16 ints
		if(/[0-9]{16}/.test($creditV)) {
			alert("Thank you for using Shankly's super shop! We appreciate your custom");
			session_destroy();
			return true;
		}
		else {
			alert("Please enter 16 ints for your card number please");
			return false;
		}
	}
	else {
		alert("Please enter a valid name (Must only contain characters, sorry ROBOT*475 !)");
		return false;
	}
}