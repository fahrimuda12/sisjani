{{-- @php
header('refresh:5;url=/');
@endphp --}}

@php
header('refresh:60');
@endphp

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/header-colors.css') }}" />
    <title>SISJANI | {{ $title }}</title>
</head>

<body>
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
                <div class="table-responsive bg-white">
                    <table id="jadwal" class="table mb-0" style="font-size:1.5rem">
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
                                    <td>{{ $value->tgl_mulai->format('H:i') }}</td>
                                    <td>{{ $value->tgl_selesai->format('H:i') }}</td>
                                    <td>@php echo ((strtotime(now()) < strtotime($value['tgl_mulai'])) ? ('Dijadwalkan') : ('Sedang Berlangsung')); @endphp</td>
                                <tr>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--end page wrapper -->

        <footer class="marquee-footer">
            <marquee class="mb-0" scrollamount='9'>
                @forelse ($text as $key => $value)
                        {{ $value->text }}
                @empty
                @endforelse
            </marquee>

        </footer>
    </div>

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
    {{-- <script src="{{ asset('assets/plugins/highcharts/js/highcharts.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/index2.js') }}"></script> --}}
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
                month: 'short',
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
    <script>
        function updateJadwal() {
            $.ajax({
                url: '/flip',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log('Data Rapat (Hasil Ajax):', data);
                    $('#jadwal tbody').empty();

                    // Loop melalui data rapat dan tambahkan baris baru ke tabel
                    for (var i = 0; i < data.length; i++) {
                        var meeting = data[i];
                        var status = (new Date() < new Date(meeting.tgl_mulai)) ? 'Dijadwalkan' : 'Sedang Berlangsung';
                        var tglMulai = new Date(meeting.tgl_mulai).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', hour12: false });
                        var tglSelesai = new Date(meeting.tgl_selesai).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', hour12: false });
                        var row = $('<tr>').append(
                            $('<td>').text(i + 1),
                            $('<td>').text(meeting.nama),
                            $('<td>').text(meeting.ruangan),
                            $('<td>').text(tglMulai),
                            $('<td>').text(tglSelesai),
                            $('<td>').text(status)
                        );

                        $('#jadwal tbody').append(row);
                    }

                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    
        setInterval(updateJadwal, 5000); // Update setiap 5 detik
    </script>
</body>
