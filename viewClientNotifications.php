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


	$sql = "SELECT c.schedID as schedID, b.profile as profile, b.firstname as firstname, b.lastname as lastname, a.userID as userID, a.workExperience as workExperience, a.jobTitle as jobTitle, a.rate as rate, b.lat as lat, b.lng as lng FROM workers a, users b, schedules c WHERE a.userID = '$userID' AND c.schedID = '$schedID' AND a.userID = b.userID GROUP BY c.schedID";
	$query = mysqli_query($conn, $sql);

	if($query){
 		$data = mysqli_fetch_assoc($query);
 		echo json_encode($data);
 	} 
?>