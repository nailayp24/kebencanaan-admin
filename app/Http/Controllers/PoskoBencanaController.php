<?php

namespace App\Http\Controllers;

use App\Models\PoskoBencana;
use App\Models\KejadianBencana;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PoskoBencanaController extends Controller
{
      public function index(Request $request)
    {
        $filterableColumns = ['kejadian_id'];
        $searchableColumns = ['nama', 'alamat', 'kontak', 'penanggung_jawab'];

        $posko = PoskoBencana::with(['kejadianBencana'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Ambil data kejadian untuk dropdown filter
        $kejadianOptions = KejadianBencana::orderBy('tanggal', 'desc')->get();

        return view('pages.posko-bencana.index', compact('posko', 'kejadianOptions'));
    }

    public function create()
    {
        $kejadian = KejadianBencana::where(function($query) {
            $query->where('status_kejadian', '!=', 'selesai')
                  ->orWhereIn('status_kejadian', ['dilaporkan', 'diverifikasi', 'ditangani']);
        })->orderBy('tanggal', 'desc')->get();

        return view('pages.posko-bencana.create', compact('kejadian'));
    }

    // ===== TAMBAHKAN FITUR UPLOAD FILE =====
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kejadian_id' => 'required|exists:kejadian_bencana,kejadian_id',
            'nama' => 'required|max:100',
            'alamat' => 'required',
            'kontak' => 'required|max:15',
            'penanggung_jawab' => 'required|max:100',
            // Tambah validasi untuk file upload
            'foto_posko.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi');
        }

        // Simpan data posko
        $posko = PoskoBencana::create($request->except('foto_posko'));

        // ===== UPLOAD MULTIPLE FILE KE TABEL MEDIA =====
        if ($request->hasFile('foto_posko')) {
            foreach ($request->file('foto_posko') as $index => $file) {
                if ($file->isValid()) {
                    // 1. Generate nama file unik
                    $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();

                    // 2. Simpan file ke storage
                    $file->storeAs('uploads/posko_bencana', $fileName, 'public');

                    // 3. Simpan ke tabel media
                    Media::create([
                        'ref_table' => 'posko_bencana',
                        'ref_id' => $posko->posko_id,
                        'file_name' => $fileName,
                        'caption' => 'Foto Posko - ' . ($index + 1),
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => $index
                    ]);
                }
            }
        }

        return redirect()->route('posko-bencana.index')
            ->with('success', 'Data posko bencana berhasil ditambahkan');
    }

    public function edit($id)
    {
        $posko = PoskoBencana::findOrFail($id);
        $kejadian = KejadianBencana::all();

        // Ambil file yang sudah diupload untuk posko ini
        $mediaFiles = Media::where('ref_table', 'posko_bencana')
                          ->where('ref_id', $id)
                          ->orderBy('sort_order')
                          ->get();

        return view('pages.posko-bencana.edit', compact('posko', 'kejadian', 'mediaFiles'));
    }

    public function update(Request $request, $id)
    {
        $posko = PoskoBencana::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kejadian_id' => 'required|exists:kejadian_bencana,kejadian_id',
            'nama' => 'required|max:100',
            'alamat' => 'required',
            'kontak' => 'required|max:15',
            'penanggung_jawab' => 'required|max:100',
            'foto_posko.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi');
        }

        $posko->update($request->except('foto_posko', 'delete_media'));

        // ===== UPLOAD FILE BARU =====
        if ($request->hasFile('foto_posko')) {
            // Hitung file yang sudah ada
            $existingCount = Media::where('ref_table', 'posko_bencana')
                                 ->where('ref_id', $id)
                                 ->count();

            foreach ($request->file('foto_posko') as $index => $file) {
                if ($file->isValid()) {
                    $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                    $file->storeAs('uploads/posko_bencana', $fileName, 'public');

                    Media::create([
                        'ref_table' => 'posko_bencana',
                        'ref_id' => $posko->posko_id,
                        'file_name' => $fileName,
                        'caption' => 'Foto Posko - Baru',
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => $existingCount + $index
                    ]);
                }
            }
        }

        // ===== HAPUS FILE YANG DIPILIH =====
        if ($request->has('delete_media')) {
            foreach ($request->delete_media as $mediaId) {
                $media = Media::find($mediaId);
                if ($media) {
                    // Hapus file dari storage
                    Storage::disk('public')->delete('uploads/posko_bencana/' . $media->file_name);
                    // Hapus dari database
                    $media->delete();
                }
            }
        }

        return redirect()->route('posko-bencana.index')
            ->with('success', 'Data posko bencana berhasil diperbarui');
    }

    public function destroy($id)
    {
        $posko = PoskoBencana::findOrFail($id);

        // Hapus file media terkait sebelum hapus posko
        $mediaFiles = Media::where('ref_table', 'posko_bencana')
                          ->where('ref_id', $id)
                          ->get();

        foreach ($mediaFiles as $media) {
            Storage::disk('public')->delete('uploads/posko_bencana/' . $media->file_name);
            $media->delete();
        }

        $posko->delete();

        return redirect()->route('posko-bencana.index')
            ->with('success', 'Data posko bencana berhasil dihapus');
    }

    // ===== TAMBAH METHOD SHOW UNTUK DETAIL =====
    public function show($id)
    {
        $posko = PoskoBencana::with('kejadianBencana')->findOrFail($id);

        // Ambil semua file media untuk posko ini
        $mediaFiles = Media::where('ref_table', 'posko_bencana')
                          ->where('ref_id', $id)
                          ->orderBy('sort_order')
                          ->get();

        return view('pages.posko-bencana.show', compact('posko', 'mediaFiles'));
    }
}
