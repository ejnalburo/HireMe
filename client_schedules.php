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
				Schedules
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

			<!--===== DASHBOARD CARDS =====-->
			<div class="dashboard-cards">
				<div class="card-single">
					<div>
						<h1>4.7/5</h1>
						<span>Overall Rating</span>
					</div>
					<div>
						<span class="bx bx-star"></span>
					</div>
				</div>

				<div class="card-single">
					<div>
						<h1>4</h1>
						<span>Upcoming Schedules</span>
					</div>
					<div>
						<span class="bx bx-calendar-event"></span>
					</div>
				</div>

				<div class="card-single">
					<div>
						<h1>4</h1>
						<span>Completed Schedules</span>
					</div>
					<div>
						<span class="bx bx-calendar-check"></span>
					</div>
				</div>

				<div class="card-single">
					<div>
						<h1>0</h1>
						<span>Cancelled Schedules</span>
					</div>
					<div>
						<span class="bx bx-calendar-x"></span>
					</div>
				</div>
			</div>

			<!--===== MAIN CONTENTS =====-->
			<div class="recent-grid-schedule">

				<!--===== UPCOMING SCHEDULES DIV =====-->
				<div class="jobs">
					<div class="card">
						<div class="card-header">
							<h3>Upcoming Schedules</h3>
						</div>
						
						<div class="card-body">
							<div class="table-responsive">
								<table width="100%">
									<thead>
										<tr>
											<td>Date</td>
											<td>Job Desc.</td>
											<td>Worker</td>
											<td>Actions</td>
										</tr>
									</thead>
									<tbody>
										<?php
											include 'config.php';
												$userID = $_SESSION['userID'];

												$sql1 = "SELECT DAYNAME(a.dateSched) as day, a.dateSched as dateSched, a.timeSched as timeSched, b.jobTitle as jobTitle, b.rate as rate, c.firstname as firstname, c.lastname as lastname from schedules a, workers b, users c WHERE a.clientID = '$userID' AND a.jobworkerID = b.workerID AND b.userID = c.userID AND a.status = 'accepted' GROUP BY schedID ORDER BY a.dateSched, a.timeSched asc";
												
												$query1 = mysqli_query($conn, $sql1);
												$rows1 = mysqli_num_rows($query1);
												if($rows1 > 0){
												while ($data1 = mysqli_fetch_array($query1)){
										?>

										<tr>
											<td>
												<h2 style="color: var(--main-color);"><?php echo $data1['dateSched'];?></h2>
												<h4 style="color: #6b705c;"><?php echo $data1['day'];?></h4>
											</td>
											<td>
												<h4><?php echo $data1['jobTitle'];?></h4>
												<h5 style="color: #6b705c;"><?php echo $data1['timeSched'];?></h5>
											</td>
											<td>
												<h4><?php echo $data1['firstname']." ".$data1['lastname'];?></h4>
												<h5 style="color: #6b705c;"><?php echo $data1['rate'];?></h5>
											</td>
											<td style="align-items: center; display: flex; margin-top: 10px;">
												<a href="" style="text-decoration: none;"><i class='bx bx-edit-alt' style="font-size: 25px;color: var(--main-color); margin-right: 5px;" title="Reschedule"></i></a>
												<a href="" style="text-decoration: none;"><i class="bx bx-x-circle" style="font-size: 25px; color: var(--main-color);" title="Cancel Schedule">
												</i></a>
											</td>
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

				<!--===== COMPLETED SCHEDULES DIV =====-->
				<div class="jobs">
					<div class="card">
						<div class="card-header">
							<h3>Completed Schedules</h3>
						</div>
						
						<div class="card-body">
							<div class="table-responsive">
								<table width="100%">
									<thead>
										<tr>
											<td>Date</td>
											<td>Events</td>
											<td>Worker</td>
											<td>Actions</td>
										</tr>
									</thead>
									<tbody>

										
										
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
		$("#client_schedules").attr({
			'class' : 'active'
		})
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
</script>
</html>