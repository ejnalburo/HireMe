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

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.2.9/dist/esri-leaflet-geocoder.css" integrity="sha512-v5YmWLm8KqAAmg5808pETiccEohtt8rPVMGQ1jA6jqkWVydV5Cuz3nJ9fQ7ittSxvuqsvI9RSGfVoKPaAJZ/AQ==" crossorigin="">

<!--===============================================================================================-->
</head>
<body>
		<center>
	<div class="recent-grid-login">
		<div class="login">
			<div class="card">
				<div class="login-body">
				<form class="form-group" method="POST" action="process.php">
					<center>
					<img class="login-img" src="images/logo1.png">
					</center>
					<h1 class="login-text" style="color: var(--main-color);">
						Register To Hire Me
					</h1>

					<div style="margin-bottom: 20px; margin-top: 3rem;">
						<input class="form-control" style="max-width: 500px;" type="text" name="firstname" placeholder="First Name" autocomplete="off">
					</div>

					<div style="margin-bottom: 20px;">
						<input class="form-control" style="max-width: 500px;" type="text" name="lastname" placeholder="Last Name" autocomplete="off">
					</div>

					<div style="margin-bottom: 20px;">
						<input class="form-control" style="max-width: 500px;" type="text" name="username" placeholder="Username" autocomplete="off">
					</div>

					<div style="margin-bottom: 20px;">
						<input class="form-control" style="max-width: 500px;" type="text" name="email" placeholder="Email" autocomplete="off">
					</div>

					<div style="margin-bottom: 20px;">
						<input class="form-control" style="max-width: 500px;" type="text" name="phone" placeholder="Phone Number" autocomplete="off">
					</div>

					<div style="margin-bottom: 20px;">
					<select class="form-control" style="max-width: 500px;" name="userType" required="">
						<option name="userType" value="">--Please Choose--</option>
						<option name="userType" value="Client">Client</option>
						<option name="userType" value="Skilled Worker">Skilled Worker</option>
					</select>
					</div>

					<div style="margin-bottom: 20px;">
						<input class="form-control" style="max-width: 500px;" type="password" name="password" placeholder="Password"  autocomplete="off">
					</div>
					<div class="form-group">
                        <label class="form-label"><b>Location:</b></label><span class="location_error errs"></span>
                        <div id="map" style="height: 350px; width: 500px;">
                        </div>
                        <input type="hidden" class="form-control" placeholder="Latitude" name="lat" id="lat">
                        <input type="hidden" class="form-control" placeholder="Longitude" name="lng" id="lng">
                    </div>

					<div style="margin-bottom: 20px;">
						<input type="submit" style="max-width: 500px;" class="btn btn-success"  style="width: 100%;" id="register" value="Register Account">
					</div>

					<div class="text-center" style="margin-top: 20px;">
						<span class="txt1">
							Already have an account?
						</span>

						<a href="index.php" class="txt2 hov1">
							Log in
						</a>
					</div>
				</form>
			</div>
			</div>
		</div>
	</div>
	

	
<!--===============================================================================================-->
	<script src="js/bootstrap.js?ts=<?=time()?>"></script>
	<script src="js/jquery.js?ts=<?=time()?>"></script>
<script src="js/sweetalert2.js?ts=<?=time()?>"></script>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="crossorigin=""></script>
<script src="https://unpkg.com/esri-leaflet@2.1.4/dist/esri-leaflet.js" integrity="sha512-m+BZ3OSlzGdYLqUBZt3u6eA0sH+Txdmq7cqA1u8/B2aTXviGMMLOfrKyiIW7181jbzZAY0u+3jWoiL61iLcTKQ==" crossorigin=""></script>
<script src="https://unpkg.com/esri-leaflet-geocoder@2.2.9/dist/esri-leaflet-geocoder.js" integrity="sha512-QXchymy6PyEfYFQeOUuoz5pH5q9ng0eewZN8Sv0wvxq3ZhujTGF4eS/ySpnl6YfTQRWmA2Nn3Bezi9xuF8yNiw==" crossorigin=""></script>

<script src='tinymce/tinymce.min.js'></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

</body>
<script>
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

        }

</script>
</html>

