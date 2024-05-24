@extends('admin/layouts.template')

@section('content')

<main id="main" class="main">


<div class="card">
  <div class="card-body">
  <div class="pagetitle">
      <h1>Form Edit Data Siswa</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Data Siswa</li>
          <li class="breadcrumb-item active">Edit Data Siswa</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Data Siswa</h5>
            <!-- Multi Columns Form -->
            <form class="row g-3" action="{{ route('siswa.update', $siswa->id_siswa) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              @if($siswa->foto)
              
              <div class="col-md-12">
                <img src="{{url('foto_siswa').'/'.$siswa->foto}}" alt="" height="100px" class="">
              </div>

              @endif
              <div class="col-md-12">
                <label for="NIS" class="form-label">NIS</label>
                <input type="text" class="form-control" id="NIS" placeholder="Masukkan NIS Siswa" name="NIS" value="{{ $siswa->NIS }}">
              </div>
              
              <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Masukkan Email Siswa" name="email" value="{{ $siswa->email }}">
              </div>
              <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Masukkan Password Siswa" name="password" value="{{ $siswa->password }}">
              </div>
              <div class="col-12">
                <label for="nama_siswa" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_siswa" placeholder="Masukkan Nama Lengkap Siswa" name="nama_siswa" value="{{ $siswa->nama_siswa }}">
              </div>
              <div class="col-12">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" class="form-control" id="kelas" placeholder="Masukkan Kelas Siswa" name="kelas" value="{{ $siswa->kelas }}">
              </div>
              <div class="col-md-12">
                <label for="ekstrakurikuler" class="form-label">Ekstrakurikuler</label>
                <input type="text" class="form-control" id="ekstrakurikuler" placeholder="Masukkan ekstrakurikuler yang diikuti Siswa" name="ekstrakurikuler" value="{{ $siswa->ekstrakurikuler }}">
              </div>
              <div class="col-md-12">
                <label for="foto" class="col-sm-2 col-form-label">File Upload</label>
                <div class="col-sm-10">
                  <input class="form-control" type="file" id="foto" placeholder="Masukkan Foto Siswa" name="foto">
                </div>
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