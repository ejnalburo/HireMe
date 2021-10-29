<?php 

// type your code here

 include 'config.php';

$jobID ='';


	
 	if(isset($_POST['jobID']) && !empty($_POST['jobID'])){
 		$jobID = $_POST['jobID'];
 	}


	$sql = "SELECT jobDetails FROM jobs WHERE jobID = '$jobID'";
	$query = mysqli_query($conn, $sql);

	if($query){
 		$data = mysqli_fetch_assoc($query);
 		echo json_encode($data);
 	} 
?>