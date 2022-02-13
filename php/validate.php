<?php

class validate{
	function __construct(){
		
	}
	function validation($email,$password,$contact,$userName,$LastName,$FirstName,$dob,$age,$repassword){
		if($email == "" || $password == "" || $contact == "" || $userName == ""|| $FirstName == "" || $LastName == ""  || $age == "" || $dob == "" || $repassword == ""){
			return "Enter all the fields";
		}
		if($userName == ""){
			return "Enter valid User name";
		}
		if($email == "" || (strlen($email) < 10 || strlen($email) > 46)){
			return "Email address should have minimum of 10 letters and maximum of 45 letters";
		}
		if(($password == "" || (strlen($password) < 5 || strlen($password) > 21 )) || ( $repassword == "" || (strlen($repassword) < 5 || strlen($repassword) > 21 ) )){
			return "Password should have minimum of 5 letters and maximum of 20 letters";	
		}
		if($age =="" || (strlen($age) < 1 || strlen($age) > 3 ) || !is_numeric($age)){
			return "Enter valid age";
		}
		if($contact == "" || !is_numeric($contact) || strlen($contact) !== 10) {
			return  "Enter valid Mobile Number";
		}
		if($password !== $repassword){
			return "Passwords not matching";
		}
	}
}