<!--===== USER SESSION =====-->
<?php
error_reporting(0);
session_start();
if($_SESSION['username']=="" || $_SESSION['userType']!="Client") {
    header("Location: index.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">

	<!--===== WEBSITE ICON =====-->
	<link rel="icon" type="image/png" href="images/icon1.ico"/>

	<title>Hire Me</title>

	<!--===== CSS SOURCES =====-->
	<link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css?ts=<?=time()?>">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css?ts=<?=time()?>">
</head>

<body>


	<input type="checkbox" id="nav-toggle">

	<?php include 'sidebar_client.php';?>

	<div class="main-content">

		<!--===== NAVBAR =====-->
		<header>
			<h2>
				<label for="nav-toggle">
					<span class="bx bx-menu"></span>
				</label>
				Account Settings
			</h2>

			<div class="user-wrapper">
				<?php 
					if($_SESSION['profile'] == ""){
						echo "<img src='images/account.png' width='40px' height='40px' alt=''>";
					}else{
						echo "<img src='".$_SESSION['profile']."' width='40px' height='40px' alt=''>";
					}
				?>
				<div>
					<h4><?php echo $_SESSION['firstname'];?></h4>
					<small><?php echo $_SESSION['userType'];?></small>
				</div>
			</div>
		</header>

		<main>
			<!--===== MAIN CONTENTS =====-->
			

				<div class="row">
            <div class="col-md-12">
              <br>
              <form role="form" method="post" action="updateAccount.php" enctype="multipart/form-data">
                <input type="hidden" name="rid" id="rid">
                <div class="row">
                  <div class="col-md-4">
                	<?php 
						if($_SESSION['profile'] == ""){
							echo "<center><img src='images/account.png' style='margin-bottom: 20px; border-radius: 100px 100px; padding: 4px 4px; height: 200px; width: 200px; background-position: center; background-size: cover' id='account_img'></center>";
						}else{
							echo "<center><img src='".$_SESSION['profile']."' style='margin-bottom: 20px;border-radius: 100px 100px; padding: 4px 4px; height: 200px; width: 200px; background-position: center; background-size: cover' id='account_img'></center>";
						}
					?>
                    
                    <div style="margin-left:58px; margin-bottom: 1rem;"><input style="" disabled="" type="file" name="profile" id="addPhoto" accept="image/jpeg" /></div>
                	</div>
                  <div class="col-md-4">
                    <script>
                    </script>
                    <label for="firstName" class="control-label">First Name</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" required="" readonly="" value="<?php echo $_SESSION['firstname']?>">
                    <br>         
                    <label for="lastName" class="control-label">Last Name</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" required="" readonly="" value="<?php echo $_SESSION['lastname']?>">
                    <br>
                    <label for="phone" class="control-label">Phone No.</label>
                    <input type="text" class="form-control" required="" readonly="" name="phone" id="phone" value="<?php echo $_SESSION['phone']?>">
                    <br>                 
                  </div>
                  <div class="col-md-4">
                    <label for="username" class="control-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required="" readonly="" value="<?php echo $_SESSION['username']?>">
                    <br>
                    <label for="userType" class="control-label">User Type</label>
                    <input type="text" class="form-control" name="userType" id="userType" required="" readonly="" value="<?php echo $_SESSION['userType']?>">
                    <br>
                    <label for="email" class="control-label">Email Address</label>
                    <input type="text" class="form-control" required="" readonly="" name="email" id="email" value="<?php echo $_SESSION['email']?>">
                    <br>
                  </div>
                  <div class="col-md-4">
                    
                  </div> 
                  <div class="col-md-4">
                    

                  <div class="row templatemo-form-buttons">
                  <div class="pull-right">
                  <div class="col-md-12">
                  <button type="button" class="btn btn-warning" onclick="caa()" id="undo" style="visibility: hidden;">Undo</button>
                  <button type="button" onclick="cll()" id="changee" class="btn btn-primary">Change</button>
                  <button type="submit" class="btn btn-success" id="updates" disabled="">Update</button>
                  </div>
                  </div>
                  </div>
                  </div>
                </div>
            </form>
          </div>
        </div>

				<!--===== JOBS CREATED DIV =====-->
			<div class="recent-grid-account">
				<div class="jobs">
					<div class="card">
						<div class="card-header">
							<h3>Personal Information</h3>
						</div>
						<div class="card-body-account">
									
							<div class="table-responsive">
								<table width="100%">
									<tbody>
									<?php
										include 'config.php';
										$userID = $_SESSION['userID'];

										$sql = "SELECT * FROM users  WHERE userID = '$userID'";
                    
                    					$query =  mysqli_query($conn, $sql);
                    					$rows = mysqli_num_rows($query);

                    					if($rows>0) {
                        					while($data = mysqli_fetch_array($query)) {
										?>
										<tr>
											<td><h4>First Name:</h4><h4 style="margin-left: 1rem;"></h4><?php echo $data['firstname'];?></td>
										</tr>
										<tr>
											<td><h4>Last Name:</h4><h4 style="margin-left: 1rem;"></h4><?php echo $data['lastname'];?></td>
										</tr>
										<tr>
											<td><h4>Username:</h4><h4 style="margin-left: 1rem;"></h4><?php echo $data['username'];?></td>
										</tr>
										<tr>
											<td><h4>Email Address:</h4><h4 style="margin-left: 1rem;"></h4><?php echo $data['email'];?></td>
										</tr>
										<tr>
											<td><h4>Phone No.:</h4><h4 style="margin-left: 1rem;"></h4><?php echo $data['phone'];?></td>
										</tr>
										<tr>
											<td><h4>User Type:</h4><h4 style="margin-left: 1rem;"></h4><?php echo $data['userType'];?></td>
										</tr>
										<?php
											}
										}	
									?>	
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="jobs">
					<div class="card">
						<div class="card-header">
							<h3>Rating</h3>
						</div>
						<div class="card-body-account">
									
							<div class="table-responsive">
								<table width="100%">
									<tbody>
									<?php
										include 'config.php';
										$userID = $_SESSION['userID'];

										$sql = "SELECT * FROM users WHERE userID = '$userID'";
                    
                    					$query =  mysqli_query($conn, $sql);
                    					$rows = mysqli_num_rows($query);

                    					if($rows>0) {
                        					while($data = mysqli_fetch_array($query)) {
										?>
										<tr>
											<td><h4 style="margin-right: 1rem;">Overall Rating: </h4><h5>(4.7/5)</h5><span class="bx bxs-star star"><span class="bx bxs-star star"><span class="bx bxs-star star"><span class="bx bxs-star star"><span class="bx bxs-star-half star"></span></td>
										</tr>
										<?php
											}
										}	
									?>	
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="card" style="margin-top: 1rem;">
						<div class="card-header">
							<h3>Reviews</h3>
							<button type="button" id="createJob">View all reviews <span class="bx bx-right-arrow-alt"></span></button>
						</div>
						<div class="card-body-account">
									
							<div class="table-responsive">
								<table width="100%">
									<tbody>
									<?php
										include 'config.php';
										$userID = $_SESSION['userID'];

										$sql = "SELECT * FROM users WHERE userID = '$userID'";
                    
                    					$query =  mysqli_query($conn, $sql);
                    					$rows = mysqli_num_rows($query);

                    					if($rows>0) {
                        					while($data = mysqli_fetch_array($query)) {
										?>
										<tr>
											<td style="width: 10rem;"><h4>Marty Bernido(5/5)</h4><br>
												<span class="bx bxs-star star"><span class="bx bxs-star star"><span class="bx bxs-star star"><span class="bx bxs-star star"><span class="bx bxs-star star"></span></td>
											<td><p style="margin-left: 1rem;">Madali lang po kausap si sir. Hindi rin madamot. Salamat sa paghire po. Sana maserbisyohan pa kita sa susunod.</p></td>
										</tr>

										<?php
											}
										}	
									?>	
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
</body>

<!--===== JAVASCRIPT SOURCES =====-->
<script src="js/bootstrap.js?ts=<?=time()?>"></script>
<script src="js/jquery.js?ts=<?=time()?>"></script>
<script src="js/sweetalert2.js?ts=<?=time()?>"></script>

<!--===== MAIN SCRIPTS =====-->
<script>
	$(document).ready( function () {
		$("#client_account").attr({
			'class' : 'active'
		})
  	});
	

	$(function() {
  		function getBase64(file) {
    		var reader = new FileReader();
    		reader.readAsDataURL(file);
    		
    		reader.onload = function() {
      			console.log(reader.result);
      
      			$("#account_img").attr({
        			"src":  reader.result 
      			});
    		};
    
    		reader.onerror = function(error) {
      			console.log('Error: ', error);
    		};
  		}
  		$("#addPhoto").change(function() {
    		getBase64(this.files[0]);
  		});
	});

	function logout() {
		Swal.fire({
            title: 'Are you sure you want to sign out?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = "logout.php";
            }
        });
	}

	function cll(){
		$("#firstname").attr({
    		"readonly" : false
  		});
  
  		$("#lastname").attr({
    		"readonly" : false
  		});
  
  		$("#username").attr({
    		"readonly" : false
  		});
    
    	$("#email").attr({
    		"readonly" : false
  		});
  
  		$("#phone").attr({
    		"readonly" : false
  		});

  		document.getElementById('undo').style.visibility = 'visible';
  		document.getElementById('changee').disabled = true;
  		document.getElementById('updates').disabled = false;
  		document.getElementById('addPhoto').disabled = false;
	}

	function caa(){
  		window.location.reload();
  		document.getElementById('changee').disabled = false;
  		document.getElementById('addPhoto').disabled = true;
  		document.getElementById('updates').disabled = true;
	}
</script>
</html>