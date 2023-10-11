@extends('publik.main')
@session('content-publik')
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
                <div class="table-responsive bg-white">
                    <table class="table mb-0" style="font-size:1.5rem">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Ruangan</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jadwal as $key => $value)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$value->nama}}</td>
                                <td>{{$value->ruangan}}</td>
                                <td>{{$value->tgl_mulai}}</td>
                                <td>{{$value->tgl_selesai}}</td>
                                <td>{{$value->tgl_selesai}}</td>
                                {{-- <td><button type="button" class="btn btn-primary btn-sm radius-30 px-4">View Details</button></td> --}}
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
		</div>
		<!--end page wrapper -->

		<footer class="marquee-footer">
			<marquee class="mb-0" scrollamount='9'>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ducimus deserunt voluptatum ab totam quasi dolores maxime natus amet, quaerat ratione, odit cupiditate sequi accusamus omnis labore, nobis dolore? Quam, maxime.</marquee>
		</footer>
	</div>
@endsession
