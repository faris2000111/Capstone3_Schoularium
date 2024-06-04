@extends('admin.layouts.template')

@section('title', 'Absensi Guru - Schoularium')

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
        <h1>Absensi Guru</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('absensi.index') }}">Data Absensi</a></li>
                <li class="breadcrumb-item active">Absensi Guru</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Absensi Guru</h5>
                            <p class="text-center small">Pilih status kehadiran untuk setiap guru</p>
                        </div>
                        <form class="row g-3 needs-validation" action="{{ route('absensi-guru.store') }}" method="POST" novalidate>
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th>Hadir</th>
                                            <th>Izin</th>
                                            <th>Sakit</th>
                                            <th>Alpha</th>
                                            <th>Alasan Ketidakhadiran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($absens as $absen)
                                            <tr style="text-align: center;">
                                                <td>
                                                    <input type="radio" name="status_kehadiran" value="Hadir" required>
                                                </td>
                                                <td>
                                                    <input type="radio" name="status_kehadiran" value="Izin" required>
                                                </td>
                                                <td>
                                                    <input type="radio" name="status_kehadiran" value="Sakit" required>
                                                </td>
                                                <td>
                                                    <input type="radio" name="status_kehadiran" value="Alpha" required>
                                                </td>
                                                <td>
                                                    <input type="text" name="alasan_ketidakhadiran" class="form-control">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Submit Absensi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection
