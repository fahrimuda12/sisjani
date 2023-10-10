@php
    //header('refresh:10;url=./flip.php');
@endphp


<!doctype html>
<html lang="en">


<!-- Mirrored from codervent.com/syndron/demo/vertical/error-blank-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 29 Jul 2023 03:58:42 GMT -->
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="assets/css/dark-theme.css" />
	<link rel="stylesheet" href="assets/css/semi-dark.css" />
	<link rel="stylesheet" href="assets/css/header-colors.css" />
	<title>SISJANI</title>
	{{-- <title>SISJANI | {{ $title }}</title> --}}
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<a href="/login" target="_blank" rel="noreferrer noopener"><img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon-sidebar" alt="logo icon"></a>
			</div>
			<div class="metismenu" id="menu">
				<h3 id="hari" class="display-6"></h3>
                <h3 id="tanggal" class="display-6"></h3>
                <h3 id="jam" class="display-6"></h3>
			</div>
		</div>
		<!--end sidebar wrapper -->
		
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
			  <h1>TEST</h1>
			</div>
		</div>
		<!--end page wrapper -->

		<footer class="marquee-footer">
			<marquee class="mb-0" scrollamount='9'>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ducimus deserunt voluptatum ab totam quasi dolores maxime natus amet, quaerat ratione, odit cupiditate sequi accusamus omnis labore, nobis dolore? Quam, maxime.</marquee>
		</footer>
	</div>
	
	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--app JS-->
	<script src="assets/js/app.js"></script>

	<script>
        function updateTime() {
            var now = new Date();
            var hari = now.toLocaleDateString('id-ID', { weekday: 'long' });
            var tanggal = now.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
            var jam = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0') + ':' + now.getSeconds().toString().padStart(2, '0'); // Format jam secara manual menjadi HH:mm:ss

            document.getElementById('hari').textContent = hari;
            document.getElementById('tanggal').textContent = tanggal;
            document.getElementById('jam').textContent = jam + ' WIB';
        }

        updateTime(); // Panggil sekali saat halaman dimuat untuk menampilkan waktu awal
        setInterval(updateTime, 1000); // Update setiap 1 detik (1000ms)
    </script>

</body>


<!-- Mirrored from codervent.com/syndron/demo/vertical/error-blank-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 29 Jul 2023 03:58:42 GMT -->
</html>