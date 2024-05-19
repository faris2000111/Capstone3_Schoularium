@extends('adminlte.layouts.app')
 @section('content')
<div class="content">
    <div class="container mt-5">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <form action="{{ route('storeArtikel') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="form-group">
                        <label for="deskripsi">Nama Kategori</label>
                        <select class="form-control" name="id_kategori" id="id_kategori" required="required">
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->deskripsi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">GAMBAR</label>
                        <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                            name="gambar">

                        <!-- error message untuk title -->
                        @error('gambar')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">JUDUL</label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror"
                            name="judul" value="{{ old('judul') }}" placeholder="Masukkan Judul Artikel">

                        <!-- error message untuk title -->
                        @error('judul')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">KONTEN</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="5"
                            placeholder="Masukkan deskripsi Artikel">{{ old('deskripsi') }}</textarea>

                        <!-- error message untuk content -->
                        @error('deskripsi')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                    <button type="reset" class="btn btn-md btn-warning">RESET</button>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'deskripsi' );
</script>
@endsection