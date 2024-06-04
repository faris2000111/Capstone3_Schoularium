@extends('admin.layouts.template')

@section('title', 'Data Absensi - Schoularium')

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
            <h1>Data Absensi</h1>
        </div><!-- End Page Title -->

      <section class="section dashboard">
        <div class="row">
    
            <!-- Left side columns -->
    
              <div class="row">

                <!-- Sales Card -->
                <div class="col-xxl-6 col-md-6">
                  <div class="card info-card sales-card">
                    <a href="{{ route('absensi-guru.index') }}">
                      <div class="card-body">
                        <h5 class="card-title">Absensi Guru</h5>
        
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                              <i class="bi bi-card-checklist"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{$user->name}}</h6>
                            <span class="text-muted small pt-2 ps-1">Silahkan untuk absensi terlebih dahulu </span>
        
                            </div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div><!-- End Sales Card -->

                <!-- Sales Card -->
                <div class="col-xxl-6 col-md-6">
                  <div class="card info-card sales-card">
                    <a href="">
                      <div class="card-body">
                        <h5 class="card-title">Absensi Siswa</h5>
        
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-sharp fa-solid fa-xmark"></i>
                            </div>
                            <div class="ps-3">
                                <h6>11</h6>
                            <span class="text-muted small pt-2 ps-1">Jumlah total siswa</span>
        
                            </div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div><!-- End Sales Card -->
    
                <!-- Sales Card -->
                <div class="col-xxl-6 col-md-6">
                  <div class="card info-card sales-card">
                    <a href="">
                      <div class="card-body">
                        <h5 class="card-title">Izin Siswa</h5>
        
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-sharp fa-solid fa-xmark"></i>
                            </div>
                            <div class="ps-3">
                                <h6>21</h6>
                            <span class="text-muted small pt-2 ps-1">Jumlah total permohonan izin siswa</span>
        
                            </div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div><!-- End Sales Card -->

          </div>
        </div>
      </section>
    
      </main><!-- End #main -->

@endsection