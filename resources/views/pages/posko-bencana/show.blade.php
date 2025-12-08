{{-- resources/views/admin/posko-bencana/show.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">
                        <i class="mdi mdi-home-eye me-2"></i>Detail Posko Bencana
                    </h4>
                    <div>
                        <a href="{{ route('posko-bencana.edit', $posko->posko_id) }}" class="btn btn-warning btn-sm">
                            <i class="mdi mdi-pencil me-1"></i> Edit
                        </a>
                        <a href="{{ route('posko-bencana.index') }}" class="btn btn-secondary btn-sm">
                            <i class="mdi mdi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- Informasi Posko --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5 class="mb-3">Informasi Posko</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th width="40%">Nama Posko</th>
                                <td>{{ $posko->nama }}</td>
                            </tr>
                            <tr>
                                <th>Penanggung Jawab</th>
                                <td>{{ $posko->penanggung_jawab }}</td>
                            </tr>
                            <tr>
                                <th>Kontak</th>
                                <td>{{ $posko->kontak }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-3">Informasi Kejadian</h5>
                        @if($posko->kejadianBencana)
                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">Jenis Bencana</th>
                                    <td>{{ $posko->kejadianBencana->jenis_bencana }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td>{{ $posko->kejadianBencana->tanggal->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Lokasi</th>
                                    <td>{{ $posko->kejadianBencana->lokasi_text }}</td>
                                </tr>
                            </table>
                        @else
                            <div class="alert alert-warning">
                                <i class="mdi mdi-alert me-2"></i>
                                Data kejadian bencana tidak ditemukan
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    <h5>Alamat Posko</h5>
                    <div class="border p-3 bg-light">
                        {{ $posko->alamat }}
                    </div>
                </div>

                {{-- Foto Posko --}}
                <div class="mt-4">
                    <h5 class="mb-3">
                        <i class="mdi mdi-image-multiple me-2"></i>Foto Posko
                        <span class="badge bg-primary ms-2">{{ $mediaFiles->count() }} file</span>
                    </h5>

                    @if($mediaFiles->count() > 0)
                        <div class="row">
                            @foreach($mediaFiles as $file)
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        @if(str_contains($file->mime_type, 'image'))
                                            <a href="{{ asset('storage/uploads/posko_bencana/' . $file->file_name) }}"
                                               target="_blank">
                                                <img src="{{ asset('storage/uploads/posko_bencana/' . $file->file_name) }}"
                                                     class="card-img-top" alt="{{ $file->caption }}"
                                                     style="height: 150px; object-fit: cover;">
                                            </a>
                                        @else
                                            <div class="card-body text-center">
                                                <i class="mdi mdi-file-pdf-box" style="font-size: 64px; color: #e74c3c;"></i>
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
                                                    <a href="{{ asset('storage/uploads/posko_bencana/' . $file->file_name) }}"
                                                       target="_blank" class="btn btn-sm btn-info" title="Lihat">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>
                                                    <a href="{{ asset('storage/uploads/posko_bencana/' . $file->file_name) }}"
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
                            Belum ada foto posko yang diupload
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
