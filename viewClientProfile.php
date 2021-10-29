<?php 

// type your code here

 include 'config.php';

$userID = $categoryID = '';


	
 	if(isset($_POST['userID']) && !empty($_POST['userID'])){
 		$userID = $_POST['userID'];
 	}

 	if(isset($_POST['categoryID']) && !empty($_POST['categoryID'])){
 		$categoryID = $_POST['categoryID'];
 	}


	$sql = "SELECT b.profile as profile, b.firstname as firstname, b.lastname as lastname, a.userID as userID, a.business as business, a.jobTitle as jobTitle, a.rate as rate, a.lat as lat, a.lng as lng FROM jobs a, users b WHERE a.categoryID = '$categoryID' AND a.userID = '$userID' AND a.userID = b.userID";
	$query = mysqli_query($conn, $sql);

	if($query){
 		$data = mysqli_fetch_assoc($query);
 		echo json_encode($data);
 	} 
?>