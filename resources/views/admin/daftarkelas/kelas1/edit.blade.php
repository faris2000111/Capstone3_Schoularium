@extends('admin.layouts.template')

@section('title', 'Edit Kelas 1 - Schoularium')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Data Kelas</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('daftar-kelas.index') }}">Daftar Kelas 1</a></li>
                <li class="breadcrumb-item active">Edit Kelas</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <form action="{{ route('daftar-kelas.update', $kelas->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                                <input type="text" class="form-control" id="nama_kelas" name="nama" value="{{ $kelas->nama_kelas }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="nama_siswa" class="form-label">Nama Siswa</label>
                                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="{{ $kelas->nama_siswa }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="nama_walikelas" class="form-label">Wali Kelas</label>
                                <input type="text" class="form-control" id="nama_walikelas" name="nama_walikelas" value="{{ $kelas->nama_walikelas }}" required>
                            </div>
                            <!-- Tambahkan field lainnya sesuai kebutuhan -->

                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection
