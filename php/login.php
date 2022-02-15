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
					$respData=[];
					$respData["Password"]=$results['Password'];
					$respData["contact"]=$results['contact'];
					$respData["UserName"]=$results['UserName'];
					$respData["FirstName"]=$results['FirstName'];
					$respData["LastName"]=$results['LastName'];
					$respData["Age"]=$results['Age'];
					$respData["Dob"]=$results['Dob'];
					$respData["Email"]=$results['Email']; 
					include('redis.php');
					$redis->set("Email",$results['Email']);
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
