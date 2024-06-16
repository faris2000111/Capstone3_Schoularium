@extends('admin.layouts.template')

@section('title', 'Tambah Siswa - Schoularium')

@section('content')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Data Siswa</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tambah Siswa</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card mb-3">
                        <div class="card-body">
                            <form class="row g-3 needs-validation" action="{{ route('daftar-siswa.storeStudent') }}"
                                method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="col-12">
                                    <label for="nama_siswa" class="form-label">Nama Siswa</label>
                                    <input type="text" name="nama_siswa" class="form-control" id="nama_siswa" required>
                                    <div class="invalid-feedback">Please, enter the student's name!</div>
                                </div>
                                <div class="col-12">
                                    <label for="nis" class="form-label">NIS</label>
                                    <input type="text" name="NIS" class="form-control" id="nis" required>
                                    <div class="invalid-feedback">Please, enter the NIS!</div>
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" required>
                                    <div class="invalid-feedback">Please, enter the email!</div>
                                </div>
                                <div class="col-12">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" name="foto" class="form-control" id="foto" required>
                                    <div class="invalid-feedback">Please, upload a photo!</div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('daftar-siswa.indexStudents') }}" class="btn btn-secondary"
                                        role="button">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main><!-- End #main -->

@endsection
