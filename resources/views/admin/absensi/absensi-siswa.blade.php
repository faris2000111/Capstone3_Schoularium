@extends('admin.layouts.template')

@section('title', 'Absensi Siswa - Schoularium')

@section('content')

<main id="main" class="main">
    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @endif

    <div class="pagetitle">
        <h1>Absensi Siswa</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('absensi.index') }}">Data Absensi</a></li>
                <li class="breadcrumb-item active">Absensi Siswa</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Absensi Siswa</h5>
                            <p class="text-center small">Pilih status kehadiran untuk setiap siswa</p>
                        </div>
                        <form class="row g-3 needs-validation" action="{{ route('absensi-siswa.store') }}" method="POST" novalidate>
                            @csrf
                            <div class="col-md-6">
                                <label for="id_kelas" class="form-label">Kelas</label>
                                <select class="form-control" id="id_kelas" name="id_kelas" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach($kelas as $kelasItem)
                                        <option value="{{ $kelasItem->id_kelas }}">{{ $kelasItem->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="id_mata_pelajaran" class="form-label">Mata Pelajaran</label>
                                <input type="text" class="form-control" id="nama_mata_pelajaran" value="{{ $mata_pelajaran->first()->nama_pelajaran }}" readonly>
                                <input type="hidden" id="id_mata_pelajaran" name="id_mata_pelajaran" value="{{ $mata_pelajaran->first()->id_mata_pelajaran }}">
                            </div>

                            <input type="hidden" id="id_admin" value="{{ Auth::user()->id_admin }}">

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th>Nama Siswa</th>
                                            <th>Hadir</th>
                                            <th>Izin</th>
                                            <th>Sakit</th>
                                            <th>Alpha</th>
                                            <th>Alasan Ketidakhadiran</th>
                                        </tr>
                                    </thead>
                                    <tbody id="siswa-table-body">
                                        <!-- Siswa data will be loaded here by JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Submit Absensi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection

@section('scripts')
<script>
    document.getElementById('id_kelas').addEventListener('change', function() {
        var idKelas = this.value;
        var idMataPelajaran = document.getElementById('id_mata_pelajaran').value;
        var todayDate = new Date().toISOString().slice(0, 10);
        var idAdmin = document.getElementById('id_admin').value;

        fetch(`/check-absensi/${idMataPelajaran}/${idKelas}/${todayDate}/${idAdmin}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                var siswaTableBody = document.getElementById('siswa-table-body');
                siswaTableBody.innerHTML = '';

                // Jika ada siswa yang sudah absen, tampilkan data mereka
                if (data.absensiDone) {
                    data.siswa.forEach(siswa => {
                        var absensi = data.siswaSudahAbsen.find(a => a.NIS === siswa.NIS);
                        var status = absensi ? absensi.status_kehadiran : '';
                        var alasan = absensi ? absensi.alasan_ketidakhadiran : '';
                        var row = `<tr style="text-align: center;">
                            <td>${siswa.nama_siswa}</td>
                            <td><input type="radio" name="status_kehadiran[${siswa.NIS}]" value="Hadir" ${status === 'Hadir' ? 'checked' : ''}></td>
                            <td><input type="radio" name="status_kehadiran[${siswa.NIS}]" value="Izin" ${status === 'Izin' ? 'checked' : ''}></td>
                            <td><input type="radio" name="status_kehadiran[${siswa.NIS}]" value="Sakit" ${status === 'Sakit' ? 'checked' : ''}></td>
                            <td><input type="radio" name="status_kehadiran[${siswa.NIS}]" value="Alpha" ${status === 'Alpha' ? 'checked' : ''}></td>
                            <td><input type="text" name="alasan_ketidakhadiran[${siswa.NIS}]" class="form-control" value="${alasan}"></td>
                        </tr>`;
                        siswaTableBody.insertAdjacentHTML('beforeend', row);
                    });
                } else {
                    // Jika belum ada siswa yang absen, tampilkan semua siswa dalam kelas
                    data.siswa.forEach(siswa => {
                        var row = `<tr style="text-align: center;">
                            <td>${siswa.nama_siswa}</td>
                            <td><input type="radio" name="status_kehadiran[${siswa.NIS}]" value="Hadir"></td>
                            <td><input type="radio" name="status_kehadiran[${siswa.NIS}]" value="Izin"></td>
                            <td><input type="radio" name="status_kehadiran[${siswa.NIS}]" value="Sakit"></td>
                            <td><input type="radio" name="status_kehadiran[${siswa.NIS}]" value="Alpha"></td>
                            <td><input type="text" name="alasan_ketidakhadiran[${siswa.NIS}]" class="form-control"></td>
                        </tr>`;
                        siswaTableBody.insertAdjacentHTML('beforeend', row);
                    });
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });
    });
</script>

@endsection
