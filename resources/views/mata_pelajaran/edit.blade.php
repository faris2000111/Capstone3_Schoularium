@extends('admin.layouts.template')

@section('title', 'Edit Kelas - Schoularium')

@section('content')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Data Kelas</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('mata_pelajaran.create') }}">Mata Pelajaran</a></li>
                    <li class="breadcrumb-item active">Edit Mata Pelajaran</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('mata_pelajaran.update', $mataPelajaran->id_mata_pelajaran) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="nama_pelajaran">Nama Mata Pelajaran:</label>
                                    <input type="text" class="form-control" id="nama_pelajaran" name="nama_pelajaran"
                                        value="{{ $mataPelajaran->nama_pelajaran }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_admin">ID Admin:</label>
                                    <input type="number" class="form-control" id="id_admin" name="id_admin"
                                        value="{{ $mataPelajaran->id_admin }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->


@endsection
