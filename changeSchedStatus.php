<?php 

// type your code here

 include 'config.php';

	$schedID = '';


 	if(isset($_POST['schedID']) && !empty($_POST['schedID'])){
 		$schedID = mysqli_real_escape_string($conn,$_POST['schedID']);
 	}else{
	}


	$sql = "UPDATE schedules SET status = 'accepted' WHERE schedID = '$schedID'";
	$query = mysqli_query($conn, $sql);

 		if($query){
 			$data = array("valid"=>true, "msg"=>"Data successfully inserted.");
 				echo json_encode($data);
 			}else{
 				$data = array("valid"=>false, "msg"=>"Data not inserted.");
 					echo json_encode($data);
 			}	


?>