
<?php 

 include 'config.php';
 
if (mysqli_connect_errno()) 
	{    
		die ('Failed to connect to MySQL: ' . mysqli_connect_error()) ; 
	} 
 
if (!isset($_POST['username'], $_POST['password'], $_POST['lastname'], $_POST['firstname'], $_POST['userType'], $_POST['email'], $_POST['phone'], $_POST['lat'], $_POST['lng'])) 
	{   
		$error .= "Please complete the registration form.\n";
	} 

	if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['lastname']) || empty($_POST['firstname']) || empty($_POST['userType']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['lat']) || empty($_POST['lng'])) 
	{  
		$error .= "Please complete the registration form.\n";
	} 
 

	if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 8) 
	{  
		$error .= "Password must be between 8 and 20 characters long!\n";
	} 
 
	if ($stmt = $conn->prepare('SELECT userID, password FROM users WHERE username = ?')) 
		{  
			//  (s = string, i = int, b = blob, etc),  

			 $stmt->bind_param('s', $_POST['username']);  
			 $stmt->execute();  
			 $stmt->store_result();  
			  if ($stmt->num_rows > 0) 
			  {   
			  	echo "<script>alert('Username Exists! Please choose another.');document.location.href='register.php'</script>/n";  
			  } 

			  else 
			  {   
			   if ($stmt = $conn->prepare('INSERT INTO users (username, password, lastname, firstname, userType, email, phone, lat, lng) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)')) 
			   	{        
			   		$password = md5($_POST['password']); //PASSWORD_DEFAULT     
			   		$stmt->bind_param('sssssssss', $_POST['username'], 
			   		$password, $_POST['lastname'], $_POST['firstname'], $_POST['userType'], $_POST['email'], $_POST['phone'], $_POST['lat'], $_POST['lng']);   
			   		$stmt->execute();
			   		echo "<script>alert('Registered Successfully!');document.location.href='index.php'</script>/n";
			   }	
			   else 
			   	{        
			   		
			   		$resp = [];
 					$resp = array("valid"=>false, "msg"=>$error);
 					echo json_encode($resp);
			   	}  
			  }  

			  $stmt->close(); 
			   	
		} 
			   

	else 
		{    
			echo 'Could not prepare statement!'; 
			$resp = [];
 			$resp = array("valid"=>false, "msg"=>$error);
 			echo json_encode($resp);
		} 
			 $conn->close(); 
?> 