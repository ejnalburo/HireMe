<!--===== USER SESSION =====-->
<?php
error_reporting(0);
session_start();
if($_SESSION['username']=="" || $_SESSION['userType']!="Client") {
    header("Location: index.php");
    die();
}

include 'config.php';
	$sql = "SELECT COUNT(categoryID) as acad FROM workers WHERE categoryID = '1'";        
    $query =  mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($query);

    $sql1 = "SELECT COUNT(categoryID) as fin FROM workers WHERE categoryID = '2'";
    $query1 =  mysqli_query($conn, $sql1);
    $data1 = mysqli_fetch_array($query1);

    $sql2 = "SELECT COUNT(categoryID) as hand FROM workers WHERE categoryID = '3'";
    $query2 =  mysqli_query($conn, $sql2);
    $data2 = mysqli_fetch_array($query2);

    $sql3 = "SELECT COUNT(categoryID) as health FROM workers WHERE categoryID = '4'";
    $query3 =  mysqli_query($conn, $sql3);
    $data3 = mysqli_fetch_array($query3);

    $sql4 = "SELECT COUNT(categoryID) as person FROM workers WHERE categoryID = '5'";
    $query4 =  mysqli_query($conn, $sql4);
    $data4 = mysqli_fetch_array($query4);

    $sql5 = "SELECT COUNT(categoryID) as rec FROM workers WHERE categoryID = '6'";
    $query5 =  mysqli_query($conn, $sql5);
    $data5 = mysqli_fetch_array($query5);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
	<link rel="icon" type="image/png" href="images/icon1.ico"/>
	<title>Hire Me</title>

	<link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css?ts=<?=time()?>">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css?ts=<?=time()?>">
