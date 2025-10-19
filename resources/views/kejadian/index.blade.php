@extends('layout.master')

@section('title', 'Dashboard Kebencanaan')

@section('content')
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-alert-circle"></i>
    </span>
    Kebencanaan & Tanggap Darurat
  </h3>
</div>

<div class="row">
  {{-- Card Total Kejadian --}}
  <div class="col-md-4 grid-margin stretch-card">
    <div class="card text-white shadow position-relative overflow-hidden"
         style="background: linear-gradient(135deg, #4B6CB7, #182848);">
      {{-- <img src="{{ asset('images/bg-wave-blue.svg') }}" --}}
           {{-- alt="bg" class="position-absolute top-0 end-0 opacity-25" style="width: 120px;"> --}}
      <div class="card-body position-relative">
        <h4 class="card-title">Total Kejadian</h4>
        <h2>150</h2>
        <i class="mdi mdi-clipboard-list mdi-36px float-end opacity-75"></i>
      </div>
    </div>
  </div>

  {{-- Card Dalam Penanganan --}}
  <div class="col-md-4 grid-margin stretch-card">
    <div class="card text-dark shadow position-relative overflow-hidden"
         style="background: linear-gradient(135deg, #f7971e, #ffd200);">
      {{-- <img src="{{ asset('images/bg-disaster-yellow.svg') }}" --}}
           {{-- alt="bg" class="position-absolute top-0 end-0 opacity-25" style="width: 120px;"> --}}
      <div class="card-body position-relative">
        <h4 class="card-title">Dalam Penanganan</h4>
        <h2>12</h2>
        <i class="mdi mdi-hourglass mdi-36px float-end opacity-75"></i>
      </div>
    </div>
  </div>

  {{-- Card Selesai --}}
  <div class="col-md-4 grid-margin stretch-card">
    <div class="card text-white shadow position-relative overflow-hidden"
         style="background: linear-gradient(135deg, #56ab2f, #a8e063);">
      {{-- <img src="{{ asset('images/bg-success-green.svg') }}" --}}
           {{-- alt="bg" class="position-absolute top-0 end-0 opacity-25" style="width: 120px;"> --}}
      <div class="card-body position-relative">
        <h4 class="card-title">Selesai</h4>
        <h2>138</h2>
        <i class="mdi mdi-check-circle-outline mdi-36px float-end opacity-75"></i>
      </div>
    </div>
  </div>
</div>

{{-- Tabel Daftar Kejadian --}}
<div class="card shadow-sm">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="card-title">Daftar Kejadian Bencana</h4>
      <a href="#" class="btn btn-gradient-success btn-sm">
        <i class="mdi mdi-plus-circle-outline"></i> Tambah Data
      </a>
    </div>

    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Jenis Bencana</th>
            <th>Tanggal</th>
            <th>Lokasi</th>
            <th>RT</th>
            <th>RW</th>
            <th>Dampak</th>
            <th>Status</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          @foreach($kejadian as $item)
          <tr>
            <td>{{ $item['kejadian_id'] }}</td>
            <td>{{ $item['jenis_bencana'] }}</td>
            <td>{{ $item['tanggal'] }}</td>
            <td>{{ $item['lokasi_text'] }}</td>
            <td>{{ $item['rt'] }}</td>
            <td>{{ $item['rw'] }}</td>
            <td>{{ $item['dampak'] }}</td>
            <td>
              @if($item['status'] == 'Selesai')
                <span class="badge bg-success">{{ $item['status'] }}</span>
              @elseif($item['status'] == 'Dalam Penanganan')
                <span class="badge bg-warning text-dark">{{ $item['status'] }}</span>
              @else
                <span class="badge bg-secondary">{{ $item['status'] }}</span>
              @endif
            </td>
            <td>{{ $item['keterangan'] }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
