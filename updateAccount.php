<?php
session_start();
include 'config.php';

$userID = $_SESSION['userID'];
$username = $_POST['username'];
$profile = $_FILES['profile']['name'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];
$email = $_POST['email'];

	$sqll = "SELECT username FROM users WHERE username = '$username' AND userID != '$userID'";
	$queryy = mysqli_query($conn, $sqll);
	$rowss = mysqli_num_rows($queryy);
		
		if ($rowss>0) {
	 		echo "<script>alert('Username Exists! Please try another.');document.location.href='client_account.php'</script>/n";
			die();
		}else {
			$username = $username;
		}

		if($profile==""){
			$sql = "UPDATE users SET username = '$username', firstname = '$firstname', lastname = '$lastname', email = '$email', phone = '$phone' WHERE userID = '$userID'";
				$query = mysqli_query($conn, $sql);

				if($query)	{
 					session_destroy();

 					echo "<script>alert('Account Updated! Please log in to continue');document.location.href='index.php'</script>";
					die();
 				}else {
					echo "Error 3";
				}
		}else{
			$ext = strtolower(pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION));
			$encoded_image = base64_encode(file_get_contents($_FILES['profile']['tmp_name']));
			$encoded_image = 'data:image/' . $ext . ';base64,' . $encoded_image;

				$sql = "UPDATE users SET profile = '$encoded_image', username = '$username', firstname = '$firstname', lastname = '$lastname', email = '$email', phone = '$phone' WHERE userID = '$userID'";
				$query = mysqli_query($conn, $sql);

				if($query)	{
 					session_destroy();

 					echo "<script>alert('Account Updated! Please log in to continue');document.location.href='index.php'</script>";
					die();
 				}else {
					echo "Error 3";
				}
		}
?>