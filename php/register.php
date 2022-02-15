<?php
include("connection.php");
include("validate.php");
$val = new validate();
$response =[];
$response["success"]=false;
$ret = specialCharcheck($db);
$email = $ret['email'];
$password =$ret['password'];
$contact = $ret['contact'];
$userName = $ret['username'];
$FirstName = $ret['FirstName'];
$LastName = $ret['LastName'];
$age = $ret['age'];
$dob = $ret['dob'];
$repassword = $ret['re-password'];
$response["msg"] = $val->validation($email,$password,$contact,$userName,$LastName,$FirstName,$dob,$age,$repassword);
if(is_null($response['msg'])){
	$password = md5($password);
	$query = "INSERT INTO sampletable (UserName,FirstName,LastName,contact,Password, Email,Age,Dob) 
				  VALUES(?,?,?,?,?,?,?,?);";
	$stmt = $db->prepare($query);
	if($stmt){
	   $stmt->bind_param('sssissii',$userName,$FirstName,$LastName,$contact,$password, $email,$age,$dob);
		if($stmt->execute()){
		    include("json.php");
			jsonData($email,$password,$contact,$userName,$LastName,$FirstName,$dob,$age,"insert");
			$respData=[];
			$respData["Password"]=$password;
			$respData["contact"]=$contact;
			$respData["UserName"]=$userName;
			$respData["FirstName"]=$FirstName;
			$respData["LastName"]=$LastName;
			$respData["Age"]=$age;
			$respData["Dob"]=$dob;
			$respData["Email"]=$email; 
			include("redis.php");
			$redis->set('Email',$email);
			include("session.php");
		}
		else{
	        $response["msg"]="Registration failed".$db->error;	
		    echo json_encode($response);
    	}
		$stmt->close();	 
	}
	else{
		$response["msg"]="Registration failed";	
		echo json_encode($response);
	}
}
else{
	echo json_encode($response);
}
?>
