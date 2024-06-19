@extends('admin.layouts.template')

@section('title', 'Tambah Kelas - Schoularium')

@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Data Mata Pelajaran </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tambah Mata Pelajaran </li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card mb-3">

                    <div class="card-body">
                        <form action="{{ route('mata_pelajaran.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_pelajaran">Nama Mata Pelajaran:</label>
                                <input type="text" class="form-control" id="nama_pelajaran" name="nama_pelajaran" required>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="id_admin" class="form-label">Guru</label>
                                <select name="id_admin" class="form-control" id="id_admin" required>
                                    <option value="">Pilih Guru</option>
                                    @foreach($mataPelajaran as $mapel)
                                        <option value="{{ $mapel->id_admin }}">{{ $mapel->nama }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please, select a class guardian!</div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
