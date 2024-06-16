@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Mata Pelajaran</h1>
    <form action="{{ route('mata_pelajaran.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_pelajaran">Nama Mata Pelajaran:</label>
            <input type="text" class="form-control" id="nama_pelajaran" name="nama_pelajaran" required>
        </div>
        <div class="form-group">
            <label for="id_admin">ID Admin:</label>
            <input type="number" class="form-control" id="id_admin" name="id_admin" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
