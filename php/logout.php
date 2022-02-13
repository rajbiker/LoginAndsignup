<?php
	session_start();
	session_unset();
	clearstatcache();
	$response=array("success"=>true,"msg"=> "session terminated","data"=>null);
	echo json_encode($response);
?>