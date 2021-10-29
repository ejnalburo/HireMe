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
	<meta name="viewport"content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">

	<!--===== WEBSITE ICON =====-->
	<link rel="icon" type="image/png" href="images/icon1.ico"/>

	<title>Hire Me</title>

	<!--===== CSS SOURCES =====-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">
	<link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css?ts=<?=time()?>">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css?ts=<?=time()?>">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.css?ts=<?=time()?>">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css?ts=<?=time()?>">
    <link rel="stylesheet" type="text/css" href="css/owl.theme.default.min.css?ts=<?=time()?>">
    
    

</head>

<body>


	<input type="checkbox" id="nav-toggle">

	<?php include 'sidebar_worker.php';?>

	<div class="main-content">

		<!--===== NAVBAR =====-->
		<header>
			<h2>
				<label for="nav-toggle">
					<span class="bx bx-menu"></span>
				</label>
				Dashboard
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

            <!-- Hire Modal -->
            <div class="modal fade" id="hireModal" tabindex="-1" aria-hidden="true">
                
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">Apply Job</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-body">
                            <form method="post"> 
                                <div class="form-group">
                      <input type="hidden" name="jobworkerID" id="jobworkerID">
                                    <input type="hidden" name="clientID" id="clientID">
                                </div>

                                <div class="form-group">
                                    <label class="form-label"><b>Work Time:</b></label><span class="timeSched_error errs"></span>
                                        <input type="time" class="form-control" name="timeSched" id="timeSched" oninput="cl01()">
                                </div>

                                <div class="form-group">
                                    <label class="form-label"><b>Work Date:</b></label><span class="dateSched_error errs"></span>
                                        <input type="date" class="form-control" name="dateSched" id="dateSched" oninput="cl02()">
                                </div>                      
                            </form>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" id="applyJob" class="btn btn-success">Apply Job</button>
                        </div>
                    </div>
                </div>
            </div>

			<!-- Modal -->
			<div class="modal fade" id="createJobModal" tabindex="-1" aria-hidden="true">
  				
 				<div class="modal-dialog">
    				<div class="modal-content">
      					<div class="modal-header">
        					<h3 class="modal-title" id="exampleModalLabel">Create New Work Profile</h3>
        					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      					</div>
      					
      					<div class="modal-body">
        					<form method="post">
        						<div class="form-group">
        							<label class="form-label"><b>Category:</b></label><span class="categoryID_error errs"></span>
        								<select class="form-select" name="categoryID" id="categoryID" oninput="cl1()">
        									<option name="categoryID" value=""></option>
        									<option name="categoryID" value="1">Academic</option>
        									<option name="categoryID" value="2">Financial</option>
        									<option name="categoryID" value="3">Handyman</option>
        									<option name="categoryID" value="4">Health Care</option>
        									<option name="categoryID" value="5">Personal</option>
        									<option name="categoryID" value="6">Sports </option>
        								</select>
        						</div>

        						<div class="form-group">
        							<label class="form-label"><b>Job Title:</b></label><span class="jobTitle_error errs"></span>
        								<input type="text" class="form-control" name="jobTitle" id="jobTitle" oninput="cl3()">
        						</div>


        						
        						<div class="form-group">
        							<label class="form-label"><b>Rate:</b></label><span class="rate_error errs"></span>
        								<input type="text" class="form-control" name="rate" id="rate" oninput="cl2()">
        						</div>


        						<div class="form-group">
        							<label class="form-label"><b>Work Experience:</b></label><span class="experience_error errs"></span>
        								<input type="text" class="form-control" name="experience" id="experience">
        						</div>

        					</form>
      					</div>
      					
      					<div class="modal-footer">
        					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        					<button type="button" id="submitJob" class="btn btn-success">Create Work Profile</button>
      					</div>
    				</div>
  				</div>
			</div>

            <h2 style="color: #808080;">Profile</h2>

			<!--===== MAIN CONTENTS =====-->
			<div class="recent-grid">

				<!--===== JOBS CREATED DIV =====-->
				<div class="jobs_worker">
					<div class="card">
						<div class="card-header">
							<h3>Work Profile Created</h3>

							<button type="button" id="createJob">Create New Work Profile <span class="bx bx-right-arrow-alt"></span></button>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table width="100%" id="jobs">
									<thead>
										<tr>
											<td>Category</td>
											<td>Job Title</td>
											<td>Rate</td>
                                            <td style="justify-content: center;">Actions</td>
										</tr>
									</thead>
									<tbody>
									<?php
										include 'config.php';
										$userID = $_SESSION['userID'];

										$sql = "SELECT a.workerID as workerID, a.userID as userID, a.categoryID as categoryID, a.jobTitle as jobTitle, a.rate as rate, a.dateCreated as dateCreated, b.categoryName as categoryName FROM workers a, category b WHERE userID = '$userID' AND a.categoryID = b.categoryID ORDER BY workerID desc";
                    
                    					$query =  mysqli_query($conn, $sql);
                    					$rows = mysqli_num_rows($query);

                    					if($rows>0) {
                        					while($data = mysqli_fetch_array($query)) {
										?>
										<tr>
											<td><?php echo $data['categoryName'];?></td>
											<td><?php echo $data['jobTitle'];?></td>
											<td>₱<?php echo $data['rate'];?></td>
                                            <td style="justify-content: center;">
                                            <a href="#"><i style="font-size: 25px;" class='bx bx-edit' title="Edit"></i>Edit Details</a>
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

				<!--===== WORKERS HIRED DIV =====-->
				<div class="workers_worker">
					<div class="card">
						<div class="card-header">
							<h3>Accepted Jobs</h3>

							<a href="worker_categories.php"><button>Apply Now <span class="bx bx-right-arrow-alt"></span></button></a>
						</div>
						<div class="card-body">
							<a href="#">
							<div class="worker">
								<div class="info">
									<?php
										include 'config.php';
										$userID = $_SESSION['userID'];

										$sql = "SELECT * FROM schedules where userID = '$userID'";
                    
                    					$query =  mysqli_query($conn, $sql);
                    					$rows = mysqli_num_rows($query);

                    					if($rows>0) {
                        					while($data = mysqli_fetch_array($query)) {
									?>
									<img src="<?php echo $data['profile']; ?>" width="40px" height="40px" alt="">
									<?php
											}
										}
									?>
								</div>
							</div>
							</a>
						</div>
					</div>
				</div>	
			</div>

            <h2 style="color: #808080; margin-top: 40px;">Recently Added Jobs</h2>
            <section>
                <?php
                include 'config.php';

                $sql = "SELECT a.jobID as jobworkerID, a.userID as clientID, a.categoryID as categoryID, a.jobTitle as jobTitle, a.rate as rate, a.business as business, a.lat as lat, a.lng as lng, a.jobDetails as jobDetails, b.userID as userID, b.profile as profile, b.firstname as firstname, b.lastname as lastname FROM jobs a, users b WHERE a.userID = b.userID ORDER BY dateCreated desc LIMIT 0,10";
                    
                $query =  mysqli_query($conn, $sql);
                $rows = mysqli_num_rows($query);

                if($rows>0) {
                    while($data = mysqli_fetch_array($query)) {
            ?>

            <div class="recent-grid-category">
                <div class="jobs">
                    <div class="card">
                        <div class="card-header-category">
                            <?php 
                                if($data['profile']==""){
                                    echo "<img class='worker-img' src='images/account.png'>";
                                }else{ 
                                    echo "<img class='worker-img' src='".$data['profile']."'>";
                                } 
                            ?>
                            <h3><?php echo $data['firstname']." ".$data['lastname'];?>
                                <br />
                                <small style="color: #495057;">Overall Rating: </small>
                                <span class="bx bxs-star star"><span class="bx bxs-star star"><span class="bx bxs-star-half star"><span class="bx bx-star star"><span class="bx bx-star star"></span>
                            </h3>
                        </div>
                        <form method="post" action="viewJob.php">
                        <div class="card-body"> 
                            <div class="table-responsive">
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td><h3 style="margin-left: 1rem; color: #495057;">Looking For: <?php echo $data['jobTitle'];?></h3></td>
                                            <td><h3>Rate:</h3><h3 style="margin-left: 1rem; color: #495057;"><?php echo $data['rate'];?></h3></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="hidden" name="userID" value="<?php echo $data['userID'];?>">
                                                <input type="hidden" name="categoryID" value="<?php echo $data['categoryID'];?>">
                                                <input type="hidden" name="jobworkerID" value="<?php echo $data['jobworkerID'];?>">
                                                <input type="hidden" name="clientID" value="<?php echo $data['clientID'];?>">
                                                <button type="submit" class="button-book" id="viewProfile">View Job Details <span class="bx bx-user-circle"></span></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div></form>
                    </div>
                </div>
            </div>
   
            <?php
                }
            }

            ?>
            <br>
            <center><a href="worker_categories.php">See more..</a></center>
            </section> 
		</main>
	</div>

</body>

<!--===== JAVASCRIPT SOURCES =====-->
<script src="js/owl.carousel.js?ts=<?=time()?>"></script>
<script src="js/owl.carousel.min.js?ts=<?=time()?>"></script>
<script src="js/bootstrap.js?ts=<?=time()?>"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="js/jquery.js?ts=<?=time()?>"></script>
<script src="js/sweetalert2.js?ts=<?=time()?>"></script>


<!--===== MAIN SCRIPTS =====-->
<script>
	$(document).ready( function () {

		$("#worker_index").attr({
			'class' : 'active'
		});

         $(".owl-carousel").owlCarousel();
  	});

	$("#createJob").click(function(){
		$("#categoryID").val("");
		$("#jobTitle").val("");
		$("#rate").val("");
		$("#experience").val("");
		$("#location").val("");
		$("#createJobModal").modal("show");
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

<script>
    $("#applyJob").click(function(){
    var jobworkerID = $("#jobworkerID").val();
        var clientID = $("#clientID").val();
    var userID = "<?php echo $_SESSION['userID'];?>";
        var timeSched = $("#timeSched").val();
        var dateSched = $("#dateSched").val();
        var status = "pending";
        var valid = true;


        if(timeSched == ""){
            valid = false;
            $(".timeSched_error").html(" *Required");
        }else{
            $(".timeSched_error").html("");    
        }

        if(dateSched == ""){
            valid = false;
            $(".dateSched_error").html(" *Required");
        }else{
            $(".dateSched_error").html("");    
        }

        
        if(valid == true){
            Swal.fire({
                title: 'Are you sure to apply job?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form_data = {
                jobworkerID : jobworkerID,
                        clientID : clientID,
                userID : userID,
                        timeSched : timeSched,
                        dateSched : dateSched,
                        status : status
                    };  

                $.ajax({
                    url : "applyJob.php",
                    type : "POST",
                    data : form_data,
                    dataType : "json",
                    success: function(response){
                        if(response['valid']==false){
                        Swal.fire({
                        title: 'Error!',
                        text: "You must create a work profile first!",
                        icon: 'error'
                      });
                        }else{  
                            $("#hireModal").modal("hide");
                            Swal.fire({
                                title: 'Success!',
                                text: "Please wait for client's response",
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
        }
    });

	$("#submitJob").click(function(){
		var userID = "<?php echo $_SESSION['userID']; ?>";
    	var categoryID = $('#categoryID').val();
    	var jobTitle = $('#jobTitle').val();
    	var rate = $('#rate').val();
    	var experience = $('#experience').val();
    	var html = "";
    	var valid = true;

		if(categoryID == ""){
    		valid = false;
    		$(".categoryID_error").html(" *Required");
		}else{
        	$(".categoryID_error").html("");    
    	}


    	if(jobTitle == ""){
        	valid = false;
        	$(".jobTitle_error").html(" *Required");
    	}else{
        	$(".jobTitle_error").html("");    
    	}


    	if(rate == ""){
        	valid = false;
        	$(".rate_error").html(" *Required");
    	}else{
        	$(".rate_error").html("");    
    	}


    	if(experience == ""){
        	experience = "None";
    	}else{
        	$(".experience_error").html("");    
    	}

 
    	if(valid == true){
       		Swal.fire({
        		title: 'Are you sure to create work profile?',
        		icon: 'warning',
        		showCancelButton: true,
        		confirmButtonText: 'Yes'
      		}).then((result) => {
    			if (result.isConfirmed) {
        			var form_data = {
        				userID : userID,
        				categoryID : categoryID,
        				jobTitle : jobTitle,
        				rate : rate,
        				experience : experience
       				};  

					$.ajax({
            			url : "insert_new_worker.php",
            			type : "POST",
            			data : form_data,
            			dataType : "json",
            			success: function(response){
                			if(response['valid']==false){
                    			Swal.fire({
  									icon: 'error',
  									title: 'Oops...',
  									text: 'Data not inserted!'
								});
                			}else{
                    			$("#createJobModal").modal('hide');

								Swal.fire({
                        			title: 'Success!',
                        			text: "Data successfully added",
                        			icon: 'success'
                    			}).then((result) => {
                        			if (result.isConfirmed) {
                            			window.location.reload();
                          			}
                    			});
                			}
            			}
        			});
    			}
     		});
 		}else{
        	return false;
    	}
	});
</script>

<script type="text/javascript">

    function viewProfile(userID, categoryID){
        var form_data = {
            userID : userID,
          categoryID : categoryID
        };  

        $.ajax({
            url : "viewJob.php",
            method : "POST",
            data : form_data,
            dataType : "json",
            success : function(response) {
                window.location.href="viewJob.php"
            }
        });
    }

    function applyJob(jobworkerID, clientID){
    var jobworkerID = jobworkerID;
    var clientID = clientID;

    $("#jobworkerID").val(jobworkerID);
    $("#clientID").val(clientID);

        $("#hireModal").modal("show");

    }

    	
	function cl1(){
    	var x = $("#categoryID").val();
      	if (x == "") {
        	$(".categoryID_error").html(" *Required");
      	}else{
        	$(".categoryID_error").html("");
      	}
    }

    function cl2(){
    	var x = $("#rate").val();
      	if (x == "") {
        	$(".rate_error").html(" *Required");
      	}else{
        	$(".rate_error").html("");
      	}
    }

    function cl3(){
      	var x = $("#jobTitle").val();
      	if (x == "") {
        	$(".jobTitle_error").html(" *Required");
      	}else{
        	$(".jobTitle_error").html("");
      	}
    }

    function cl4(){
      var x = $("#location").val();
      if (x == "") {
        $(".location_error").html(" *Required");
      }else{
        $(".location_error").html("");
      }
    }   

    function cl01(){
        var x = $("#timeSched").val();
        if (x == "") {
            $(".timeSched_error").html(" *Required");
        }else{
            $(".timeSched_error").html("");
        }
    }

    function cl02(){
      var x = $("#dateSched").val();
      if (x == "") {
        $(".dateSched_error").html(" *Required");
      }else{
        $(".dateSched_error").html("");
      }
    } 

</script>
</html>