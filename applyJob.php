<?php

// type your code here
 
include 'config.php';

	$jobworkerID = $clientID = $userID = $timeSched = $dateSched = $status = $schedType = "";
	$valid = true;

	if(isset($_POST['jobworkerID']) && !empty($_POST['jobworkerID'])){
		$jobworkerID = mysqli_real_escape_string($conn,$_POST['jobworkerID']);
	}else{
 		$valid = false;
 		$error .= "* Job ID is required.\n";
 		$jobworkerID = '';
	}

	if(isset($_POST['clientID']) && !empty($_POST['clientID'])){
		$clientID = mysqli_real_escape_string($conn,$_POST['clientID']);
	}else{
 		$valid = false;
 		$error .= "* Job ID is required.\n";
 		$clientID = '';
	}


	if(isset($_POST['userID']) && !empty($_POST['userID'])){
		$userID = mysqli_real_escape_string($conn,$_POST['userID']);
	}else{
 		$valid = false;
 		$error .= "* Worker ID is required.\n";
 		$userID = '';
	}
	
	if(isset($_POST['timeSched']) && !empty($_POST['timeSched'])){
		$timeSched = mysqli_real_escape_string($conn,$_POST['timeSched']);
	}else{
 		$valid = false;
 		$error .= "* Time Sched is required.\n";
 		$timeSched = '';
	}

	if(isset($_POST['dateSched']) && !empty($_POST['dateSched'])){
		$dateSched = mysqli_real_escape_string($conn,$_POST['dateSched']);
	}else{
 		$valid = false;
 		$error .= "* Date Sched is required.\n";
 		$dateSched = '';
	}

	if(isset($_POST['status']) && !empty($_POST['status'])){
		$status = mysqli_real_escape_string($conn,$_POST['status']);
	}else{
 		$valid = false;
 		$error .= "* Status is required.\n";
 		$status = '';
	}

	$sql1 = "SELECT * FROM workers WHERE userID = '$userID'";
	$query1 = mysqli_query($conn, $sql1);
	$rows = mysqli_num_rows($query1);

	if ($rows > 0) {
		if($valid){
 			$sql = "INSERT INTO schedules(schedID, jobworkerID, workerID, clientID, timeSched, dateSched, schedType, status) VALUES (NULL, '$jobworkerID', '$userID', '$clientID', '$timeSched', '$dateSched', 'applying', '$status')";
 			
 			$query = mysqli_query($conn, $sql);
 			
 				if($query){
 					$data = array("valid"=>true, "msg"=>"Data successfully inserted.");
 					echo json_encode($data);
 				}else{
 					$data = array("valid"=>false, "msg"=>"Data not inserted.");
 					echo json_encode($data);
 				}	
		}else{
 			$resp = [];
 			$resp = array("valid"=>false, "msg"=>$error);
 			echo json_encode($resp);
		}
	}else{
		$data = array("valid"=>false, "msg"=>"You must add a work profile first.");
 		echo json_encode($data);
	}
?>
