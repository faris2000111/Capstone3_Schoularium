@extends('admin.layouts.template')

@section('title', 'Daftar Jadwal - Schoularium')

@section('content')
<main id="main" class="main">
@if ($message = Session::get('success'))
  <div class="alert alert-success" role="alert">
    {{ $message }}
  </div>
@endif

<div class="pagetitle">
    <h1>Jadwal</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Daftar Jadwal</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-body">
                    <a href="{{ route('jadwal-admin.create') }}" class="btn btn-primary mb-3">Tambah Jadwal</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Guru</th>
                                <th>Mata Pelajaran</th>
                                <th>Kelas</th>
                                <th>Hari</th>
                                <th>Lama Jam</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwals as $jadwal)
                                <tr>
                                    <td>{{ $jadwal->user->name }}</td>
                                    <td>{{ $jadwal->mataPelajaran->nama_pelajaran }}</td>
                                    <td>{{ $jadwal->kelas->nama_kelas }}</td>
                                    <td>{{ $jadwal->hari }}</td>
                                    <td>{{ $jadwal->lama_jam . ' jam' }}</td>
                                    <td>{{ $jadwal->jam_mulai }}</td>
                                    <td>{{ $jadwal->jam_selesai }}</td>
                                    <td>
                                        <a href="{{ route('jadwal-admin.edit', $jadwal->id_jadwal) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('jadwal-admin.destroy', $jadwal->id_jadwal) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
</main><!-- End #main -->
@endsection