{{-- resources/views/pages/donasi-bencana/show.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="mdi mdi-hand-heart-eye me-2"></i>Detail Donasi Bencana
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="200">Donatur</th>
                                <td>{{ $donasi->donatur_nama }}</td>
                            </tr>
                            <tr>
                                <th>Kejadian Bencana</th>
                                <td>
                                    @if($donasi->kejadianBencana)
                                        <span class="badge bg-info">{{ $donasi->kejadianBencana->jenis_bencana }}</span><br>
                                        <small>{{ $donasi->kejadianBencana->lokasi_text }}</small>
                                    @else
                                        <span class="badge bg-warning">Data Kejadian Tidak Ditemukan</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Jenis Donasi</th>
                                <td>
                                    <span class="badge bg-{{ $donasi->jenis == 'uang' ? 'success' : ($donasi->jenis == 'barang' ? 'warning' : 'info') }}">
                                        {{ $donasi->jenis_donasi }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="200">Nilai Donasi</th>
                                <td>
                                    @if($donasi->nilai)
                                        <h5 class="text-success">{{ $donasi->nilai_formatted }}</h5>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal Donasi</th>
                                <td>{{ $donasi->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Terakhir Diupdate</th>
                                <td>{{ $donasi->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if($donasi->keterangan)
                <div class="row mt-3">
                    <div class="col-12">
                        <h6>Keterangan:</h6>
                        <p class="text-muted">{{ $donasi->keterangan }}</p>
                    </div>
                </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('donasi-bencana.index') }}" class="btn btn-secondary">
                        <i class="mdi mdi-arrow-left me-1"></i> Kembali
                    </a>
                    <div>
                        <a href="{{ route('donasi-bencana.edit', $donasi->donasi_id) }}" class="btn btn-warning me-2">
                            <i class="mdi mdi-pencil me-1"></i> Edit
                        </a>
                        <form action="{{ route('donasi-bencana.destroy', $donasi->donasi_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus donasi ini?')">
                                <i class="mdi mdi-delete me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
