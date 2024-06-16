@extends('admin.layouts.template')

@section('title', 'Jadwal - Schoularium')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Jadwal</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Jadwal</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <form method="GET" action="" class="row g-3">
                            <div class="col-md-6">
                                <label for="hari" class="form-label">Hari</label>
                                <select name="hari" id="hari" class="form-select">
                                    <option value="">Pilih Hari</option>
                                    @foreach($days as $day)
                                        <option value="{{ $day }}" {{ $selectedHari == $day ? 'selected' : '' }}>{{ ucfirst($day) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select name="kelas" id="kelas" class="form-select">
                                    <option value="">Pilih Kelas</option>
                                    @foreach($kelases as $kelas)
                                        <option value="{{ $kelas->id_kelas }}" {{ $selectedKelas == $kelas->id_kelas ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
                @if($jadwals->isNotEmpty())
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Guru</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Kelas</th>
                                        <th>Hari</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jadwals as $jadwal)
                                        <tr>
                                            <td>{{ $jadwal->user->name }}</td>
                                            <td>{{ $jadwal->mataPelajaran->nama_pelajaran }}</td>
                                            <td>{{ $jadwal->kelas->nama_kelas }}</td>
                                            <td>{{ ucfirst($jadwal->hari) }}</td>
                                            <td>{{ $jadwal->jam_mulai }}</td>
                                            <td>{{ $jadwal->jam_selesai }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning" role="alert">
                        Tidak ada jadwal yang ditemukan.
                    </div>
                @endif
            </div>
        </div>
    </section>
</main>
@endsection
