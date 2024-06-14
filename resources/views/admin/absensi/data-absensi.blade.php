@extends('admin.layouts.template')

@section('title', 'Data Absensi - Schoularium')

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
        <h1>Absensi Guru</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('absensi.index') }}">Data Absensi</a></li>
                <li class="breadcrumb-item active">Data Absensi Guru Bulanan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Absensi Bulanan</h5>

                        <!-- Date Picker Form -->
                        <form id="datePickerForm" class="row g-3" onsubmit="return false;">
                            <div class="col-auto">
                                <label for="month" class="col-form-label">Pilih Bulan</label>
                            </div>
                            <div class="col-auto">
                                <input type="month" id="month" name="month" class="form-control" value="{{ $monthYear }}">
                            </div>
                        </form>

                        <!-- Table with stripped rows -->
                        <div id="absensiTable">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nama Guru</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Alasan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absensi as $item)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                            <td>{{ $item->admin->nama }}</td>
                                            <td>
                                                <span class="badge 
                                                    {{ $item->status_kehadiran == 'Hadir' ? 'bg-success' : 
                                                       ($item->status_kehadiran == 'Sakit' ? 'bg-warning' : 
                                                       ($item->status_kehadiran == 'Izin' ? 'bg-primary' : 'bg-danger')) }}">
                                                    {{ $item->status_kehadiran }}
                                                </span>
                                            </td>
                                            <td>{{ $item->alasan_ketidakhadiran }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection

@section('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {
    function fetchData(month) {
        fetch(`{{ url('admin/absensi/data-absensi') }}?month=` + month)
            .then(response => response.json())
            .then(data => {
                console.log(data); // Log data untuk debug
                let tableBody = document.querySelector('#absensiTable tbody');
                tableBody.innerHTML = '';
                
                data.forEach(item => {
                    let row = `
                        <tr>
                            <td>${new Date(item.tanggal).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' })}</td>
                            <td>${item.admin.nama}</td>
                            <td><span class="badge ${item.status_kehadiran == 'Hadir' ? 'bg-success' : item.status_kehadiran == 'Sakit' ? 'bg-warning' : item.status_kehadiran == 'Izin' ? 'bg-primary' : 'bg-danger'}">${item.status_kehadiran}</span></td>
                            <td>${item.alasan_ketidakhadiran}</td>
                        </tr>
                    `;
                    tableBody.innerHTML += row;
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    let monthInput = document.getElementById('month');
    monthInput.addEventListener('change', function() {
        fetchData(monthInput.value);
    });

    // Initial fetch
    fetchData(monthInput.value);
});
</script>

@endsection
