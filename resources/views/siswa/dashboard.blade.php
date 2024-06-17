@extends('siswa.layouts.template')

@section('title', 'Dashboard - Schoularium')

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
        <h1>Dashboard Siswa</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Informasi Siswa -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Informasi Siswa</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>NIS:</strong> {{ $siswa->NIS }}</li>
                            <li class="list-group-item"><strong>Email:</strong> {{ $siswa->email }}</li>
                            <li class="list-group-item"><strong>Nama Siswa:</strong> {{ $siswa->nama_siswa }}</li>
                            <li class="list-group-item"><strong>Jenis Kelamin:</strong> 
                                @if ($siswa->jenis_kelamin == 'L')
                                    Laki-Laki
                                @elseif ($siswa->jenis_kelamin == 'P')
                                    Perempuan
                                @else
                                    Belum Diketahui
                                @endif
                            </li>
                            <!-- Tambahkan informasi lain sesuai kebutuhan -->
                        </ul>
                    </div>
                </div>
            </div><!-- End Informasi Siswa -->

            <!-- Foto Siswa -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Foto Profil</h5>
                        <div style="max-width: 300px; margin: 0 auto;">
                        @if ($siswa->foto)
                        <img src="{{ asset('storage/foto/siswa/' . $siswa->foto) }}" class="img-fluid rounded" alt="Foto Profil">
                        </div>
                        @else
                        <p class="text-muted">Foto belum diunggah.</p>
                        @endif
                    </div>
                </div>
            </div><!-- End Foto Siswa -->

        </div>
    </section>

</main><!-- End #main -->

@endsection
