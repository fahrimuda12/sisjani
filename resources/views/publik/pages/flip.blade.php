@php
header('refresh:60');
@endphp

{{-- @extends('publik.main')
@session('content-publik') --}}

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
    <title>SISJANI | {{ $title }}</title>
</head>

<!--wrapper-->
<div class="wrapper">
    <!--sidebar wrapper -->
    <div class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
            <a href="/login" target="_blank" rel="noreferrer noopener"><img
                    src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon-sidebar" alt="logo icon"></a>
        </div>
        <div class="metismenu" id="menu" style="background-color:#2ea0e2;text-align: center;">
            <h3 id="hari" class="display-6" style="color:white;"></h3>
            <h3 id="tanggal" class="display-6" style="color:white;"></h3>
            <h3 id="jam" class="display-6" style="color:white"></h3>
        </div>
        <img src="{{ asset('assets/images/side.jpg') }}" width=100% height=70% />
    </div>
    <!--end sidebar wrapper -->

    <!--start page wrapper -->
    <div class="flip-wrapper">
        <div class="flip-content">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="table-responsive bg-white">
                            <table class="table mb-0" style="font-size:1.5rem">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Ruangan</th>
                                        <th>Mulai</th>
                                        <th>Selesai</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jadwal as $key => $value)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $value->nama }}</td>
                                            <td>{{ $value->ruangan }}</td>
                                            <td>{{ $value->tgl_mulai->toTimeString() }}</td>
                                            <td>{{ $value->tgl_selesai->toTimeString() }}</td>
                                            <td>@php echo ((strtotime(now()) < strtotime($value['tgl_mulai'])) ? ('Dijadwalkan') : ('Sedang Berlangsung')); @endphp</td>
                                        <tr>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @forelse ($konten as $key => $value)
                        <div class="{{ $key == 0 ? 'carousel-item' : 'carousel-item' }}">
                            <img src={{ asset('/slider/' . $value->foto) }} class="d-block w-100"
                                alt="{{ $value->foto }}">
                        </div>
                    @empty
                        <div>

                        </div>
                    @endforelse
                </div>
                {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button> --}}
            </div>
        </div>
    </div>
    <!--end page wrapper -->

    @forelse ($text as $key => $value)
        <footer class="marquee-footer">
            <marquee class="mb-0" scrollamount='9'>{{ $value->text }}</marquee>
        </footer>
    @empty
    @endforelse

    {{-- <footer class="marquee-footer">
        <marquee class="mb-0" scrollamount='9'>
            @forelse ($text as $key => $value)
                {{ $value->text }}
            @empty
            @endforelse
        </marquee>

    </footer> --}}
</div>
<!-- Bootstrap JS -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<!--plugins-->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<!-- Vector map JavaScript -->
{{-- <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script> --}}
<!-- highcharts js -->
{{-- <script src="{{ asset('assets/plugins/highcharts/js/highcharts.js') }}"></script>
<script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/js/index2.js') }}"></script> --}}
<!--app JS-->
<script src="{{ asset('assets/js/app.js') }}"></script>

<script>
    function updateTime() {
        var now = new Date();
        var hari = now.toLocaleDateString('id-ID', {
            weekday: 'long'
        });
        var tanggal = now.toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
        var jam = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0') +
            ':' + now.getSeconds().toString().padStart(2, '0'); // Format jam secara manual menjadi HH:mm:ss

        document.getElementById('hari').textContent = hari;
        document.getElementById('tanggal').textContent = tanggal;
        document.getElementById('jam').textContent = jam + ' WIB';
    }

    updateTime(); // Panggil sekali saat halaman dimuat untuk menampilkan waktu awal
    setInterval(updateTime, 1000); // Update setiap 1 detik (1000ms)
</script>

{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> --}}
<script>
    $(function() {
        $('.fadein img:gt(0)').hide();
        setInterval(function() {
            $('.fadein :first-child').fadeOut().next('img').fadeIn().end().appendTo('.fadein');
        }, 3000);
        // set interval hidden image and table
        $('.fadein .page-wrapper').hide();
        setInterval(function() {
            $('.fadein .page-wrapper').show().next('.fadein .page-wrapper').hide();

        }, 1000 * {{ $konten }});

    });
</script>
</body>