</head>
<body>
	<input type="checkbox" id="nav-toggle">
	<?php include 'sidebar_client.php';?>

	<div class="main-content">
		<header>
			<h2>
				<label for="nav-toggle">
					<span class="bx bx-menu"></span>
				</label>
				Categories
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

			<div class="dashboard-cards">
				<a href="academic_worker.php" style="text-decoration: none; color:#000;">
				<div class="card-category">
					<div>
						<h1><?php echo $data['acad'];?></h1>
						<span>Academic Services</span>
					</div>
					<div>
						<span class=""><img src="images/academic.png"></span>
					</div>
				</div>
				</a>

				<a href="financial_worker.php" style="text-decoration: none; color:#000;">
				<div class="card-category">
					<div>
						<h1><?php echo $data1['fin'];?></h1>
						<span>Financial Services</span>
					</div>
					<div>
						<span class=""><img src="images/financial.png"></span>
					</div>
				</div>
				</a>

				<a href="handyman_worker.php" style="text-decoration: none; color:#000;">
				<div class="card-category">
					<div>
						<h1><?php echo $data2['hand'];?></h1>
						<span>Handyman Services</span>
					</div>
					<div>
						<span class=""><img src="images/handyman.png"></span>
					</div>
				</div>
				</a>

				<a href="healthcare_worker.php" style="text-decoration: none; color:#000;">
				<div class="card-category">
					<div>
						<h1><?php echo $data3['health'];?></h1>
						<span>Health Care Services</span>
					</div>
					<div>
						<span class=""><img src="images/professional.png"></span>
					</div>
				</div>
				</a>

				<a href="personal_worker.php" style="text-decoration: none; color:#000;">
				<div class="card-category">
					<div>
						<h1><?php echo $data4['person'];?></h1>
						<span>Personal Services</span>
					</div>
					<div>
						<span class=""><img src="images/personal.png"></span>
					</div>
				</div>
				</a>

				<a href="sport_worker.php" style="text-decoration: none; color:#000;">
				<div class="card-category">
					<div>
						<h1><?php echo $data5['rec'];?></h1>
						<span>Sports Services</span>
					</div>
					<div>
						<span class=""><img src="images/sports.png"></span>
					</div>
				</div>
				</a>
			</div>

			<!--
			<div class="recent-grid">
				<div class="jobs">
					<div class="card">
						<div class="card-header">
							<h3>Jobs Created</h3>

							<button>Add New Job <span class="bx bx-right-arrow-alt"></span></button>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table width="100%">
									<thead>
										<tr>
											<td>Category</td>
											<td>Bus. Name</td>
											<td>Job Title</td>
											<td>Location</td>
											<td>Status</td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Personal</td>
											<td>EJ Barbershop</td>
											<td>Barber</td>
											<td>New Pandan, Panabo City</td>
											<td>Hiring</td>
										</tr>
										<tr>
											<td>Sports</td>
											<td>None</td>
											<td>Zumba Instructor</td>
											<td>New Malitbog, Panabo City</td>
											<td>Hiring</td>
										</tr>
										<tr>
											<td>Handyman</td>
											<td>DB Builders</td>
											<td>Construction Worker</td>
											<td>New Visayas, Panabo City</td>
											<td>Closed</td>
										</tr>
										<tr>
											<td>Handyman</td>
											<td>DB Builders</td>
											<td>Construction Worker</td>
											<td>New Visayas, Panabo City</td>
											<td>Closed</td>
										</tr>
										<tr>
											<td>Handyman</td>
											<td>DB Builders</td>
											<td>Construction Worker</td>
											<td>New Visayas, Panabo City</td>
											<td>Hiring</td>
										</tr>
										<tr>
											<td>Handyman</td>
											<td>DB Builders</td>
											<td>Construction Worker</td>
											<td>New Visayas, Panabo City</td>
											<td>Hiring</td>
										</tr>
										<tr>
											<td>Handyman</td>
											<td>DB Builders</td>
											<td>Construction Worker</td>
											<td>New Visayas, Panabo City</td>
											<td>Closed</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="workers">
					<div class="card">
						<div class="card-header">
							<h3>Workers Hired</h3>

							<button>See All <span class="bx bx-right-arrow-alt"></span></button>
						</div>
						<div class="card-body">
							<div class="worker">
								<div class="info">
									<img src="images/person_1.jpg" width="40px" height="40px" alt="">
									<div>
										<h4>Dhave Salazar</h4>
										<small>Welder</small>
									</div>
								</div>
								<div class="contact">
									<span class="bx bx-user-circle" title="View Profile"></span>
									<span class="bx bx-star" title="Rate Worker"></span>
									<span class="bx bx-message-dots" title="Message Worker"></span>
								</div>
							</div>

							<div class="worker">
								<div class="info">
									<img src="images/person_2.jpg" width="40px" height="40px" alt="">
									<div>
										<h4>Marty Bernido</h4>
										<small>Barber</small>
									</div>
								</div>
								<div class="contact">
									<span class="bx bx-user-circle" title="View Profile"></span>
									<span class="bx bx-star" title="Rate Worker"></span>
									<span class="bx bx-message-dots" title="Message Worker"></span>
								</div>
							</div>

							<div class="worker">
								<div class="info">
									<img src="images/person_3.jpg" width="40px" height="40px" alt="">
									<div>
										<h4>Evelyn Elegano</h4>
										<small>Zumba Instructor</small>
									</div>
								</div>
								<div class="contact">
									<span class="bx bx-user-circle" title="View Profile"></span>
									<span class="bx bx-star" title="Rate Worker"></span>
									<span class="bx bx-message-dots" title="Message Worker"></span>	
								</div>
							</div>

							<div class="worker">
								<div class="info">
									<img src="images/person_3.jpg" width="40px" height="40px" alt="">
									<div>
										<h4>Evelyn Elegano</h4>
										<small>Zumba Instructor</small>
									</div>
								</div>
								<div class="contact">
									<span class="bx bx-user-circle" title="View Profile"></span>
									<span class="bx bx-star" title="Rate Worker"></span>
									<span class="bx bx-message-dots" title="Message Worker"></span>	
								</div>
							</div>

							<div class="worker">
								<div class="info">
									<img src="images/person_3.jpg" width="40px" height="40px" alt="">
									<div>
										<h4>Evelyn Elegano</h4>
										<small>Zumba Instructor</small>
									</div>
								</div>
								<div class="contact">
									<span class="bx bx-user-circle" title="View Profile"></span>
									<span class="bx bx-star" title="Rate Worker"></span>
									<span class="bx bx-message-dots" title="Message Worker"></span>	
								</div>
							</div>

							<div class="worker">
								<div class="info">
									<img src="images/person_3.jpg" width="40px" height="40px" alt="">
									<div>
										<h4>Evelyn Elegano</h4>
										<small>Zumba Instructor</small>
									</div>
								</div>
								<div class="contact">
									<span class="bx bx-user-circle" title="View Profile"></span>
									<span class="bx bx-star" title="Rate Worker"></span>
									<span class="bx bx-message-dots" title="Message Worker"></span>	
								</div>
							</div>

							<div class="worker">
								<div class="info">
									<img src="images/person_3.jpg" width="40px" height="40px" alt="">
									<div>
										<h4>Evelyn Elegano</h4>
										<small>Zumba Instructor</small>
									</div>
								</div>
								<div class="contact">
									<span class="bx bx-user-circle" title="View Profile"></span>
									<span class="bx bx-star" title="Rate Worker"></span>
									<span class="bx bx-message-dots" title="Message Worker"></span>	
								</div>
							</div>

							<div class="worker">
								<div class="info">
									<img src="images/person_3.jpg" width="40px" height="40px" alt="">
									<div>
										<h4>Evelyn Elegano</h4>
										<small>Zumba Instructor</small>
									</div>
								</div>
								<div class="contact">
									<span class="bx bx-user-circle" title="View Profile"></span>
									<span class="bx bx-star" title="Rate Worker"></span>
									<span class="bx bx-message-dots" title="Message Worker"></span>	
								</div>
							</div>
						</div>
					</div>
				</div>	
			</div>-->
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
		$("#client_categories").attr({
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
</script>a
</html>