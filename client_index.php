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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.2.9/dist/esri-leaflet-geocoder.css" integrity="sha512-v5YmWLm8KqAAmg5808pETiccEohtt8rPVMGQ1jA6jqkWVydV5Cuz3nJ9fQ7ittSxvuqsvI9RSGfVoKPaAJZ/AQ==" crossorigin="">

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
			<!-- Modal -->

            <div class="modal fade" id="viewJobDetails" tabindex="-1" aria-hidden="true">
                
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">Job Details</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-body">
                            <form method="post">
                                <div class="form-group">
                                        <textarea name="myJobDetails" id="myJobDetails" oninput="cl7()" disabled="">
                                            
                                        </textarea>
                                </div>

                            </form>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

			<div class="modal fade" id="createJobModal" tabindex="-1" aria-hidden="true">
  				
 				<div class="modal-dialog">
    				<div class="modal-content">
      					<div class="modal-header">
        					<h3 class="modal-title" id="exampleModalLabel">Create New Job Profile</h3>
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
        									<option name="categoryID" value="6">Recreational</option>
        								</select>
        						</div>
        						
        						<div class="form-group">
        							<label class="form-label"><b>Business Name:</b></label><span class="business_error errs"></span>
        								<input type="text" class="form-control" name="business" id="business" oninput="cl2()">
        						</div>

        						<div class="form-group">
        							<label class="form-label"><b>Job Title:</b></label><span class="jobTitle_error errs"></span>
        								<input type="text" class="form-control" name="jobTitle" id="jobTitle" oninput="cl3()">
        						</div>

        						<div class="form-group">
        							<label class="form-label"><b>Rate:</b></label><span class="rate_error errs"></span>
        								<input type="text" class="form-control" name="rate" id="rate" oninput="cl4()">
        						</div>

        						<div class="form-group">
                                    <label class="form-label"><b>Location:</b></label><span class="location_error errs"></span>
        							<div id="map" style="height: 350px; width: 100%;">
                                    </div>
                                    <table class="table-responsive">
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control" placeholder="Latitude" name="lat" id="lat" onchange="cl5()" disabled="">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" placeholder="Longitude" name="lng" id="lng" onchange="cl6()" disabled="">
                                                </td>
                                            </tr>
                                        </table>
        						</div>

                                <div class="form-group">
                                    <label class="form-label"><b>Job Details:</b></label><span class="jobDetails_error errs"></span>
                                        <textarea name="myTextarea" id="myTextarea" oninput="cl7()">
                                            
                                        </textarea>
                                </div>

        					</form>
      					</div>
      					
      					<div class="modal-footer">
        					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        					<button type="button" id="submitJob" class="btn btn-success">Create Job</button>
      					</div>
    				</div>
  				</div>
			</div>


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
						<span>Jobs Created</span>
					</div>
					<div>
						<span class="bx bx-briefcase-alt-2"></span>
					</div>
				</div>

				<div class="card-single">
					<div>
						<h1>3</h1>
						<span>Hired Workers</span>
					</div>
					<div>
						<span class="bx bx-user-check"></span>
					</div>
				</div>

				<div class="card-single">
					<div>
						<h1>5</h1>
						<span>Cancelled Workers</span>
					</div>
					<div>
						<span class="bx bx-user-x"></span>
					</div>
				</div>
			</div>

			<!--===== MAIN CONTENTS =====-->
			<div class="recent-grid">

				<!--===== JOBS CREATED DIV =====-->
				<div class="jobs">
					<div class="card">
						<div class="card-header">
							<h3>Jobs Created</h3>

							<button type="button" id="createJob">Create New Job <span class="bx bx-right-arrow-alt"></span></button>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table width="100%" id="jobs">
									<thead>
										<tr>
											<td>Category</td>
											<td>Bus. Name</td>
											<td>Job Title</td>                          
											<td>Status</td>
                                            <td>Actions</td>
										</tr>
									</thead>
									<tbody>
									<?php
										include 'config.php';
										$userID = $_SESSION['userID'];

										$sql = "SELECT a.jobID as jobID, a.userID as userID, a.categoryID as categoryID, a.business as business, a.jobTitle as jobTitle, a.lat as lat, a.lng as lng, a.jobDetails as jobDetails, a.status as status, a.dateCreated as dateCreated, b.categoryName as categoryName FROM jobs a, category b WHERE userID = '$userID' AND a.categoryID = b.categoryID ORDER BY jobID desc";
                    
                    					$query =  mysqli_query($conn, $sql);
                    					$rows = mysqli_num_rows($query);

                    					if($rows>0) {
                        					while($data = mysqli_fetch_array($query)) {
										?>
										<tr>
											<td><?php echo $data['categoryName'];?></td>
											<td><?php echo $data['business'];?></td>
											<td><?php echo $data['jobTitle'];?></td>
                                            <td><?php echo $data['status'];?></td>
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
				<div class="workers">
					<div class="card">
						<div class="card-header">
							<h3>Workers Hired</h3>

							<a href="client_categories.php"><button>Hire Now <span class="bx bx-right-arrow-alt"></span></button></a>
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
									<div>
										<h4>Dhave Salazar</h4>
										<small>Welder</small>
									</div>
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
		</main>
	</div>
</body>

<!--===== JAVASCRIPT SOURCES =====-->
<script src="js/bootstrap.js?ts=<?=time()?>"></script>
<script src="js/jquery.js?ts=<?=time()?>"></script>
<script src="js/sweetalert2.js?ts=<?=time()?>"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="crossorigin=""></script>
<script src="https://unpkg.com/esri-leaflet@2.1.4/dist/esri-leaflet.js" integrity="sha512-m+BZ3OSlzGdYLqUBZt3u6eA0sH+Txdmq7cqA1u8/B2aTXviGMMLOfrKyiIW7181jbzZAY0u+3jWoiL61iLcTKQ==" crossorigin=""></script>
<script src="https://unpkg.com/esri-leaflet-geocoder@2.2.9/dist/esri-leaflet-geocoder.js" integrity="sha512-QXchymy6PyEfYFQeOUuoz5pH5q9ng0eewZN8Sv0wvxq3ZhujTGF4eS/ySpnl6YfTQRWmA2Nn3Bezi9xuF8yNiw==" crossorigin=""></script>

<script src='tinymce/tinymce.min.js'></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<!--===== MAIN SCRIPTS =====-->
<script>
	$(document).ready( function () {
		$("#client_index").attr({
			'class' : 'active'
		})
  	});

	$("#createJob").click(function(){
        navigator.geolocation.getCurrentPosition(showPosition);

        function showPosition(position) {
            var lat = 7.303356437105441;
            var lng = 125.67919989821273;

            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([position.coords.latitude, position.coords.longitude]).addTo(map)
            .bindPopup('My Location')
            .openPopup();

            $("#lat").val(position.coords.latitude)
            $("#lng").val(position.coords.longitude)

            map.on('click', function(e) {
            map.eachLayer(function (layer) {
            map.removeLayer(layer);
            });

            $("#lat").val(e.latlng.lat);
            $("#lng").val(e.latlng.lng);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([e.latlng.lat, e.latlng.lng]).addTo(map)
            .bindPopup('My Location')
            .openPopup();

            $(".location_error").html("");

            });

        CKEDITOR.replace('myTextarea');

        }
        

		$("#categoryID").val("");
		$("#business").val("");
		$("#jobTitle").val("");
		$("#rate").val("");
		$("#createJobModal").modal("show");
	});

    function viewJobDetails(jobID){
        var form_data = {
            jobID : jobID
        };  
        $.ajax({
            url : "viewJobDetails.php",
            method : "POST",
            data : form_data,
            dataType : "json",
            success : function(response) {
                CKEDITOR.replace('myJobDetails');
                document.getElementById('myJobDetails').innerHTML = response['jobDetails'];

                $("#viewJobDetails").modal("show");
            }
        });
    }

    function openMap(jobID){
        var form_data = {
            jobID : jobID
        };  
        $.ajax({
            url : "viewMap.php",
            method : "POST",
            data : form_data,
            dataType : "json",
            success : function(response) {
                document.getElementById('myMap').innerHTML = response['jobDetails'];

                $("#viewJobDetails").modal("show");
            }
        });
    }


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

		var userID = "<?php echo $_SESSION['userID']; ?>";
    	var categoryID = $('#categoryID').val();
    	var business = $('#business').val();
    	var jobTitle = $('#jobTitle').val();
        var lat = $('#lat').val();
        var lng = $('#lng').val();
    	var rate = $('#rate').val();
        var jobDetails = CKEDITOR.instances.myTextarea.getData();    	
        var status = "Hiring";
    	var html = "";
    	var valid = true;

		if(categoryID == ""){
    		valid = false;
    		$(".categoryID_error").html(" *Required");
		}else{
        	$(".categoryID_error").html("");    
    	}

    	if(business == ""){
        	valid = false;
        	$(".business_error").html(" *Required");
    	}else{
        	$(".business_error").html("");    
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

        if(lat == ""){
            valid = false;
            $(".location_error").html(" *Required");
        }else{
            $(".location_error").html("");    
        }

        if(lng == ""){
            valid = false;
            $(".location_error").html(" *Required");
        }else{
            $(".location_error").html("");    
        }
 
    	if(valid == true){
       		Swal.fire({
        		title: 'Are you sure to create job?',
        		icon: 'warning',
        		showCancelButton: true,
        		confirmButtonText: 'Yes'
      		}).then((result) => {
    			if (result.isConfirmed) {
        			var form_data = {
        				userID : userID,
        				categoryID : categoryID,
        				business : business,
        				jobTitle : jobTitle,
                        jobDetails : jobDetails,
                        lat : lat,
                        lng : lng,
        				rate : rate,
        				status : status
       				};  

					$.ajax({
            			url : "insert_new_job.php",
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
	
	function cl1(){
    	var x = $("#categoryID").val();
      	if (x == "") {
        	$(".categoryID_error").html(" *Required");
      	}else{
        	$(".categoryID_error").html("");
      	}
    }

    function cl2(){
    	var x = $("#business").val();
      	if (x == "") {
        	$(".business_error").html(" *Required");
      	}else{
        	$(".business_error").html("");
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
      var x = $("#rate").val();
      if (x == "") {
        $(".rate_error").html(" *Required");
      }else{
        $(".rate_error").html("");
      }
    } 

    function cl7(){
      if (document.getElementById("myTextarea").value == "") {
        $(".jobDetails_error").html(" *Required");
      }else{
        $(".jobDetails_error").html("");
      }
    } 

</script>
</html>