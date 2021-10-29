<?php 

// type your code here

 include 'config.php';

$userID = $schedID = '';


	
 	if(isset($_POST['userID']) && !empty($_POST['userID'])){
 		$userID = $_POST['userID'];
 	}

 	if(isset($_POST['schedID']) && !empty($_POST['schedID'])){
 		$schedID = $_POST['schedID'];
 	}


	$sql = "SELECT c.schedID as schedID, b.profile as profile, b.firstname as firstname, b.lastname as lastname, a.userID as userID, a.business as business, a.jobTitle as jobTitle, a.rate as rate, a.location as location FROM jobs a, users b, schedules c WHERE a.userID = '$userID' AND c.schedID = '$schedID' AND a.userID = b.userID";
	$query = mysqli_query($conn, $sql);

	if($query){
 		$data = mysqli_fetch_assoc($query);
 		echo json_encode($data);
 	} 
?>