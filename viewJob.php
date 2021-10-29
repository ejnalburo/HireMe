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
    <link rel="stylesheet" type="text/css" href="css/leaflet-distance-marker.css?ts=<?=time()?>">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.2.9/dist/esri-leaflet-geocoder.css" integrity="sha512-v5YmWLm8KqAAmg5808pETiccEohtt8rPVMGQ1jA6jqkWVydV5Cuz3nJ9fQ7ittSxvuqsvI9RSGfVoKPaAJZ/AQ==" crossorigin="">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    

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
				View Job Details
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
        					<button type="button" id="submitJob" class="btn btn-success">Apply Job</button>
      					</div>
    				</div>
  				</div>
			</div>

            <h2 style="color: #808080;">Job Details</h2>

            <section style="margin-bottom: 30px;">
            	<?php 
					include 'config.php';

					$userID = $_POST['userID'];
					$categoryID = $_POST['categoryID'];
					$jobworkerID = $_POST['jobworkerID'];
					$clientID = $_POST['clientID'];

					$sql = "SELECT a.userID as clientID, a.jobID as jobworkerID, a.categoryID as categoryID, a.jobTitle as jobTitle, a.rate as rate, a.business as business, a.lat as lat, a.lng as lng, a.jobDetails as jobDetails, b.userID as userID, b.profile as profile, b.firstname as firstname, b.lastname as lastname, b.lat as lat1, b.lng as lng1 FROM jobs a, users b WHERE a.userID = '$userID' AND a.categoryID = '$categoryID' AND a.jobID = '$jobworkerID'  AND a.userID = '$clientID' AND a.userID = b.userID";
					$query = mysqli_query($conn, $sql);
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
                                <br />
                                <small style="color: #495057;">Overall Rating: </small>
                                <span class="bx bxs-star star"><span class="bx bxs-star star"><span class="bx bxs-star-half star"><span class="bx bx-star star"><span class="bx bx-star star"></span>
                            </h3>
                        </div>

                        <div class="card-bods"> 
                            <div class="table-responsive">
                                <table width="100%">
                                    <tbody>
                                    	<tr>
                                            <td><h3>Client Name:</h3><h3 style="margin-left: 1rem; color: #495057;"><?php echo $data['firstname']." ".$data['lastname'];?></h3></td>
                                        </tr>
                                        <tr>
                                            <td><h3>Name of Business:</h3><h3 style="margin-left: 1rem; color: #495057;"><?php echo $data['business'];?></h3></td>
                                        </tr>
                                        <tr>
                                            <td><h3>Looking For:</h3><h3 style="margin-left: 1rem; color: #495057;"><?php echo $data['jobTitle'];?></h3></td>
                                        </tr>
                                        <tr>
                                            <td><h3>Job Details:</h3><h3 style="margin-left: 1rem; color: #495057;"></h3></td>
                                        </tr>
                                        <tr>
                                        	<td>
                                        		<textarea style="overflow: hidden; border: none">
                                        		<?php echo $data['jobDetails'];?>
                                        	</textarea>
                                        	</td>
                                        </tr>

                                        <tr>
                                            <td>
                                            	<input type="hidden" id="lat" name="lat" value="<?php echo $data['lat'];?>">
                                            	<input type="hidden" id="lng" name="lng" value="<?php echo $data['lng'];?>">
                                                <h3>Job Location:</h3><h3 style="margin-left: 1rem; color: #495057;"></h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div id="map" style="height: 420px; width: 80%; padding: 30px; margin: 30px;">
                                    </div>
                            </div>
                            <table>
                            	<tr>
                            		<td>
                            			<button class="button-book" id="applyJob" onclick="applyJob('<?php echo $data['jobworkerID'];?>','<?php echo $data['clientID'];?>')">Apply Job <span class="bx bx-plus"></span></button>
                            		</td>
                            	</tr>
                            </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
   
            <?php
                }
            }

            ?>

            </section> 
			</div>
		</main>
		<br>
		<br>
	</div>

</body>

<!--===== JAVASCRIPT SOURCES =====-->
<script src="js/owl.carousel.js?ts=<?=time()?>"></script>
<script src="js/owl.carousel.min.js?ts=<?=time()?>"></script>
<script src="js/bootstrap.js?ts=<?=time()?>"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="js/jquery.js?ts=<?=time()?>"></script>
<script src="js/sweetalert2.js?ts=<?=time()?>"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="crossorigin=""></script>
<script src="https://unpkg.com/esri-leaflet@2.1.4/dist/esri-leaflet.js" integrity="sha512-m+BZ3OSlzGdYLqUBZt3u6eA0sH+Txdmq7cqA1u8/B2aTXviGMMLOfrKyiIW7181jbzZAY0u+3jWoiL61iLcTKQ==" crossorigin=""></script>
<script src="https://unpkg.com/esri-leaflet-geocoder@2.2.9/dist/esri-leaflet-geocoder.js" integrity="sha512-QXchymy6PyEfYFQeOUuoz5pH5q9ng0eewZN8Sv0wvxq3ZhujTGF4eS/ySpnl6YfTQRWmA2Nn3Bezi9xuF8yNiw==" crossorigin=""></script>
<script src='tinymce/tinymce.min.js'></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script src="js/leaflet.geometryutil.js?ts=<?=time()?>"></script>
<script src="js/leaflet-distance-marker.js?ts=<?=time()?>"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>


<!--===== MAIN SCRIPTS =====-->
<script>
	$(document).ready( function () {
		navigator.geolocation.getCurrentPosition(showPosition);
		function showPosition(position) {
		var lat = $("#lat").val();
		var lng = $("#lng").val();
		

		var map = L.map('map').setView([lat,lng], 13);

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors' }).addTo(map);

		L.marker([lat,lng]).addTo(map)
		.bindPopup('Job Location')
		.openPopup();
			<?php
			include 'config.php';
			$a = $_SESSION['userID'];
			$sql = "SELECT lat, lng FROM users WHERE userID = '$a'";
			$query = mysqli_query($conn, $sql);
			$data = mysqli_fetch_array($query);

			?>
		
			var lat1 = "<?php echo $data['lat']; ?>";
			var lng1 = "<?php echo $data['lng']; ?>";

			L.marker([lat1, lng1]).addTo(map)
            .bindPopup('My Location')
            .openPopup();

        	L.Routing.control({
  				waypoints: [
    				L.latLng(lat1, lng1),
    				L.latLng(lat, lng)
  				]
			}).addTo(map);
			}

        


		$("#worker_index").attr({
			'class' : 'active'
		});

         $(".owl-carousel").owlCarousel();
        
  	});

</script>

<script type="text/javascript">
	$("#submitJob").click(function(){
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

    function applyJob(jobworkerID, clientID){
    var jobworkerID = jobworkerID;
    var clientID = clientID;

    $("#jobworkerID").val(jobworkerID);
    $("#clientID").val(clientID);

        $("#hireModal").modal("show");

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