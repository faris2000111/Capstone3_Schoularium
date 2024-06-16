@extends('admin.layouts.template')

@section('title', 'Mata Pelajaran - Schoularium')

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
      <h1>Mata Pelajaran</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Mata Pelajaran</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-header text-right">
                <a href="{{ route('mata_pelajaran.create') }}" class="btn btn-primary" role="button">Tambah Data</a>
            </div>
            <div class="card-body">          

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr style="text-align: center;">
                    <th>Id Pelajaran</th>
                    <th>Nama</th>
                    <th>Id Admin</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($mataPelajaran as $item)
                  <tr >
                    <td>{{ $item->id_mata_pelajaran }}</td>
                    <td>{{ $item->nama_pelajaran }}</td>
                    <td>{{ $item->id_admin }}</td>
                    <td>
                        <a href="{{ route('mata_pelajaran.edit', $item->id_mata_pelajaran) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                        
                        <form action="{{ route('mata_pelajaran.destroy', $item->id_mata_pelajaran) }}" method="POST" style="display: inline;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash">Hapus</i></button>
                          </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
              <!-- End Table with stripped rows -->

@endsection
