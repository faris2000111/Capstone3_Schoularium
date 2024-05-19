@extends('adminlte.layouts.app')

@section('content')

 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">
        <div class="card bg-gradient-primary">
          <div class="card-body">
            <h5 class="card-title text-white">Total Jumlah Artikel</h5>
            <p class="card-text text-white">{{ $totalArtikel }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-gradient-success">
          <div class="card-body">
            <h5 class="card-title text-white">Total Jumlah Kategori</h5>
            <p class="card-text text-white">{{ $totalKategori }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-gradient-info">
          <div class="card-body">
            <h5 class="card-title text-white">Jumlah User Terdaftar</h5>
            <p class="card-text text-white">{{ $totalUser }}</p>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->

    <div class="row mt-4">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Artikel</h5>
            <p class="card-text">Kelola Artikel Anda dengan Mudah.</p>
            <a href="/artikel" class="btn btn-primary">Ke Artikel</a>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Kategori</h5>
            <p class="card-text">Tambah, Ubah, dan Hapus Kategori.</p>
            <a href="/kategori" class="btn btn-primary">Ke Kategori</a>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>


  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


@endsection