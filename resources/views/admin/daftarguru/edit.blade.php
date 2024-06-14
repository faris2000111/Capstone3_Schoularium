@extends('admin.layouts.template')

@section('title', 'Edit Guru - Schoularium')

@section('content')

<main id="main" class="main">
@if ($message = Session::get('success'))
  <div class="alert alert-success" role="alert">
    {{ $message }}
  </div>
  @endif

  @if ($message = Session::get('error'))
  <div class="alert alert-danger" role="alert">
    {{ $message }}
  </div>
  @endif

    <div class="pagetitle">
        <h1>Edit Data Guru</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('daftar-guru.index') }}">Daftar Guru</a></li>
                <li class="breadcrumb-item active">Edit Guru</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <form action="{{ route('daftar-guru.update', $admin->id_admin) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $admin->nama }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip" value="{{ $admin->nip }}">
                            </div>

                            <div class="mb-3">
                                <label for="umur" class="form-label">Umur</label>
                                <input type="number" class="form-control" id="umur" name="umur" value="{{ $admin->umur }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="L" {{ $admin->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $admin->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="no_telp" class="form-label">No Telepon</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ $admin->no_telp }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>

                            <div class="mb-3">
                                <label for="mata_pelajaran" class="form-label">Mata Pelajaran</label>
                                <input type="text" class="form-control" id="mata_pelajaran" name="mata_pelajaran" value="{{ $admin->mata_pelajaran }}">
                            </div>

                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="foto" name="foto">
                            </div>

                            <div class="col-12">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <select class="form-control" id="jabatan" name="jabatan" required>
                                <option value="Guru" {{ $admin->jabatan == 'Guru' ? 'selected' : '' }}>Guru</option>
                                    <option value="Staff" {{ $admin->jabatan == 'Staff' ? 'selected' : '' }}>Staff</option>
                                </select>
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
