@extends('admin/layouts.template')

@section('content')

<main id="main" class="main">


<div class="card">
  <div class="card-body">
  <div class="pagetitle">
      <h1>Form Edit Ekstrakurikuler</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Data Ekstrakurikuler</li>
          <li class="breadcrumb-item active">Edit Data Ekstrakurikuler</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Data ekstrakurikuler</h5>
            <!-- Multi Columns Form -->
            <form class="row g-3" action="{{ route('ekstrakurikuler.update', $ekstrakurikuler->id_ekstrakurikuler) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
              <div class="col-md-12">
                <label for="nama_ekstrakurikuler" class="form-label">nama_ekstrakurikuler</label>
                <input type="text" class="form-control" id="nama_ekstrakurikuler" placeholder="Masukkan nama_ekstrakurikuler Siswa" name="nama_ekstrakurikuler" value="{{ $ekstrakurikuler->nama_ekstrakurikuler }}">
              </div>
              <div class="col-md-12">
                <label for="id_admin" class="form-label">Nama Guru</label>
                <select class="form-control" id="id_admin" name="id_admin">

                    @foreach ($admin as $row)
                    <option value="{{ $row->id_admin }}">{{ $row->nama }}</option>
                    @endforeach

                </select>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
            </form><!-- End Multi Columns Form -->

          </div>
        </div>

      </div>
    </section>
  </div>
</div>


</main><!-- End #main -->

@endsection
