<?php
session_start();
ini_set('display_errors',true);
ini_set('display_startup_errors',true);
ini_set('memory_limit','-1');
ini_set('mex_execution_time',0);
error_reporting(0);
$res1=array('success' => false );
ignore_user_abort(true);
define('EOL',(PHP_SAPI == 'cli')? PHP_EOL : '<br />');
$db = mysqli_connect('localhost', 'id18420917_signuptask', '|Bv\H=3DeuPyN2R(', 'id18420917_sampledb');
if ($db ->connect_error) {
	  die("Connection failed: " . $db->connect_error);
}
if(isset($_POST['flag'])){
	if($_POST['flag'] == "checkUser"){
		$query = "SELECT * FROM sampletable WHERE UserName=?;";
		selectQuery($db,$_POST['userName'],$query);
	}
	if($_POST['flag'] == "checkEmail"){
		$query = "SELECT * FROM sampletable WHERE Email=?;";
		selectQuery($db,$_POST['email'],$query);
	}
	echo json_encode($res1);
}
function specialCharcheck($db){
	$returnData =[];
	foreach($_POST as $p => $val ){
		$returnData["$p"] = mysqli_real_escape_string($db,$val);
	}
	return $returnData;
}
function selectQuery($db,$email,$query){
	global $res1;
	$res=array("msg"=>"dummy");
	$stmt = $db->prepare($query);
	if($stmt){
		if($stmt->bind_param('s',$email)){
			if($stmt->execute()){
				$result = $stmt->get_result();
				if($result->num_rows > 0){
					$results = $result-> fetch_array(MYSQLI_ASSOC);
					if(!is_null($results)){	
						if ($results['Email'] == $email || $results['UserName'] == $email) {
							$res1['success'] = false;
							return $results; 
						}
					} 
				}
				else{
					$res1['success'] = true;
				}
				
			}
			$res1['success'] = true;
		}
	}
	$stmt -> free_result();
}

?>