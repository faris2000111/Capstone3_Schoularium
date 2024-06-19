@extends('admin/layouts.template')

@section('content')

<main id="main" class="main">
<a href="{{ route('ekstrakurikuler.create') }}" class="btn btn-primary">Tambah Data Ekstrakurikuler</a>
<table class="table table-bordered border-primary mt-6">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Ekstrakurikuler</th>
                    <th scope="col">Nama Guru</th>
                    <th scope="col">aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($ekstrakurikuler as $row)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$row->nama_ekstrakurikuler}}</td>
                        <td>{{$row->admin->nama}}</td>
                        <td>

                          <form action="{{ route('ekstrakurikuler.destroy', $row->id_ekstrakurikuler) }}" method="POST" onsubmit = "return confirm('apakah anda yakin..?')">
                            <a class="btn btn-primary" href="{{ route('ekstrakurikuler.edit',$row->id_ekstrakurikuler) }}">Edit</a>
                             @csrf
                             @method('DELETE')

                             <button type="submit" class="btn btn-danger">Delete</button>
                          </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>

</main><!-- End #main -->

@endsection
