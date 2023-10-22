<!DOCTYPE html>
<html lang="en">

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
	{{-- <link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script> --}}
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
    @yield('content-publik')

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
	<!--plugins-->
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
	<!-- Vector map JavaScript -->
	<script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
	<!-- highcharts js -->
	<script src="{{ asset('assets/plugins/highcharts/js/highcharts.js') }}"></script>
	<script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
	<script src="{{ asset('assets/js/index2.js') }}"></script>
	<!--app JS-->
	<script src="{{ asset('assets/js/app.js') }}"></script>

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
</html>
