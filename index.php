
<?php
error_reporting(0);
session_start();
if($_SESSION['userType']=="Client") {
    header("Location: client_index.php");
}

elseif ($_SESSION['userType']=="Skilled Worker") {
    header("Location: worker_index.php");
}



?>  

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Hire Me</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css?ts=<?=time()?>">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css?ts=<?=time()?>">
<!--===============================================================================================-->
</head>
<body>
		<center>
	<div class="recent-grid-login">
		<div class="login">
			<div class="card">
				<div class="login-body">
				<form class="form-group" method="post">
					<center>
					<img class="login-img" src="images/logo1.png">
					</center>
					<h1 class="login-text" style="color: var(--main-color);">
						Log In to Hire Me
					</h1>

					<div style="margin-bottom: 20px; margin-top: 3rem;">
						<input class="form-control" style="max-width: 500px;" autocomplete="off" type="text" name="username" placeholder="Username" required="">
					</div>


					<div style="margin-bottom: 20px;">
						<input class="form-control" style="max-width: 500px;" type="password" name="password" placeholder="Password" required="">
					</div>

					<div style="margin-bottom: 20px;">
						 <input type="submit" style="max-width: 500px;" style="border-radius: 2px; width: 100%;" name="login" value="Log in" class="btn btn-success">
					</div>

					<div class="text-center" style="margin-top: 20px;">
						<span class="txt1">
							Create an account?
						</span>

						<a href="register.php" class="txt2 hov1">
							Sign up
						</a>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
	</center>
	

	
<!--===============================================================================================-->
	<script src="js/bootstrap.js?ts=<?=time()?>"></script>
	<script src="js/jquery.js?ts=<?=time()?>"></script>
<script src="js/sweetalert2.js?ts=<?=time()?>"></script>

</body>
<script>
<?php
session_start();
include 'config.php';

if (isset($_POST['login'])) 
{
  $username = addslashes(trim($_POST['username']));
  $password = md5($_POST['password']);

  $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
  if (mysqli_num_rows($query) == 0) 
  {
    ?>
    Swal.fire({
          title: 'Error!',
          text: 'No user found in this account! Please try again!',
          icon: 'warning',
          footer: '<h5>Please fill in all fields!</h5>'
        }).then(function() {
          window.location = "index.php";
        });
    <?php
  }else{
    $row = mysqli_fetch_assoc($query);
    $_SESSION['userID'] = $row['userID'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['userType']  = $row['userType'];
    $_SESSION['firstname']  = $row['firstname'];
    $_SESSION['lastname']  = $row['lastname'];
    $_SESSION['profile']  = $row['profile'];
    $_SESSION['phone']  = $row['phone'];
    $_SESSION['email']  = $row['email'];

    if($row['userType'] == "Client")
    { 

      ?>
         Swal.fire({
          title: 'Login Successful!',
          text: 'You will be redirected to Client Panel',
          icon: 'success',
        }).then(function() {
          window.location = "client_index.php";
        });
         
      <?php
    }
    else if($row['userType'] =="Skilled Worker")
    {
      ?>
         Swal.fire({
          icon: 'success',
          title: 'Login Successful!',
          text: 'You will be redirected to Skilled Worker Panel'
        }).then(function() {
          window.location = "worker_index.php";
        });
         
      <?php
    }
    else
    {
      ?>
         Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: ''
        }).then(function() {
          window.location = "index.php";
        });
         
      <?php
    }
  }
}else{
}
?>

</script>
</html>