@extends('admin/layouts.template')

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

        <div class="pagetitle mb-3">
            <h1>Selamat Datang, {{ $user->name }}</h1>
        </div>


        <div class="pagetitle">
            <h1>Dashboard Admin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Jumlah Siswa <span></span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i><img src="{{ asset('assets/foto_dashboard/siswa.png') }}" alt="School Logo"
                                                    width="50px"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $siswa }} Siswa</h6>
                                            <span class="text-success small pt-1 fw-bold"><a href="{{ route('siswa.index') }}">Lihat Siswa</a></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Jumlah Guru <span></span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i><img src="{{ asset('assets/foto_dashboard/guru.png') }}" alt="School Logo"
                                                    width="50px"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $guru }} Guru</h6>
                                            <span class="text-success small pt-1 fw-bold"><a href="{{ route('daftar-guru.index') }}">Lihat Guru</a></span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <!-- Customers Card -->
                        {{-- <div class="d-flex justify-content-center align-items-center"> --}}
                            <div class="col-xxl-4 col-md-6">
                                <div class="card info-card customers-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Jumlah Kelas <span></span></h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i><img src="{{ asset('assets/foto_dashboard/kelas.png') }}"
                                                        alt="School Logo" width="40px"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $jumlahKelas }} Kelas</h6>
                                                <span class="text-danger small pt-1 fw-bold"><a href="{{ route('daftar-kelas.index') }}">Lihat Kelas</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Customers Card -->
                        {{-- </div> --}}

                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Mata Pelajaran <span></span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i><img src="{{ asset('assets/foto_dashboard/mapel.png') }}"
                                                    alt="School Logo" width="40px"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $jumlahKelas }} Mapel</h6>
                                            <span class="text-danger small pt-1 fw-bold"><a href="{{ route('mata_pelajaran.index') }}">Lihat Kelas</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div><!-- End News & Updates -->

                </div><!-- End Right side columns -->

            </div>
        </section>

    </main><!-- End #main -->

@endsection
