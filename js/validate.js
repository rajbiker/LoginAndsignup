	function varCheck(email,Password,contact,userName,LastName,FirstName,dob,age,repassword){
		if(email == "" || Password == "" || contact == "" || userName == ""|| FirstName == "" || LastName == ""  || age == "" || dob == "" || repassword == "" ){
			return  "Enter all the fields";
		}
		if(email.length < 10 || email.length > 46){
			error ="Email address should have minimum of 10 letters and maximum of 45 letters";
		}
		if((Password.length < 5 || Password.length > 21 ) || (repassword.length < 5 || repassword.length > 21 )){
			return  "Password should have minimum of 5 letters and maximum of 20 letters";	
		}
		if((age.length > 3) || isNaN(age)){
			return  "Enter valid age";
		}
		if(isNaN(contact) || contact.length !== 10) {
			return "Enter valid Mobile Number";
		}
		if(Password !== repassword){
			return "Passwords not matching";
		}
	}