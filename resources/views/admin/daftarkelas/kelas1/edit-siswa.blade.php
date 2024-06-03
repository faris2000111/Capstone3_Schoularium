@extends('admin.layouts.template')

@section('title', 'Edit Siswa - Schoularium')

@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Data Siswa</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Edit Siswa</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('daftar-siswa.updateStudent', $siswa->NIS) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="nama_siswa" class="form-label">Nama Siswa</label>
                                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa"
                                        value="{{ $siswa->nama_siswa }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="nis" class="form-label">NIS</label>
                                    <input type="text" class="form-control" id="nis" name="NIS"
                                        value="{{ $siswa->NIS }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $siswa->email }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto">
                                    @if ($siswa->foto)
                                        <img src="{{ asset('storage/' . $siswa->foto) }}" alt="Foto Siswa" width="100">
                                    @endif
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

@endsection
