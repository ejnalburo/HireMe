<?php

// type your code here
 
include 'config.php';

	$userID = $categoryID = $jobTitle = $rate =  $experience = $dateCreated = "";
	$valid = true;

	if(isset($_POST['userID']) && !empty($_POST['userID'])){
		$userID = mysqli_real_escape_string($conn,$_POST['userID']);
	}else{
 		$valid = false;
 		$error .= "* User ID is required.\n";
 		$userID = '';
	}

	if(isset($_POST['categoryID']) && !empty($_POST['categoryID'])){
		$categoryID = mysqli_real_escape_string($conn,$_POST['categoryID']);
	}else{
 		$valid = false;
 		$error .= "* Category ID is required.\n";
 		$categoryID = '';
	}

	
	if(isset($_POST['jobTitle']) && !empty($_POST['jobTitle'])){
		$jobTitle = mysqli_real_escape_string($conn,$_POST['jobTitle']);
	}else{
 		$valid = false;
 		$error .= "* Job Title required.\n";
 		$jobTitle = '';
	}

	if(isset($_POST['rate']) && !empty($_POST['rate'])){
		$rate = mysqli_real_escape_string($conn,$_POST['rate']);
	}else{
 		$valid = false;
 		$error .= "* Rate is required.\n";
 		$rate = '';
	}

	if(isset($_POST['experience']) && !empty($_POST['experience'])){
		$experience = mysqli_real_escape_string($conn,$_POST['experience']);
	}else{
 		$valid = false;
 		$error .= "* Work Experience is required.\n";
 		$experience = '';
	}

	if($valid){
 		$sql = "INSERT INTO workers(workerID, userID, categoryID, rate, jobTitle, workExperience, dateCreated) VALUES (NULL, '$userID', '$categoryID', '$rate', '$jobTitle', '$experience', CURDATE())";
 			
 		$query = mysqli_query($conn, $sql);
 			
 			if($query){
 				$retrive_sql = "SELECT a.userID as userID, a.categoryID as categoryID, a.jobTitle as jobTitle, a.rate as rate, a.workExperience as experience, b.categoryName as categoryName FROM workers a, category b WHERE userID = '$userID' AND a.categoryID = b.categoryID ORDER BY workerID desc";
 				$retrive_query = mysqli_query($conn, $retrive_sql);
 				
 				if($retrive_query){
 					$data = mysqli_fetch_assoc($retrive_query);
 					echo json_encode($data);
 				}


 			}else{
 				$data = array("valid"=>false, "msg"=>"Data not inserted.");
 				echo json_encode($data);
 			}	
	}else{
 		$resp = [];
 		$resp = array("valid"=>false, "msg"=>$error);
 		echo json_encode($resp);
	}
?>
