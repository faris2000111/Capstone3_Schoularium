@extends('admin.layouts.template')

@section('title', 'Daftar - Kelas - Schoularium')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Data Kelas</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Daftar Kelas</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-header text-right">
                <a href="{{ route('daftar-kelas.create') }}" class="btn btn-primary" role="button">Tambah Data</a>
            </div>
            <div class="card-body">          

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Nama Kelas</th>
                    <th>Wali Kelas</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($kelas as $kelas)
                  <tr>
                    <td>{{ $kelas->nama_kelas }}</td>
                    <td>{{ $kelas->nama }}</td>
                    <td>
                      
                      <form action="{{ route('daftar-kelas.destroy', $kelas->id_kelas) }}" method="POST">
                        @csrf
                              <a href="{{ route('daftar-kelas.edit', $kelas->id_kelas) }}" class="btn btn-sm btn-primary">Edit</a>
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                              <a href="{{ route('daftar-siswa.indexStudents', $kelas->id_kelas) }}" class="btn btn-sm btn-success">Lihat Siswa</a>
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
