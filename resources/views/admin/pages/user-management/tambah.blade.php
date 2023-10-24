@extends('admin.main')
@session('content')
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
                <div class="col-xl-9 mx-auto"> <!--full/tidak-->
                    <!--breadcrumb-->
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        {{-- <div class="breadcrumb-title pe-3">Input Jadwal rapat</div> --}}
                        <div class="ps-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 p-0">
                                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Input User</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!--end breadcrumb-->
                    <div class="row">
                        {{-- <h6 class="mb-0 text-uppercase">Text Inputs</h6>
						<hr/> --}}
                        <div class="card">
                            <div class="card-body">
                                {{-- get response --}}
                                @if (session('success'))
                                    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-white"><i class="bx bxs-check-circle"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="mb-0 text-white">Berhasil!</h6>
                                                <div class="text-white">{{ session('success') }}</div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
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
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <form action={{ '/admin/user-management/store' }} method="POST">
                                    @csrf
                                    <label for="nama" class="form-label">Nama</label>
                                    <input name="nama" class="form-control mb-3" type="text"
                                        placeholder="Masukkan Nama" aria-label="default input example"
                                        value="{{ old('nama') }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <label for="username" class="form-label">Username</label>
                                    <input name="username" class="form-control mb-3" type="text"
                                        placeholder="Masukkan Username" aria-label="default input example"
                                        value="{{ old('username') }}" required>
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <label for="role" class="form-label">Role</label>
                                    <select name="role" class="form-select mb-3" aria-label="Pilih Role" required>
                                        <option value="" disabled selected hidden>Pilih Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <label for="password" class="form-label">Password</label>
                                    <input name="password" class="form-control mb-3" type="password"
                                        placeholder="Masukkan Password " aria-label="default input example">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <label for="password_konfirmasi" class="form-label">Konfirmasi Password</label>
                                    <input name="password_konfirmasi" class="form-control mb-3" type="password"
                                        placeholder="Masukkan Ulang Password" aria-label="default input example">
                                    @error('password_konfirmasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-primary px-4">Submit</button>
                                        <button type="reset" class="btn btn-light px-4">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end page wrapper -->
            <!--start overlay-->
            <div class="overlay toggle-icon"></div>
            <!--end overlay-->
            <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
                    class='bx bxs-up-arrow-alt'></i></a>
            <!--End Back To Top Button-->
            <footer class="page-footer">
                <p class="mb-0">Copyright © 2023. All right reserved.</p>
            </footer>
        </div>
        <!--end wrapper-->
        {{-- <script>
            function onlyOne(checkbox) {
                var checkboxes = document.getElementsByName('check')
                checkboxes.forEach((item) => {
                    if (item !== checkbox) item.checked = false
                })
            }
        </script> --}}
    @endsession
