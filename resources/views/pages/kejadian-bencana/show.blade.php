{{-- resources/views/admin/kejadian-bencana/show.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">
                        <i class="mdi mdi-alert-circle-outline me-2"></i>Detail Kejadian Bencana
                    </h4>
                    <div>
                        <a href="{{ route('kejadian-bencana.edit', $kejadian->kejadian_id) }}" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-pencil me-1"></i> Edit
                        </a>
                        <a href="{{ route('kejadian-bencana.index') }}" class="btn btn-secondary btn-sm">
                            <i class="mdi mdi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- Informasi Kejadian --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5 class="mb-3">
                            <i class="mdi mdi-information-outline me-2"></i>Informasi Kejadian
                        </h5>
                        <table class="table table-bordered">
                            <tr>
                                <th width="40%">Jenis Bencana</th>
                                <td>{{ $kejadian->jenis_bencana }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>{{ $kejadian->tanggal->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <th>Lokasi</th>
                                <td>{{ $kejadian->lokasi_text }}</td>
                            </tr>
                            <tr>
                                <th>RT/RW</th>
                                <td>{{ $kejadian->rt }}/{{ $kejadian->rw }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-3">
                            <i class="mdi mdi-clipboard-text-outline me-2"></i>Status & Dampak
                        </h5>
                        <table class="table table-bordered">
                            <tr>
                                <th width="40%">Status</th>
                                <td>
                                    @php
                                        $statusColors = [
                                            'dilaporkan' => 'warning',
                                            'diverifikasi' => 'info',
                                            'ditangani' => 'primary',
                                            'selesai' => 'success',
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $statusColors[$kejadian->status_kejadian] ?? 'secondary' }}">
                                        {{ ucfirst($kejadian->status_kejadian) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Total Posko</th>
                                <td>
                                    <span class="badge bg-primary">{{ $kejadian->posko->count() ?? 0 }} Posko</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Total Donasi</th>
                                <td>
                                    <span class="badge bg-success">{{ $kejadian->total_donasi_formatted ?? 'Rp 0' }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                {{-- Dampak dan Keterangan --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Dampak Bencana</h5>
                        <div class="border p-3 bg-light rounded">
                            {{ $kejadian->dampak }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Keterangan</h5>
                        <div class="border p-3 bg-light rounded">
                            {{ $kejadian->keterangan ?? 'Tidak ada keterangan tambahan' }}
                        </div>
                    </div>
                </div>

                {{-- Foto / Berita Acara --}}
                <div class="mt-4">
                    <h5 class="mb-3">
                        <i class="mdi mdi-image-multiple me-2"></i>Foto / Berita Acara
                        <span class="badge bg-primary ms-2">{{ $mediaFiles->count() }} file</span>
                    </h5>

                    @if($mediaFiles->count() > 0)
                        <div class="row">
                            @foreach($mediaFiles as $file)
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        @if(str_contains($file->mime_type, 'image'))
                                            <a href="{{ asset('storage/uploads/kejadian_bencana/' . $file->file_name) }}"
                                               target="_blank">
                                                <img src="{{ asset('storage/uploads/kejadian_bencana/' . $file->file_name) }}"
                                                     class="card-img-top" alt="{{ $file->caption }}"
                                                     style="height: 150px; object-fit: cover;">
                                            </a>
                                        @elseif(str_contains($file->mime_type, 'pdf'))
                                            <div class="card-body text-center">
                                                <i class="mdi mdi-file-pdf-box" style="font-size: 64px; color: #e74c3c;"></i>
                                                <h6 class="mt-2">PDF Document</h6>
                                                <p class="small text-muted">{{ $file->file_name }}</p>
                                            </div>
                                        @else
                                            <div class="card-body text-center">
                                                <i class="mdi mdi-file-document-outline" style="font-size: 64px;"></i>
                                                <h6 class="mt-2">{{ $file->caption ?? 'Dokumen' }}</h6>
                                                <p class="small text-muted">{{ $file->file_name }}</p>
                                            </div>
                                        @endif
                                        <div class="card-footer p-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">
                                                    {{ $file->caption ?? 'File pendukung' }}
                                                </small>
                                                <div>
                                                    <a href="{{ asset('storage/uploads/kejadian_bencana/' . $file->file_name) }}"
                                                       target="_blank" class="btn btn-sm btn-info" title="Lihat">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="{{ asset('storage/uploads/kejadian_bencana/' . $file->file_name) }}"
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
                            Belum ada foto atau berita acara yang diupload
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
