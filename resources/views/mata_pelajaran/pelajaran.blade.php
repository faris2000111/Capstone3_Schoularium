@extends('admin.layouts.template')
@section('title', 'Mata Pelajaran - Schoularium')
@section('content')
<div class="container">
    <h1>Mata Pelajaran</h1>
    <a href="{{ route('mata_pelajaran.create') }}" class="btn btn-primary">Tambah Mata Pelajaran</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>ID Admin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mataPelajaran as $item)
            <tr>
                <td>{{ $item->id_mata_pelajaran }}</td>
                <td>{{ $item->nama_pelajaran }}</td>
                <td>{{ $item->id_admin }}</td>
                <td>
                    <a href="{{ route('MataPelajaran.edit', $item->id_mata_pelajaran) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('MataPelajaran.destroy', $item->id_mata_pelajaran) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
