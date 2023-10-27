@extends('user.main')
@session('content')
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        @include('user.components.sidebar')
        <!--end sidebar wrapper -->
        <!--start header -->
        @include('user.components.header')
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
                                    <li class="breadcrumb-item"><a href="/dashboard/"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">Jadwal Rapat</li>
                                    <li class="breadcrumb-item active" aria-current="page">Tambah Jadwal Rapat</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!--end breadcrumb-->
                    <div class="row">
                        {{-- <h6 class="mb-0 text-uppercase">Tambah Jadwal Rapat</h6>
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
                                <form action="/jadwal/input" method="POST">
                                    @csrf
                                    <label class="form-label">Nama Rapat</label>
                                    <input name="nama" value="{{ old('nama') }}" class="form-control mb-3"
                                        type="text" placeholder="Masukkan Nama Rapat" aria-label="default input example"
                                        required>
                                    <label class="form-label">Ruang Rapat</label>
                                    <select name="ruangan" class="form-select mb-3" aria-label="Pilih Ruangan Rapat"
                                        required>
                                        <option value="" disabled selected hidden>Pilih Ruangan</option>
                                        <option value="R.Bromo" {{ 'R.Bromo' === old('ruangan') ? 'selected' : '' }}>R.Bromo</option>
                                        <option value="R.EOC" {{ 'R.EOC' === old('ruangan') ? 'selected' : '' }}>R.EOC</option>
                                        <option value="R.Lawu" {{ 'R.Lawu' === old('ruangan') ? 'selected' : '' }}>R.Lawu</option>
                                        <option value="R.Raung" {{ 'R.Raung' === old('ruangan') ? 'selected' : '' }}>R.Raung</option>
                                        <option value="Hall GSG" {{ 'Hall GSG' === old('ruangan') ? 'selected' : '' }}>Hall GSG</option>
                                        <option value="R.Kelas Kelud" {{ 'R.Kelas Kelud' === old('ruangan') ? 'selected' : '' }}>R.Kelas Kelud</option>
                                        <option value="R.Procurement GSG Lt.II" {{ 'R.Procurement GSG Lt.II' === old('ruangan') ? 'selected' : '' }}>R.Procurement GSG Lt.II</option>
                                    </select>
                                    <label class="form-label">Tanggal Mulai</label>
                                    <input name="tgl_mulai" value="{{ old('tgl_mulai') }}" class="form-control mb-3" type="datetime-local" class="form-control" required>
                                    <label class="form-label">Tanggal Selesai</label>
                                    <input name="tgl_selesai" value="{{ old('tgl_selesai') }}" class="form-control mb-3" type="datetime-local" class="form-control" required>
                                    <label class="form-label">Jumlah Snack</label>
                                    <div class="input-group mb-3">
                                        <input name="snack" value="{{ old('snack') }}" type="number"  min="0"  max="2000" class="form-control" placeholder="Masukkan Jumlah Snack" aria-label="snack" aria-describedby="snack"> <span class="input-group-text" id="snack" required>Pax</span>
                                    </div>
                                    <label class="form-label">Status Rapat</label>
                                    <select name="status" class="form-select mb-3" aria-label="Pilih Status Rapat" required>
                                        <option value="" disabled selected hidden>Pilih Status Rapat</option>
                                        <option value="Internal" {{ 'Internal' === old('status') ? 'selected' : '' }}>Internal</option>
                                        <option value="Eksternal" {{ 'Eksternal' === old('status') ? 'selected' : '' }}>Eksternal</option>
                                    </select>
                                    <input name="submitted_by" class="form-control mb-3" type="text" class="form-control" value="{{ Auth::user()->name }}" hidden>
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
