@extends('admin.layouts.template')

@section('title', 'Edit Kelas - Schoularium')

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

                            <form action="{{ route('daftar-kelas.update', $kelas->id_kelas) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="nama_kelas" class="form-label">Nama Kelas</label>
                                    <input type="text" class="form-control" id="nama_kelas" name="nama_kelas"
                                        value="{{ $kelas->nama_kelas }}" required>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="wali_kelas_id" class="form-label">Wali Kelas</label>
                                    <select name="id_admin" class="form-control" id="wali_kelas_id" required>
                                        <option value="">Pilih Wali Kelas</option>
                                        @foreach ($admin as $admin)
                                            <option value="{{ $admin->id_admin }}">{{ $admin->nama }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Please, select a class guardian!</div>
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
