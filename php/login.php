<?php

include("connection.php");
$response =[];
$response["success"] =false;
$ret = specialCharcheck($db);
$email = $ret['email'];
$password = md5($ret['password']);
if($email == ""){
	$response["msg"] ="Enter valid Email address";
}
if($password == ""){
	$response["msg"]="Invalid Password";
}
if(!isset($response['msg'])){
	$query = "SELECT * FROM sampletable WHERE Email=? and Password=?;";
	$stmt = $db->prepare($query);
	if($stmt){
		if($stmt->bind_param('ss',$email,$password)){
			if($stmt->execute()){
				$smt = $stmt->get_result();
				if($smt->num_rows > 0){
					$results = $smt -> fetch_array(MYSQLI_ASSOC);
					$_SESSION["Password"]=$results['Password'];
					$_SESSION["contact"]=$results['contact'];
					$_SESSION["UserName"]=$results['UserName'];
					$_SESSION["FirstName"]=$results['FirstName'];
					$_SESSION["LastName"]=$results['LastName'];
					$_SESSION["Age"]=$results['Age'];
					$_SESSION["Dob"]=$results['Dob'];
					$_SESSION["Email"]=$results['Email']; 
					include("session.php");
				}
				else{
					$response["msg"]="Invalid Userid and password";
					echo json_encode($response);
				}
			}
		}
	}
	$smt -> free_result();
	$db -> close();
}
else{
	echo json_encode($response);
}
?>