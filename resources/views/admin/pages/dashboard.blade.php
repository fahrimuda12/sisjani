@extends('admin.main')
@section('content')
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        @include('admin.components.sidebar')
        <!--end sidebar wrapper -->
        <!--start header -->
        @include('admin.components.header')
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Dashboard</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Jadwal Rapat</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="card radius-10">
                    <div class="card-body">
                        <!--get response-->
                        @if ($errors->any())
                            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                                <div class="d-flex align-items-center">
                                    <div class="font-35 text-white"><i class="bx bxs-message-square-x"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-0 text-white">Gagal!</h6>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @elseif (session('success'))
                            <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                                <div class="d-flex align-items-center">
                                    <div class="font-35 text-white"><i class="bx bxs-check-circle"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-0 text-white">Berhasil!</h6>
                                        <div class="text-white">{{ session('success') }}</div>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            {{-- <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div> --}}
                        @elseif (session('error'))
                            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                                <div class="d-flex align-items-center">
                                    <div class="font-35 text-white"><i class="bx bxs-message-square-x"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6 class="mb-0 text-white">Gagal!</h6>
                                        <div class="text-white">{{ session('error') }}</div>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            {{-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('error') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div> --}}
                        @endif
                        <div class="d-lg-flex align-items-center mb-4 gap-3">
                            {{-- <div class="position-relative">
								<input type="text" class="form-control ps-5 radius-30" placeholder="Cari Jadwal Rapat"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
							</div> --}}
                            <div class="ms-auto"><a href="/admin/jadwal/input"
                                    class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Tambah
                                    Jadwal Rapat</a></div>
                        </div>
                        <div class="table-responsive">
                            <table id="jadwal" class="table mb-0 table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Ruangan</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Snack</th>
                                        <th>Status</th>
                                        <th>Username</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jadwal as $key => $value)
                                        <tr>
                                            <td class="word-wrap">{{ ++$key }}</td>
                                            <td class="word-wrap">{{ $value->nama }}</td>
                                            <td class="word-wrap">{{ $value->ruangan }}</td>
                                            <td class="word-wrap text-center">
                                                {{ $value->tgl_mulai->translatedformat('D d/n/Y H:i') }}</td>
                                            <td class="word-wrap text-center">
                                                {{ $value->tgl_selesai->translatedformat('D d/n/Y H:i') }}</td>
                                            <td class="word-wrap">{{ $value->snack }}</td>
                                            <td class="word-wrap">{{ $value->status }}</td>
                                            <td class="word-wrap">{{ $value->submitted_by }}</td>
                                            <td>
                                                <div class="d-flex order-actions">
                                                    <a class="btn btn-outline-primary"
                                                        href="{{ url('/admin/jadwal/' . $value->id . '/edit') }}"><i
                                                            class='bx bxs-edit'></i></a>
                                                    <a class="ms-3 btn-outline-danger" href="javascript:void(0);"
                                                        onclick="confirmDelete('{{ url('/admin/jadwal/' . $value->id . '/hapus') }}')">
                                                        <i class='bx bxs-trash'></i>
                                                    </a>
                                                </div>
                                            </td>
                                            {{-- <td><button type="button" class="btn btn-primary btn-sm radius-30 px-4">View Details</button></td> --}}
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2023. All right reserved.</p>
        </footer>
    </div>
    <!--end wrapper-->
    <script>
        function confirmDelete(url) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                window.location.href = url; // Lakukan penghapusan jika dikonfirmasi
            }
        }
    </script>
@endsection
