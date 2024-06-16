@extends('admin/layouts.template')

@section('content')

<main id="main" class="main">
<a href="{{ route('siswa.create') }}" class="btn btn-primary">Tambah Data Siswa</a>
<table class="table table-bordered border-primary mt-6">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenis kelamin</th>
                    <th scope="col">Email</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Ekstrakurikuler</th>
                    <th scope="col">Foto</th>
                    <th scope="col">aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($siswa as $row)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td>{{$row->NIS}}</td>
                        <td>{{$row->nama_siswa}}</td>
                        <td>{{$row->jenis_kelamin}}</td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->kelas->nama_kelas}}</td>
                        @php
                            $ekstra = DB::table('ekstrakurikuler')->where('id_ekstrakurikuler', $row->id_ekstrakurikuler)->first();
                        @endphp
                        @if($ekstra)
                            <td>{{$ekstra->nama_ekstrakurikuler}}</td>
                        @else
                            <td>belum ikut ekstra</td>
                        @endif


                        {{-- @if ({{$row->ekstrakurikuler->nama_ekstrakurikuler}})
                            <td>{{$row->ekstrakurikuler->nama_ekstrakurikuler}}</td>
                        @else
                            <td>belum mengikuti ekstrakurikuler</td>
                        @endif --}}
                        {{-- <td>{{$row->ekstrakurikuler->nama_ekstrakurikuler}}</td> --}}
                        {{-- <td>{{$row->id_ekstrakurikuler}}</td> --}}
                        <td>
                          <img src="foto_siswa/{{ $row->foto }}" alt=""
                          height="60px" class="">
                        </td>
                        <td>

                          <form action="{{ route('Siswa.destroy', $row->id_siswa) }}" method="POST" onsubmit = "return confirm('apakah anda yakin..?')">
                            <a class="btn btn-primary" href="{{ route('siswa.edit',$row->id_siswa) }}">Edit</a>
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
