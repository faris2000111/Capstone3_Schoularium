@extends('admin.layouts.template')

@section('title', 'Daftar - Guru - Schoularium')

@section('content')

<main id="main" class="main">

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
                  <tr>
                    <th>Name</th>
                    <th>NIP</th>
                    <th>Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>No Telp</th>
                    <th>Email</th>
                    <th>Mata Pelajaran</th>
                    <th>Tingkat Pendidikan</th>
                    <th>Jabatan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($admins as $admin)
                  <tr>
                    <td>{{ $admin->nama }}</td>
                    <td>{{ $admin->nip }}</td>
                    <td>{{ $admin->umur }}</td>
                    <td>{{ $admin->jenis_kelamin }}</td>
                    <td>{{ $admin->no_telp }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->mata_pelajaran }}</td>
                    <td>{{ $admin->tingkat_pendidikan }}</td>
                    <td>{{ $admin->jabatan }}</td>
                    <td>
                        <!-- Tambahkan tombol aksi di sini, misalnya Edit dan Delete -->
                        <a href="{{ route('daftar-guru.edit', $admin->id_guru) }}" class="btn btn-sm btn-primary">Edit</a>
                        <!-- Tambahkan tombol Delete jika diperlukan -->
                        <td>
                          <form action="{{ route('daftar-guru.destroy', $admin->id_guru) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                          </form>
                      </td>
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
