<?php
$response = [];
session_start();
if(isset($_SESSION['Email']) && $_SESSION['Email'] == $email){
	$response["data"]=$_SESSION;
	$response["success"]=true;
	echo json_encode($response);
}
else{
	$response["success"]=false;
	$response["msg"]="session not set";
	echo json_encode($response);
}
?>
