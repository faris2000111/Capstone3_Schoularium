@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Mata Pelajaran</h1>
    <form action="{{ route('mata_pelajaran.update', $mataPelajaran->id_mata_pelajaran) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_pelajaran">Nama Mata Pelajaran:</label>
            <input type="text" class="form-control" id="nama_pelajaran" name="nama_pelajaran" value="{{ $mataPelajaran->nama_pelajaran }}" required>
        </div>
        <div class="form-group">
            <label for="id_admin">ID Admin:</label>
            <input type="number" class="form-control" id="id_admin" name="id_admin" value="{{ $mataPelajaran->id_admin }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
