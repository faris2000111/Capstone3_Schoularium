@extends('admin.layouts.template')

@section('title', 'Tambah Kelas 2 - Schoularium')

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data Kelas 2</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Daftar Kelas 2</li>
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

                            <div class="col-12">
                                <label for="nama_siswa" class="form-label">Nama Siswa</label>
                                <input type="text" name="nama_siswa" class="form-control" id="nama_siswa" required>
                                <div class="invalid-feedback">Please, enter your student name!</div>
                            </div>

                            <div class="col-12">
                                <label for="nama_walikelas" class="form-label">Nama Walikelas</label>
                                <input type="text" name="nama_walikelas" class="form-control" id="nama_walikelas" required>
                                <div class="invalid-feedback">Please, enter your teacher name!</div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Tambahkan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

@endsection
