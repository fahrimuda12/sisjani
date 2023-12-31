<!DOCTYPE html>
<html lang="en">


<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
	<title>500 Internal Server Error</title>
</head>

<body>
	<!-- wrapper -->
	<div class="wrapper">
		<div class="error-404 d-flex align-items-center justify-content-center">
			<div class="container">
				<div class="card py-5">
					<div class="row g-0">
						<div class="col-xl-5">
							<div class="card-body p-4">
								<h1 class="display-1"><span class="text-warning">5</span><span class="text-danger">0</span><span class="text-primary">0</span></h1>
								<h2 class="font-weight-bold display-4">Internal Server Error</h2>
								<p>Looks like you are lost!
									<br>May be you are not connected to the internet!</p>
                                <div class="mt-5"> <a id="homeBtn"
                                        class="btn btn-primary btn-lg px-md-5 radius-30">Go Home</a>
                                    <a id="backBtn"
                                        class="btn btn-outline-dark btn-lg ms-3 px-md-5 radius-30">Back</a>
                                </div>
							</div>
						</div>
						<div class="col-xl-7">
							<img src="{{ asset('assets/images/errors-images/505-error.png') }}" class="img-fluid" alt="">
						</div>
					</div>
					<!--end row-->
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('homeBtn').addEventListener('click', goHome);
        document.getElementById('backBtn').addEventListener('click', goBack);
        function goHome() {
            window.location.href = "/login";
        }
        function goBack() {
            window.location.href = "javascript:history.go(-1)";
        }
    </script>
</body>


</html>