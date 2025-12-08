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

                       {{-- Bukti Donasi --}}
                <div class="mt-4">
                    <h5 class="mb-3">
                        <i class="mdi mdi-file-document-multiple me-2"></i>Bukti Donasi
                        <span class="badge bg-primary ms-2">{{ $mediaFiles->count() }} file</span>
                    </h5>

                    @if($mediaFiles->count() > 0)
                        <div class="row">
                            @foreach($mediaFiles as $file)
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        @if(str_contains($file->mime_type, 'image'))
                                            <a href="{{ asset('storage/uploads/donasi_bencana/' . $file->file_name) }}"
                                               target="_blank">
                                                <img src="{{ asset('storage/uploads/donasi_bencana/' . $file->file_name) }}"
                                                     class="card-img-top" alt="{{ $file->caption }}"
                                                     style="height: 150px; object-fit: cover;">
                                            </a>
                                        @elseif(str_contains($file->mime_type, 'pdf'))
                                            <div class="card-body text-center">
                                                <i class="mdi mdi-file-pdf-box" style="font-size: 64px; color: #e74c3c;"></i>
                                                <h6 class="mt-2">Bukti PDF</h6>
                                                <p class="small text-muted">{{ $file->file_name }}</p>
                                            </div>
                                        @else
                                            <div class="card-body text-center">
                                                <i class="mdi mdi-file-document-outline" style="font-size: 64px;"></i>
                                                <h6 class="mt-2">{{ $file->caption ?? 'Dokumen Bukti' }}</h6>
                                                <p class="small text-muted">{{ $file->file_name }}</p>
                                            </div>
                                        @endif
                                        <div class="card-footer p-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">
                                                    {{ $file->caption ?? 'File bukti' }}
                                                </small>
                                                <div>
                                                    <a href="{{ asset('storage/uploads/donasi_bencana/' . $file->file_name) }}"
                                                       target="_blank" class="btn btn-sm btn-info" title="Lihat">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="{{ asset('storage/uploads/donasi_bencana/' . $file->file_name) }}"
                                                       download class="btn btn-sm btn-success" title="Download">
                                                        <i class="mdi mdi-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="mdi mdi-information-outline me-2"></i>
                            Belum ada bukti donasi yang diupload
                        </div>
                    @endif
                </div>


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
