@extends('admin.layouts.template')

@section('title', 'Daftar Guru - Schoularium')

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
      <h1>Data Guru</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Daftar Guru</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-header text-right">
                <a href="{{ route('daftar-guru.create') }}" class="btn btn-primary" role="button">Tambah Data</a>
            </div>
            <div class="card-body">          

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr style="text-align: center;">
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Foto</th>
                    <th>Jenis Kelamin</th>
                    <th>No Hp</th>
                    <th>Jabatan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($admins as $admin)
                  <tr >
                    <td>{{ $admin->nama }}</td>
                    <td>{{ $admin->nip }}</td>
                    <td><img src="{{ Storage::url('foto/guru/' . $admin->foto) }}" width="50" height="50"></td>
                    <td>{{ $admin->jenis_kelamin }}</td>
                    <td>{{ $admin->no_telp }}</td>
                    <td>{{ $admin->jabatan }}</td>
                    <td>
                        <a href="{{ route('daftar-guru.edit', $admin->id_admin) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                        
                        <form action="{{ route('daftar-guru.destroy', $admin->id_admin) }}" method="POST" style="display: inline;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                          </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

@endsection

@section('scripts')
@endsection
