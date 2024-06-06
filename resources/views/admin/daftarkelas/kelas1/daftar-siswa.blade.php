@extends('admin.layouts.template')

@section('title', 'Daftar - Kelas - Schoularium')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Data Kelas</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Daftar Siswa</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-header text-right">

              <a href="{{ route('daftar-kelas.index') }}" class="btn btn-primary">Lihat Kelas</a>

            </div>
            <div class="card-body">          

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Nama Siswa</th>
                    <th>NIS</th>
                    <th>Email</th>
                    <th>Foto</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($siswa as $siswa)
                  <tr>
                    <td>{{ $siswa->nama_siswa }}</td>
                    <td>{{ $siswa->NIS }}</td>
                    <td>{{ $siswa->email }}</td>
                    <td><img src="{{ asset('storage/'.$siswa->foto) }}" width="100" height="100"></td>
                    <td>
                      <form action="{{ route('daftar-siswa.destroyStudent', $siswa->NIS) }}" method="POST">
                        @csrf
                              <a href="{{ route('daftar-siswa.editStudent', $siswa->NIS) }}" class="btn btn-sm btn-primary">Edit</a>
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
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
