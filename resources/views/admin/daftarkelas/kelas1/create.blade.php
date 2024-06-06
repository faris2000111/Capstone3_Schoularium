@extends('admin.layouts.template')

@section('title', 'Tambah Kelas - Schoularium')

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data Kelas </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tambah Kelas </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card mb-3">

                    <div class="card-body">

                        <form class="row g-3 needs-validation" action="{{ route('daftar-kelas.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="col-12">
                                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                                <input type="text" name="nama_kelas" class="form-control" id="nama_kelas" required>
                                <div class="invalid-feedback">Please, enter your class name!</div>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="wali_kelas_id" class="form-label">Wali Kelas</label>
                                <select name="id_admin" class="form-control" id="wali_kelas_id" required>
                                    <option value="">Pilih Wali Kelas</option>
                                    @foreach($kelas as $kelas)
                                        <option value="{{ $kelas->id_admin }}">{{ $kelas->nama }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please, select a class guardian!</div>
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('daftar-kelas.index') }}" class="btn btn-secondary" role="button">Batal</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

@endsection
