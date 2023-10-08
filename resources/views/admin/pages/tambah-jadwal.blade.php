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
				<div class="card radius-10">
					<div class="card-body">
                        <form class="row g-3" action="/admin/jadwal/tambah" method="POST">
                            @csrf
                            <div class="col-md-12">
                                <label for="input1" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" id="input1" placeholder="First Name">
                            </div>
                            <div class="col-md-12">
                                <label for="ruangan" class="form-label">Ruangan</label>
                                <select class="form-select" name="ruangan" id="ruangan" aria-label="Default select example">
                                    <option selected>Ruangan</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                  </select>
                            </div>
                            <div class="col-md-12">
                                <label for="input6" class="form-label">Tanggal Mulai</label>
                                <input type="datetime-local" name="tanggal_mulai" class="form-control" id="input6" placeholder="Date of Birth">
                            </div>
                            <div class="col-md-12">
                                <label for="input6" class="form-label">Tanggal Selesai</label>
                                <input type="datetime-local" name="tanggal_selesai" class="form-control" id="input6" placeholder="Date of Birth">
                            </div>
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                                    <button type="reset" class="btn btn-light px-4">Reset</button>
                                </div>
                            </div>
                        </form>
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
@endsession
