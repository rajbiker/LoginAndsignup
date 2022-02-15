<?php
include("connection.php");
include("validate.php");
$val = new validate();
$response =[];
$response["success"] =false;
$ret = specialCharcheck($db);
$email = $_SESSION['Email'];
$password = $ret['password'];
$contact = $ret['contact'];
$userName = $ret['UserName'];
$FirstName = $ret['FirstName'];
$LastName = $ret['LastName'];
$age = $ret['age'];
$dob = $ret['dob'];
$repassword = $password;
$response["msg"] = $val->validation($email,$password,$contact,$userName,$LastName,$FirstName,$dob,$age,$repassword);
if(is_null($response['msg'])){
	$password = md5($password);
	$query = "UPDATE sampletable SET UserName =?, FirstName=?, LastName=?,
				contact=?,Password=?,age=?,dob=?
				where email =? ;";
	$stmt = $db->prepare($query);
	if($stmt){
		$stmt->bind_param('sssisiis',$userName,$FirstName,$LastName,$contact,$password,$age,$dob, $email);
		if($stmt->execute()){
			$response["success"]=true;
			$response["msg"] = "Registration Success";
			include("json.php");
			jsonData($email,$password,$contact,$userName,$LastName,$FirstName,$dob,$age,"update");	
			$_SESSION["Password"]=$password;
			$_SESSION["contact"]=$contact;
			$_SESSION["UserName"]=$userName;
			$_SESSION["FirstName"]=$FirstName;
			$_SESSION["LastName"]=$LastName;
			$_SESSION["Age"]=$age;
			$_SESSION["Dob"]=$dob;
			$_SESSION["Email"]=$email; 
			include("session.php");
		}
		else{
	        $response["msg"]="Registration failed".$db->error;	
		    echo json_encode($response);
    	}
		$stmt->close();	 
	}
	else{
		$response["msg"]="Updation failed";	
		echo json_encode($response);
	}	
}
else{
	echo json_encode($response);
}
