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
				Personal
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
        					<h3 class="modal-title" id="exampleModalLabel">Hire Worker</h3>
        					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      					</div>
      					
      					<div class="modal-body">
        					<form method="post">  
                    <input type="hidden" name="jobworkerID" id="jobworkerID">
        						<input type="hidden" name="workerID" id="workerID">
        						<div class="form-group">
        							<label class="form-label"><b>Work Time:</b></label><span class="timeSched_error errs"></span>
        								<input type="time" class="form-control" name="timeSched" id="timeSched" oninput="cl3()">
        						</div>

        						<div class="form-group">
        							<label class="form-label"><b>Work Date:</b></label><span class="dateSched_error errs"></span>
        								<input type="date" class="form-control" name="dateSched" id="dateSched" oninput="cl4()">
        						</div> 						
        					</form>
      					</div>
      					
      					<div class="modal-footer">
        					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        					<button type="button" id="submitJob" class="btn btn-success">Submit</button>
      					</div>
    				</div>
  				</div>
			</div>

			<!-- View Profile Modal -->
			<div class="modal fade" id="viewProfileModal" tabindex="-1" aria-hidden="true">
  				
 				<div class="modal-dialog">
    				<div class="modal-content">
      					<div class="modal-header">
        					<h3 class="modal-title" id="exampleModalLabel">Profile</h3>
        					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      					</div>
      					
      					<div class="modal-body">
        					<center>
        						<img id="view_profile" src="images/account.png" width="100px" height="100px;" style="border-radius: 50%;"><br>
        							
        					</center>

        					<div class="form-group">
        						<label class="form-label"><b style="margin-right: 1rem;">Rating:</b></label><span class="bx bxs-star star"></span><span class="bx bxs-star star"></span><span class="bx bxs-star-half star"></span><span class="bx bx-star star"></span><span class="bx bx-star star"></span>
        					</div>
        						
        					<div class="form-group">
        						<label class="form-label"><b style="margin-right: 1rem;">Full Name:</b></label><span id="view_fullname"></span>
        					</div>

        					<div class="form-group">
        						<label class="form-label"><b style="margin-right: 1rem;">Job Description:</b></label><span id="view_jobTitle"></span>
        					</div>

        					<div class="form-group">
        						<label class="form-label"><b style="margin-right: 1rem;">Address:</b></label><span id="view_location"></span>
        					</div>

        					<div class="form-group">
        						<label class="form-label"><b style="margin-right: 1rem;">Rate:</b></label><span id="view_rate"></span>
        					</div>

        					<div class="form-group">
        						<label class="form-label"><b style="margin-right: 1rem;">Work Experience:</b></label><span id="view_workExperience"></span>
        					</div>
      					</div>
      					
      					<div class="modal-footer">
        					<button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
      					</div>
    				</div>
  				</div>
			</div>
			<div class="search-wrapper">
        <a href="javascript:void(0)" onclick="speechRecognition()" style="text-decoration: none; color: var(--main-color);" title="Voice Search"><span class="bx bx-microphone-off" id="logos"></span></a>
        <input type="search" id="output" placeholder="Search Services">       
      </div>

			<?php
				include 'config.php';

				$sql = "SELECT a.workerID as jobworkerID, a.userID as workerID, a.categoryID as categoryID, a.jobTitle as jobTitle, a.rate as rate, a.workExperience as workExperience, b.lat as lat, b.lng as lng, b.userID as userID, b.profile as profile, b.firstname as firstname, b.lastname as lastname FROM workers a, users b WHERE categoryID = '5' AND a.userID = b.userID ORDER BY dateCreated desc";
                    
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

						<div class="card-body">	
							<div class="table-responsive">
								<table width="100%">
									<tbody>
										<tr>
											<td><h3>Job Description:</h3><h3 style="margin-left: 1rem; color: #495057;"><?php echo $data['jobTitle'];?></h3></td>
										</tr>
										<tr>
											<td>
												<button class="button-book" style="margin-right: 5px;" id="hire" onclick="hireWorker('<?php echo $data['jobworkerID'];?>','<?php echo $data['workerID'];?>')">Hire <span class="bx bx-plus-circle"></span></button>
												<button class="button-book" id="viewProfile" onclick="viewProfile('<?php echo $data['userID'];?>','5')">View Profile <span class="bx bx-user-circle"></span></button>
											</td>

										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
					}
				}
			?>
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
</script>
<script>
	$("#submitJob").click(function(){
    var jobworkerID = $("#jobworkerID").val();
    var workerID = $("#workerID").val();
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
        		title: 'Are you sure to hire worker?',
        		icon: 'warning',
        		showCancelButton: true,
        		confirmButtonText: 'Yes'
      		}).then((result) => {
    			if (result.isConfirmed) {
        			var form_data = {
                jobworkerID : jobworkerID,
                workerID : workerID,
                userID : userID,
        				timeSched : timeSched,
        				dateSched : dateSched,
        				status : status
        			};  

				$.ajax({
            		url : "hireWorker.php",
            		type : "POST",
            		data : form_data,
            		dataType : "json",
            		success: function(response){
                		if(response['valid']==false){
                    	Swal.fire({
                          title: 'Error!',
                          text: "You must create a job profile first!",
                          icon: 'error'
                        });
                		}else{	
                			$("#hireModal").modal("hide");
                      		Swal.fire({
                            	title: 'Success!',
                            	text: "Please wait for worker's response",
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

    function hireWorker(jobworkerID, workerID){
    var jobworkerID = jobworkerID;
    var workerID = workerID;

    $("#jobworkerID").val(jobworkerID);
    $("#workerID").val(workerID);

		$("#hireModal").modal("show");

	}

	function viewProfile(userID, categoryID){
        
        var form_data = {
          userID : userID,
          categoryID : categoryID
    	};
    

    	$.ajax({
        	url : "viewProfile.php",
        	method : "POST",
        	data : form_data,
        	dataType : "json",
        	success : function(response) {
        		document.getElementById('view_profile').src = response['profile'];
            	$("#view_fullname").html(response['firstname']+" "+response['lastname']);
            	$("#view_jobTitle").html(response['jobTitle']);
            	$("#view_location").html(response['location']);
            	$("#view_rate").html("₱"+response['rate']);
            	$("#view_workExperience").html(response['workExperience']);
            	$("#viewProfileModal").modal("show");
        	}
    	});
	}
</script>
<script>
	function cl1(){
    	var x = $("#jobTitle").val();
      	if (x == "") {
        	$(".jobTitle_error").html(" *Required");
      	}else{
        	$(".jobTitle_error").html("");
      	}
    }

    function cl2(){
    	var x = $("#location").val();
      	if (x == "") {
        	$(".location_error").html(" *Required");
      	}else{
        	$(".location_error").html("");
      	}
    }

    function cl3(){
      	var x = $("#timeSched").val();
      	if (x == "") {
        	$(".timeSched_error").html(" *Required");
      	}else{
        	$(".timeSched_error").html("");
      	}
    }

    function cl4(){
      var x = $("#dateSched").val();
      if (x == "") {
        $(".dateSched_error").html(" *Required");
      }else{
        $(".dateSched_error").html("");
      }
    } 

    function cl5(){
      var x = $("#location").val();
      if (x == "") {
        $(".location_error").html(" *Required");
      }else{
        $(".location_error").html("");
      }
    } 

    function speechRecognition() {
      var recognition = new webkitSpeechRecognition();
      recognition.lang = "en-GB";
      var output = document.getElementById('output');

      recognition.onstart = function() {
        $("#output").val("Listening...");

      }

      recognition.onspeechend = function() {
        recognition.stop();
      }

      recognition.onresult = function(event) {
        var transcript = event.results[0][0].transcript;
        var transcripts = transcript.replace('.','');
        $("#output").val(transcripts);

        $("#logos").attr({
        "class" : "bx bx-microphone-off"
        });
      }

      recognition.start();
      $("#logos").attr({
        "class" : "bx bx-microphone"
      });
    }
</script>
</html>