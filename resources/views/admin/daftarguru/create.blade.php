@extends('admin.layouts.template')

@section('title', 'Tambah Guru - Schoularium')

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
        <h1>Data Guru</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Daftar Guru</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card mb-3">

                    <div class="card-body">

                        

                        <form class="row g-3 needs-validation" action="{{ route('daftar-guru.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="col-12">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" required>
                                <div class="invalid-feedback">Please, enter your name!</div>
                            </div>

                            <div class="col-12">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" name="nip" class="form-control" id="nip">
                                <div class="invalid-feedback">Please, enter your NIP!</div>
                            </div>

                            <div class="col-12">
                                <label for="umur" class="form-label">Umur</label>
                                <input type="number" name="umur" class="form-control" id="umur" required>
                                <div class="invalid-feedback">Please, enter your age!</div>
                            </div>

                            <div class="col-12">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <div class="invalid-feedback">Please, select your gender!</div>
                            </div>

                            <div class="col-12">
                                <label for="no_telp" class="form-label">No Telp</label>
                                <input type="text" name="no_telp" class="form-control" id="no_telp" required>
                                <div class="invalid-feedback">Please, enter your phone number!</div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Your Email</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                                <div class="invalid-feedback">Please enter a valid Email address!</div>
                            </div>

                            <div class="col-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                                <div class="invalid-feedback">Please enter your password!</div>
                            </div>

                            <div class="col-12">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                                <div class="invalid-feedback">Please confirm your password!</div>
                            </div>

                            <div class="col-12">
                                <label for="mata_pelajaran" class="form-label">Mata Pelajaran</label>
                                <input type="text" name="mata_pelajaran" class="form-control" id="mata_pelajaran" required>
                                <div class="invalid-feedback">Please, enter your subject!</div>
                            </div>

                            <div class="col-12">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" name="foto" class="form-control" id="foto">
                                <div class="invalid-feedback">Please, upload your photo!</div>
                            </div>

                            <div class="col-12">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <select class="form-control" id="jabatan" name="jabatan" required>
                                    <option value="Guru">Guru</option>
                                    <option value="Staff">Staff</option>
                                </select>
                                <div class="invalid-feedback">Please, select your Jabatan!</div>
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
