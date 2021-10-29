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
				About PESO Panabo
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
						<h3>Fb Page</h3>
						<a href="https://www.facebook.com/pesopanaboOfficialPage/?ref=page_internal" target="_blank"><span>Click here to visit page</span></a>
					</div>
					<div>
						<span class="bx bxl-facebook-circle"></span>
					</div>
				</div>

				<div class="card-single">
					<div>
						<h3>Tel No.</h3>
						<span>(084) 822 6210</span>
					</div>
					<div>
						<span class="bx bxs-phone-call"></span>
					</div>
				</div>

				<div class="card-single">
					<div>
						<h3>Yahoo</h3>
						<span>pesopanabo @yahoo.com</span>
					</div>
					<div>
						<span class="bx bxs-envelope"></span>
					</div>
				</div>

				<div class="card-single">
					<div>
						<h3>Line</h3>
						<span>0948-271-9758</span>
					</div>
					<div>
						<span class='bx bxs-message-rounded-dots'></span>
					</div>
				</div>
			</div>

			<div class="recent-grid-category">

				<div class="jobs">
					<div class="card">
						<div class="card-header-category">
							<h3><span class="bx bx-info-circle"></span>&nbsp;What is PESO?
								<br />
							</h3>
						</div>

						<div class="card-body">	
							<div class="table-responsive">
								<table width="100%">
									<tbody>
										<tr>
											<td>
												<p>The Public Employment Service Office or PESO is a non-fee charging multi-employment service facility or entity established or accredited pursuant to Republic Act No. 8759 otherwise known as the PESO Act of 1999.</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>To carry out full employment and equality of employment opportunities for all, and for this purpose, to strengthen and expand the existing employment facilitation service machinery of the government particularly at the local levels there shall be established in all capital towns of provinces, key cities, and other strategic areas a Public Employment Service Office, Hereinafter referred to as PESO, which shall be community-based and maintained largely by local government units (LGUs) and a number of non-governmental organizations (NGOs) or community-based organizations (CBOs) and state universities and colleges (SUCs). The PESOs shall be linked to the regional offices of the Department of Labor and Employment (DOLE) for coordination and technical supervision, and to the DOLE central office, to constitute the national employment service network.</p>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="jobs">
					<div class="card">
						<div class="card-header-category">
							<h3>
								<h3><span class="bx bx-info-circle"></span>&nbsp; What are the objectives of PESO?
								</h3>
							</h3>
						</div>

						<div class="card-body">	
							<div class="table-responsive">
								<table width="100%">
									<tbody>
										<tr>
											<td>
												<h3>General Objective:</h3>
											</td>
											<td>
												<p>- Ensure the prompt, timely and efficient delivery of employment service and provision of information on the other DOLE programs.</p>
											</td>
										</tr>
										<tr>
											<td rowspan="2"></td>
										</tr>

										<tr>
											<td>
												<h3>Specific Objective:</h3>
											</td>
											<td>
												<p>- Provide a venue where people could explore simultaneously various employment options and actually seek assistance they prefer;</p>
											</td>
										</tr>
										<tr>
											<td>
											</td>
											<td>	
												<p>- Provide clients with adequate information on employment and labor market situation in the area; and</p>
											</td>
										</tr>
										<tr>
											<td>
											</td>
											<td>
												<p>- Network with other PESOs within the region on employment for job exchange purposes. </p>
											</td>
										</tr>
										<tr>
											<td>
											</td>
											<td>
												<p>- Serve as referral and information center for the various services and programs of DOLE and other government agencies present in the area;</p>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="recent-grid-category">

				<div class="jobs">
					<div class="card">
						<div class="card-header-category">
							<h3>
								<h3><span class="bx bx-info-circle"></span>&nbsp; What are the functions of the PESO?
								</h3>
							</h3>
						</div>

						<div class="card-body">	
							<div class="table-responsive">
								<table width="100%">
									<tbody>
										<tr>
											<td>
												<p>1. Encourage employers to submit to the PESO on a regular basis a list of job vacancies in their respective establishments in order to facilitate the exchange of labor market information services to job seekers and employers by providing employment services to job seeker, both for local and overseas employment, and recruitment assistance to employers;</p>
											</td>
										</tr>
										<tr>
											<td>	
												<p>2. Develop and administer testing and evaluation instruments for effective job selection, training and counseling;</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>3. Provide persons with entrepreneurship qualities access to the various livelihood and self-employment programs offered by both government and non-governmental organizations at the provincial/city/municipal/barangay levels by undertaking referrals for such programs;</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>4. Undertake employability enhancement trainings/seminar for jobseekers as well as those would like to change career or enhance their employability. This function is presently supervised by TESDA and conducted by other training;</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>5. Provide employment and occupational counseling, career guidance, mass motivation and values development activities;</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>6. Conduct pre-employment counseling and orientation to prospective local and overseas workers;</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>7. Provide reintegration assistance services to returning Filipino migrant workers: and</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>7. Perform such functions as willfully carry out the objectives of this Act. </p>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="jobs">
					<div class="card">
						<div class="card-header-category">
							<h3>
								<h3><span class="bx bx-info-circle"></span>&nbsp; What are the special services of PESO? 
								</h3>
							</h3>
						</div>

						<div class="card-body">	
							<div class="table-responsive">
								<table width="100%">
									<tbody>
										<tr>
											<td>
												<p>1. Jobs Fairs - these shall be conducted periodically all over the country to bring together in one venue job seekers and employers for immediate matching;</p>
											</td>
										</tr>
										<tr>
											<td>	
												<p>2. Livelihood and Self-employment Bazaars - these will give clients information on the array of livelihood programs they choose to avail of, particularly in the rural areas;</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>3. Special Credit Assistance for Placed Overseas Workers - this type of assistance will enable poor but qualified applicants to avail of opportunities for overseas employment;</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>4. Special Program for Employment of Students and Out-of-School Youth (SPESOS) - this program shall endeavor to provide employment to deserving students and out-of-school youths and out-of-school youths coming from poor families during summer and/or Christmas vacations as provided for under Republic Act No. 7323 and its implementing rules, to enable them to pursue their education;</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>5. Work Appreciation Program (WAP) - this program aims to develop the values of work appreciation and ethics by exposing the young to actual work situations;</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>6. Workers Hiring for Infrastructure Projects (WHIP) - this program is in pursuance of Republic Act No. 6685 which requires construction companies, including the Department of Public Works and Highways and contractor for government-funded infrastructure projects, to hire thirty percent (30%) of skilled and fifty percent (50%) of unskilled labor requirements from the areas where the project is constructed/located; and</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>7. Other programs/activities developed by DOLE to enhance provision of employment assistance to PESO clients, particularly for special groups of disadvantaged workers such as persons with disabilities (PWDs) and displaced workers.</p>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="recent-grid-category">

				<div class="jobs">
					<div class="card">
						<div class="card-header-category">
							<h3>
								<h3><span class="bx bx-info-circle"></span>&nbsp; Who are the PESO clients? 
								</h3>
							</h3>
						</div>

						<div class="card-body">	
							<div class="table-responsive">
								<table width="100%">
									<tbody>
										<tr>
											<td>
												<p>1. Jobseekers</p>
											</td>
										</tr>
										<tr>
											<td>	
												<p>2. Employers</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>3. Students</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>4. Out of School Youth</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>5. Migratory workers</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>6. Planners</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>7. Researchers</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>8. Labor Market Information Users</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>9. Persons with Disabilities (PWDs)</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>10. Returning Overseas Filipino Workers (OFWs)</p>
											</td>
										</tr>
										<tr>
											<td>
												<p>11. Displaced Workers</p>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div class="jobs">
					<div class="card">
						<div class="card-header-category">
							<h3>
								<h3><span class="bx bx-info-circle"></span>&nbsp; How to avail of PESO services?
								</h3>
							</h3>
						</div>

						<div class="card-body">	
							<div class="table-responsive">
								<table width="100%">
									<tbody>
										<tr>
											<td>
												<h3>For Employment Seekers:</h3>
											</td>
											<td>
												<p>- Report personally to PESO in your respective provincial, city, municipal, NGOs, CBOs or SUCs for registration and employment interview.</p>
											</td>
										</tr>

										<tr>
											<td>
												<h3>For Employers:</h3>
											</td>
											<td>
												<p>-  Inform nearest PESO of the vacancies for job matching.</p>
											</td>
										</tr>
										<tr>
											<td>
												<h3>For Researchers, Planners and LMI Users:</h3>
											</td>
											<td>	
												<p>- Inquire personally and secure available materials at nearest PESO.</p>
											</td>
										</tr>										
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
		$("#client_about").attr({
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