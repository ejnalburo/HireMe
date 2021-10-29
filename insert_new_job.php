<?php

// type your code here
 
include 'config.php';

	$userID = $categoryID = $business = $jobTitle = $rate = $lat = $lng = $jobDetails = $status = $dateCreated = "";
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

	
	if(isset($_POST['business']) && !empty($_POST['business'])){
		$business = mysqli_real_escape_string($conn,$_POST['business']);
	}else{
 		$valid = false;
 		$error .= "* Business Name is required.\n";
 		$business = '';
	}

	if(isset($_POST['jobTitle']) && !empty($_POST['jobTitle'])){
		$jobTitle = mysqli_real_escape_string($conn,$_POST['jobTitle']);
	}else{
 		$valid = false;
 		$error .= "* Job Title required.\n";
 		$jobTitle = '';
	}

	if(isset($_POST['jobDetails']) && !empty($_POST['jobDetails'])){
		$jobDetails = mysqli_real_escape_string($conn,$_POST['jobDetails']);
	}else{
 		$valid = false;
 		$error .= "* Job Details required.\n";
 		$jobDetails = '';
	}

	if(isset($_POST['rate']) && !empty($_POST['rate'])){
		$rate = mysqli_real_escape_string($conn,$_POST['rate']);
	}else{
 		$valid = false;
 		$error .= "* Rate is required.\n";
 		$rate = '';
	}

	if(isset($_POST['lat']) && !empty($_POST['lat'])){
		$lat = mysqli_real_escape_string($conn,$_POST['lat']);
	}else{
 		$valid = false;
 		$error .= "* Latitude is required.\n";
 		$lat = '';
	}

	if(isset($_POST['lng']) && !empty($_POST['lng'])){
		$lng = mysqli_real_escape_string($conn,$_POST['lng']);
	}else{
 		$valid = false;
 		$error .= "* Longitude is required.\n";
 		$lng = '';
	}

	if(isset($_POST['status']) && !empty($_POST['status'])){
		$status = mysqli_real_escape_string($conn,$_POST['status']);
	}else{
 		$valid = false;
 		$error .= "* Status is required.\n";
 		$status = '';
	}

	if($valid){
 		$sql = "INSERT INTO jobs(jobID, userID, categoryID, business, rate, jobTitle, lat, lng, jobDetails, status, dateCreated) VALUES (NULL, '$userID', '$categoryID', '$business', '$rate', '$jobTitle', '$lat', '$lng', '$jobDetails', '$status', CURDATE())";
 			
 		$query = mysqli_query($conn, $sql);
 			
 			if($query){
 				$retrive_sql = "SELECT a.userID as userID, a.categoryID as categoryID, a.business as business, a.jobTitle as jobTitle, a.rate as rate, a.lat as lat, a.lng as lng, a.jobDetails as jobDetails, a.status as status, b.categoryName as categoryName FROM jobs a, category b WHERE userID = '$userID' AND a.categoryID = b.categoryID ORDER BY jobID desc";
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
