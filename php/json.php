<?php 
function jsonData($email,$password,$contact,$userName,$LastName,$FirstName,$dob,$age,$opr){
$jsonData= array('FirstName'=> $FirstName,'userName'=> $userName,
				'email'=> $email, 'password'=>md5($password), 'contact'=>$contact,
				'age'=>$age,'dob'=>$dob);
	$file = "../jsonOut/user.json";
    if($opr == "insert"){
        if(file_exists($file)){
            $existingData =	file_get_contents($file);
            $jsonArray = json_decode($existingData, true); 
            $jsonArray[]=$jsonData;
            file_put_contents($file,json_encode($jsonArray));
        }
        if(!file_exists($file)){	
            $jsonArray[]=$jsonData;
            file_put_contents($file,json_encode($jsonArray));
        }
    }
    else{
        $existingData =	file_get_contents($file);
        $jsonArray = json_decode($existingData, true); 
        foreach($jsonArray as $k => $val){
            if($val['email']==$email){
                $jsonArray[$k]=$jsonData;
            }
        }
        file_put_contents($file,json_encode($jsonArray));
    }
}
?>