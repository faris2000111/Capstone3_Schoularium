@extends('admin.layouts.template')

@section('title', 'Daftar - Kelas - 3 - Schoularium')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Data Kelas 3</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Daftar Kelas 3</li>
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
                  <tr style="text-align: center;">
                    <th>Nama Kelas</th>
                    <th>Nama Siswa</th>
                    <th>Wali Kelas</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($kelas as $kelas)
                  <tr style="text-align: center;">
                    <td>1{{ $kelas->nama_kelas }}</td>
                    <td>{{ $kelas->nama_siswa }}</td>
                    <td>{{ $kelas->nama_walikelas }}</td>
                    <td>
                        <a href="{{ route('daftar-kelas.edit', $kelas->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <td>
                          <form action="{{ route('daftar-kelas.destroy', $kelas->id) }}" method="POST">
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
