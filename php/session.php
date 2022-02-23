<?php
include('redis.php');
$response = [];
if($redis->get('Email')){
	$response["data"]=$respData;
	$response["success"]=true;
	echo json_encode($response);
}
else{
	$response["success"]=false;
	$response["msg"]="session not set";
	echo json_encode($response);
}
?>
