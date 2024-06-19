@extends('admin.layouts.template')

@section('title', 'Edit Jadwal - Schoularium')

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
        <h1>Edit Jadwal</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('jadwal-admin.index') }}">Daftar Jadwal</a></li>
                <li class="breadcrumb-item active">Edit Jadwal</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card mb-3">

                    <div class="card-body">

                        <form class="row g-3 needs-validation" action="{{ route('jadwal-admin.update', $jadwal->id_jadwal) }}" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="col-12">
                                <label for="nama-guru" class="form-label">Nama Guru</label>
                                <select name="nama_guru" class="form-select" id="nama-guru" required>
                                    @foreach($admins as $admin)
                                        <option value="{{ $admin->id }}" {{ $jadwal->id_admin == $admin->id ? 'selected' : '' }}>{{ $admin->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="mata-pelajaran" class="form-label">Mata Pelajaran</label>
                                <select name="mata_pelajaran" class="form-select" id="mata-pelajaran" required>
                                    @foreach($mataPelajarans as $mataPelajaran)
                                        <option value="{{ $mataPelajaran->id_mata_pelajaran }}" {{ $jadwal->id_mata_pelajaran == $mataPelajaran->id_mata_pelajaran ? 'selected' : '' }}>{{ $mataPelajaran->nama_pelajaran }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select name="kelas" class="form-select" id="kelas" required>
                                    @foreach($kelases as $kelas)
                                        <option value="{{ $kelas->id_kelas }}" {{ $jadwal->id_kelas == $kelas->id_kelas ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="hari" class="form-label">Hari</label>
                                <select name="hari" class="form-select" id="hari" required>
                                    <option value="senin" {{ $jadwal->hari == 'senin' ? 'selected' : '' }}>Senin</option>
                                    <option value="selasa" {{ $jadwal->hari == 'selasa' ? 'selected' : '' }}>Selasa</option>
                                    <option value="rabu" {{ $jadwal->hari == 'rabu' ? 'selected' : '' }}>Rabu</option>
                                    <option value="kamis" {{ $jadwal->hari == 'kamis' ? 'selected' : '' }}>Kamis</option>
                                    <option value="jumat" {{ $jadwal->hari == 'jumat' ? 'selected' : '' }}>Jum'at</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="lama-jam" class="form-label">Lama Jam</label>
                                <input type="number" name="lama_jam" class="form-control" id="lama-jam" value="{{ $jadwal->lama_jam }}" required>
                                <div class="invalid-feedback">Please, enter the duration!</div>
                            </div>

                            <div class="col-12">
                                <label for="jam-mulai" class="form-label">Jam Mulai</label>
                                <input type="time" name="jam_mulai" class="form-control" id="jam-mulai" value="{{ $jadwal->jam_mulai }}" required>
                                <div class="invalid-feedback">Please, enter the start time!</div>
                            </div>

                            <div class="col-12">
                                <label for="jam-selesai" class="form-label">Jam Selesai</label>
                                <input type="time" name="jam_selesai" class="form-control" id="jam-selesai" value="{{ $jadwal->jam_selesai }}" required readonly>
                                <div class="invalid-feedback">Please, enter the end time!</div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<script>
document.getElementById('lama-jam').addEventListener('input', calculateEndTime);
document.getElementById('jam-mulai').addEventListener('input', calculateEndTime);

function calculateEndTime() {
    const lamaJam = document.getElementById('lama-jam').value;
    const jamMulai = document.getElementById('jam-mulai').value;

    if (lamaJam && jamMulai) {
        const [hours, minutes] = jamMulai.split(':').map(Number);
        const totalMinutes = (hours * 60) + minutes + (parseInt(lamaJam) * 45);

        const endHours = Math.floor(totalMinutes / 60) % 24;
        const endMinutes = totalMinutes % 60;

        document.getElementById('jam-selesai').value = `${endHours.toString().padStart(2, '0')}:${endMinutes.toString().padStart(2, '0')}`;
    }
}
</script>
@endsection
