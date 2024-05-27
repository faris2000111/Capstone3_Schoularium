@extends('admin.layouts.template')

@section('title', 'Absensi Siswa - Schoularium')

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
        <h1>Absensi Siswa</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('absensi.index') }}">Data Absensi</a></li>
                <li class="breadcrumb-item active">Absensi Siswa</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Absensi Siswa</h5>
                            <p class="text-center small">Pilih status kehadiran untuk setiap siswa</p>
                        </div>
                        <form class="row g-3 needs-validation" action="{{ route('absensi-siswa.store') }}" method="POST" novalidate>
                            @csrf
                            <div class="col-md-6">
                                <label for="id_kelas" class="form-label">Kelas</label>
                                <select class="form-control" id="id_kelas" name="id_kelas" required>
                                @foreach($kelas as $kelas_list)
                                    <option value="{{ $kelas_list->id_kelas }}">{{ $kelas_list->nama_kelas }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="id_mata_pelajaran" class="form-label">Mata Pelajaran</label>
                                <select class="form-control" id="id_mata_pelajaran" name="id_mata_pelajaran" disabled required>
                                    @foreach($mata_pelajaran as $mapel)
                                        <option value="{{ $mapel->id_mata_pelajaran }}">{{ $mapel->nama_pelajaran }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th>Nama Siswa</th>
                                            <th>Hadir</th>
                                            <th>Izin</th>
                                            <th>Sakit</th>
                                            <th>Alpha</th>
                                            <th>Alasan Ketidakhadiran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($siswaBelumAbsen as $item)
                                            <tr style="text-align: center;">
                                                <td>
                                                    {{ $item->nama_siswa }}
                                                </td>
                                                <td>
                                                    <input type="radio" name="status_kehadiran[{{ $item->NIS }}]" value="Hadir" >
                                                </td>
                                                <td>
                                                    <input type="radio" name="status_kehadiran[{{ $item->NIS }}]" value="Izin" >
                                                </td>
                                                <td>
                                                    <input type="radio" name="status_kehadiran[{{ $item->NIS }}]" value="Sakit" >
                                                </td>
                                                <td>
                                                    <input type="radio" name="status_kehadiran[{{ $item->NIS }}]" value="Alpha" >
                                                </td>
                                                <td>
                                                    <input type="text" name="alasan_ketidakhadiran[{{ $item->NIS }}]" class="form-control">
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
