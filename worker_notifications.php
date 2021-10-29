<!--===== USER SESSION =====-->
<?php
error_reporting(0);
session_start();
if($_SESSION['username']=="" || $_SESSION['userType']!="Skilled Worker") {
    header("Location: index.php");
    die();
}
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
	<?php include 'sidebar_worker.php';?>

	<!-- View Profile Modal -->
			<div class="modal fade" id="viewProfileModal" tabindex="-1" aria-hidden="true">
  				
 				<div class="modal-dialog">
    				<div class="modal-content">

        				<form method="post">
      					<div class="modal-header">
        					<h3 class="modal-title" id="exampleModalLabel">Profile</h3>
        					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      					</div>
      					
      					<div class="modal-body">
        					<center>
        						<img id="view_profile" src="images/account.png" width="100px" height="100px;" style="border-radius: 50%;"><br>
        							
        					</center> 
                      		<input type="hidden" name="schedID" id="schedID">

        					<div class="form-group">
        						<label class="form-label"><b style="margin-right: 1rem;">Rating:</b></label><span class="bx bxs-star star"></span><span class="bx bxs-star star"></span><span class="bx bxs-star-half star"></span><span class="bx bx-star star"></span><span class="bx bx-star star"></span>
        					</div>
        						
        					<div class="form-group">
        						<label class="form-label"><b style="margin-right: 1rem;">Full Name:</b></label><span id="view_fullname"></span>
        					</div>

        					<div class="form-group">
        						<label class="form-label"><b style="margin-right: 1rem;">Location:</b></label><span id="view_location"></span>
        					</div>

      					</div>
      					
      					<div class="modal-footer">
      						<button type="button" id="acceptJob" class="btn btn-success">Accept Job</button>
        					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      					</div>
      					</form>
    				</div>
  				</div>
			</div>

	<div class="main-content">
		<header>
			<h2>
				<label for="nav-toggle">
					<span class="bx bx-menu"></span>
				</label>
				Notifications
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
			<div class="recent-grid-category">
				<?php
					include 'config.php';
					$userID = $_SESSION['userID'];

					$sql1 = "SELECT schedID from schedules WHERE workerID = '$userID' AND schedType = 'hiring' AND status = 'pending' GROUP BY schedID desc";
					$query1 = mysqli_query($conn, $sql1);
					$rows1 = mysqli_num_rows($query1);
					if($rows1 > 0){
						while ($data1 = mysqli_fetch_array($query1)){
						$schedID = $data1['schedID'];

					$sql = "SELECT a.schedID as schedID, c.userID as userID, b.categoryID as categoryID, c.firstname as firstname, c.lastname as lastname, d.jobTitle as jobTitle FROM schedules a, jobs b, users c, workers d WHERE a.workerID = '$userID' AND schedID = '$schedID' AND a.workerID = d.userID AND a.clientID = b.userID AND a.jobworkerID = d.workerID AND c.userID = a.clientID AND a.schedType = 'hiring' AND a.status = 'pending' GROUP BY schedID";

					$query = mysqli_query($conn, $sql);
					$data = mysqli_fetch_array($query);
				?>
				<div class="jobs">
					<div class="card">
						<div class="card-header-category">
							<h3>From:
								<br />
								<small style="color: #495057;"><?php echo $data['firstname']." ".$data['lastname'];?> </small>
								<span class="bx bxs-star star"><span class="bx bxs-star star"><span class="bx bxs-star-half star"><span class="bx bx-star star"><span class="bx bx-star star"></span>
							</h3>
						</div>

						<div class="card-body">	
							<div class="table-responsive">
								<table width="100%">
									<tbody>
										<tr>
											<td><h3>Title:</h3><h3 style="margin-left: 1rem; color: #495057;">Hiring for <?php echo $data['jobTitle'];?></h3></td>
										</tr>
										<tr>
											<td>
												<button class="button-book" style="margin-right: 5px;" onclick="viewProfile('<?php echo $data['userID'];?>','<?php echo $data['schedID'];?>')">See details <span class="bx bx-show"></span></button>
											</td>

										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<?php
						}
					}
				?>
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
	$("#acceptJob").click(function(){
		var schedID = $('#schedID').val();

       		Swal.fire({
        		title: 'Are you sure to accept job?',
        		icon: 'warning',
        		showCancelButton: true,
        		confirmButtonText: 'Yes'
      		}).then((result) => {
    			if (result.isConfirmed) {
        			var form_data = {
          				schedID : schedID
    				}; 

    		$.ajax({
        		url : "changeSchedStatus.php",
        		method : "POST",
        		data : form_data,
        		dataType : "json",
        		success: function(response){
                	if(response['valid']==false){
                    	Swal.fire({
                        title: 'Error!',
                        text: "Error!",
                        icon: 'error'
                      });
                		}else{	
                			$("#viewProfileModal").modal("hide");
                      		Swal.fire({
                            	title: 'Success!',
                            	text: "Successfully Scheduled!",
                            	icon: 'success'
                          	}).then((result) => {
                            	if (result.isConfirmed) {
                            		window.location.reload();
                          		}
                        	});
                    	}
                }
    	});
    	}else{
        			return false;
    			}
    	});

    	

    });
</script>
<script>

	$(document).ready( function () {
		$("#worker_notifications").attr({
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

	function viewProfile(userID, schedID){
        
        var form_data = {
          userID : userID,
          schedID : schedID
    	};
    

    	$.ajax({
        	url : "viewNotifications.php",
        	method : "POST",
        	data : form_data,
        	dataType : "json",
        	success : function(response) {
        		document.getElementById('view_profile').src = response['profile'];
        		$("#schedID").val(response['schedID']);
            	$("#view_fullname").html(response['firstname']+" "+response['lastname']);
            	$("#view_business").html(response['business']);
            	$("#view_location").html(response['location']);
            	$("#viewProfileModal").modal("show");
        	}
    	});
	}

	
</script>
</html>