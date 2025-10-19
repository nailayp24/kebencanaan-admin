@extends('layout.master')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Edit Data Posko Bencana</h5>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan!</strong>
                    <ul class="mt-2 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('posko.update', $posko->posko_id) }}">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="kejadian_id" class="form-label">ID Kejadian</label>
                        <input type="text" name="kejadian_id" id="kejadian_id"
                            value="{{ old('kejadian_id', $posko->kejadian_id) }}" class="form-control"
                            placeholder="Masukkan ID Kejadian">
                    </div>
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Nama Posko</label>
                        <input type="text" name="nama" id="nama"
                            value="{{ old('nama', $posko->nama) }}" class="form-control"
                            placeholder="Masukkan Nama Posko">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Posko</label>
                    <input type="text" name="alamat" id="alamat"
                        value="{{ old('alamat', $posko->alamat) }}" class="form-control"
                        placeholder="Masukkan Alamat Lengkap Posko">
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="kontak" class="form-label">Nomor Kontak</label>
                        <input type="text" name="kontak" id="kontak"
                            value="{{ old('kontak', $posko->kontak) }}" class="form-control"
                            placeholder="Contoh: 081234567890">
                    </div>
                    <div class="col-md-6">
                        <label for="penanggung_jawab" class="form-label">Penanggung Jawab</label>
                        <input type="text" name="penanggung_jawab" id="penanggung_jawab"
                            value="{{ old('penanggung_jawab', $posko->penanggung_jawab) }}" class="form-control"
                            placeholder="Nama Penanggung Jawab">
                    </div>
                </div>



                <div class="text-end">
                    <a href="{{ route('posko.index') }}" class="btn btn-secondary me-2">⬅ Kembali</a>
                    <button type="submit" class="btn btn-warning text-white">💾 Perbarui Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
