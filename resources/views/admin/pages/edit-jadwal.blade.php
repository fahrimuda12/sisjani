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
					<div class="breadcrumb-title pe-3">Dashboard</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="/admin/dashboard"><i class="bx bx-home-alt"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Jadwal Rapat</li>
								<li class="breadcrumb-item active" aria-current="page">Edit Jadwal Rapat</li>
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
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
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
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @elseif ($errors->any())
                                    <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-white"><i class="bx bxs-message-square-x"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="mb-0 text-white">Gagal!</h6>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li class="text-white">{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
							<form action={{ '/admin/jadwal/' . $jadwal->id . '/edit' }} method="POST"
                                enctype="multipart/form-data">
								@csrf
								<label class="form-label">Nama Rapat</label>
								<input name="nama" class="form-control mb-3" type="text" placeholder="Masukkan Nama Rapat" aria-label="default input example"
								value="{{ $jadwal->nama }}" required>
								@error('nama')
                                    <div class="invalid-feedback">
                                        {{ nama }}
                                    </div>
                                @enderror
								<label class="form-label">Ruang Rapat</label>
								<select name="ruangan" class="form-select mb-3" aria-label="Pilih Ruangan Rapat" required>
									@php
										$options = array("R.Bromo", "R.EOC", "R.Lawu", "R.Raung", "Hall GSG", "R.Kelas Kelud", "R.Procurement GSG Lt.II");
										foreach ($options as $option) {
											if ($option == $jadwal->ruangan) {
												echo "<option value=\"$option\" selected>$option</option>";
											} else {
												echo "<option value=\"$option\">$option</option>";
											}
										}
									@endphp

									{{-- <option value="{{ $jadwal->ruangan }}" selected hidden>{{ $jadwal->ruangan }}</option>
									<option value="R.Bromo">R.Bromo</option>
									<option value="R.EOC">R.EOC</option>
									<option value="R.Lawu">R.Lawu</option>
									<option value="R.Raung">R.Raung</option>
									<option value="Hall GSG">Hall GSG</option>
									<option value="R.Kelas Kelud">R.Kelas Kelud</option> 
									<option value="R.Procurement GSG Lt.II">R.Procurement GSG Lt.II</option> --}}
								</select>
								<label class="form-label">Tanggal Mulai</label>
								<input name="tgl_mulai" class="form-control mb-3" type="datetime-local" class="form-control" value="{{ $jadwal->tgl_mulai }}" required>
								<label class="form-label">Tanggal Selesai</label>
								<input name="tgl_selesai" class="form-control mb-3" type="datetime-local" class="form-control" value="{{ $jadwal->tgl_selesai }}" required>
								<label class="form-label">Jumlah Snack</label>
								<div class="input-group mb-3">
									<input name="snack" type="number" max="1000" class="form-control" placeholder="Masukkan Jumlah Snack" aria-label="snack" aria-describedby="snack" value="{{ $jadwal->snack }}"> <span class="input-group-text" id="snack" required>Pax</span>
								</div>
								<label class="form-label">Status Rapat</label>
								<select name="status" class="form-select mb-3" aria-label="Pilih Status Rapat" required>
									@php
										$options = array("Internal", "Eksternal");
										foreach ($options as $option) {
											if ($option == $jadwal->status) {
												echo "<option value=\"$option\" selected>$option</option>";
											} else {
												echo "<option value=\"$option\">$option</option>";
											}
										}
									@endphp

									{{-- <option value="{{ $jadwal->status }}" selected hidden>{{ $jadwal->status }}</option>
									<option value="Internal">Internal</option>
									<option value="Eksternal">Eksternal</option> --}}
								</select>
								{{-- <div class="form-check">
								<input class="form-check-input" type="checkbox" value="Internal" id="flexCheckIndeterminate" onclick="onlyOne(this)">
								<label class="form-check-label" for="flexCheckIndeterminate">Internal</label>
								<input class="form-check-input" type="checkbox" value="External" id="flexCheckIndeterminate" onclick="onlyOne(this)">
								<label class="form-check-label mb-3" for="flexCheckIndeterminate">External</label>
								</div> --}}
								{{-- <div>
								<label for="keterangan" class="form-label">Keterangan</label>
								<textarea class="form-control" aria-label="keterangan"></textarea>
								</div> --}}
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
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
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
