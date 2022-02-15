<?php
	include('redis.php');
	$redis->flushAll();
	$response=array("success"=>true,"msg"=> "session terminated","data"=>null);
	echo json_encode($response);
?>
