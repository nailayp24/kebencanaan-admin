<?php

namespace App\Http\Controllers;

use App\Models\KejadianBencana;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class KejadianBencanaController extends Controller
{
   public function index(Request $request)
    {
        $filterableColumns = ['jenis_bencana', 'status_kejadian'];
        $searchableColumns = ['jenis_bencana', 'lokasi_text', 'dampak', 'keterangan'];

        $kejadian = KejadianBencana::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Untuk dropdown filter
        $jenisBencanaOptions = KejadianBencana::distinct()->pluck('jenis_bencana');
        $statusOptions = ['dilaporkan', 'diverifikasi', 'ditangani', 'selesai'];

        return view('pages.kejadian-bencana.index', compact('kejadian', 'jenisBencanaOptions', 'statusOptions'));
    }


    public function create()
    {
        return view('pages.kejadian-bencana.create');
    }

     // ===== TAMBAHKAN UPLOAD FILE =====
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_bencana' => 'required|max:50',
            'tanggal' => 'required|date',
            'lokasi_text' => 'required',
            'rt' => 'required|max:3',
            'rw' => 'required|max:3',
            'dampak' => 'required',
            'status_kejadian' => 'required|in:dilaporkan,diverifikasi,ditangani,selesai',
            'keterangan' => 'nullable',
            // Tambah validasi untuk file upload
            'foto_berita_acara.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi');
        }

        // Simpan kejadian bencana
        $kejadian = KejadianBencana::create($request->except('foto_berita_acara'));

        // ===== UPLOAD MULTIPLE FILE KE TABEL MEDIA =====
        if ($request->hasFile('foto_berita_acara')) {
            foreach ($request->file('foto_berita_acara') as $index => $file) {
                if ($file->isValid()) {
                    // 1. Generate nama file unik
                    $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();

                    // 2. Simpan file ke storage
                    $file->storeAs('uploads/kejadian_bencana', $fileName, 'public');

                    // 3. Simpan ke tabel media
                    Media::create([
                        'ref_table' => 'kejadian_bencana',
                        'ref_id' => $kejadian->kejadian_id,
                        'file_name' => $fileName,
                        'caption' => 'Foto/Berita Acara - ' . ($index + 1),
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => $index
                    ]);
                }
            }
        }

        return redirect()->route('kejadian-bencana.index')
            ->with('success', 'Data kejadian bencana berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kejadian = KejadianBencana::findOrFail($id);

        // Ambil file yang sudah diupload untuk kejadian ini
        $mediaFiles = Media::where('ref_table', 'kejadian_bencana')
                          ->where('ref_id', $id)
                          ->orderBy('sort_order')
                          ->get();

        return view('pages.kejadian-bencana.edit', compact('kejadian', 'mediaFiles'));
    }

    public function update(Request $request, $id)
    {
        $kejadian = KejadianBencana::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'jenis_bencana' => 'required|max:50',
            'tanggal' => 'required|date',
            'lokasi_text' => 'required',
            'rt' => 'required|max:3',
            'rw' => 'required|max:3',
            'dampak' => 'required',
            'status_kejadian' => 'required|in:dilaporkan,diverifikasi,ditangani,selesai',
            'keterangan' => 'nullable',
            'foto_berita_acara.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi');
        }

        $kejadian->update($request->except('foto_berita_acara', 'delete_media'));

        // ===== UPLOAD FILE BARU =====
        if ($request->hasFile('foto_berita_acara')) {
            // Hitung file yang sudah ada
            $existingCount = Media::where('ref_table', 'kejadian_bencana')
                                 ->where('ref_id', $id)
                                 ->count();

            foreach ($request->file('foto_berita_acara') as $index => $file) {
                if ($file->isValid()) {
                    $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                    $file->storeAs('uploads/kejadian_bencana', $fileName, 'public');

                    Media::create([
                        'ref_table' => 'kejadian_bencana',
                        'ref_id' => $kejadian->kejadian_id,
                        'file_name' => $fileName,
                        'caption' => 'Foto/Berita Acara - Baru',
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
                    Storage::disk('public')->delete('uploads/kejadian_bencana/' . $media->file_name);
                    // Hapus dari database
                    $media->delete();
                }
            }
        }

        return redirect()->route('kejadian-bencana.index')
            ->with('success', 'Data kejadian bencana berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kejadian = KejadianBencana::findOrFail($id);

        // Hapus file media terkait sebelum hapus kejadian
        $mediaFiles = Media::where('ref_table', 'kejadian_bencana')
                          ->where('ref_id', $id)
                          ->get();

        foreach ($mediaFiles as $media) {
            Storage::disk('public')->delete('uploads/kejadian_bencana/' . $media->file_name);
            $media->delete();
        }

        $kejadian->delete();

        return redirect()->route('kejadian-bencana.index')
            ->with('success', 'Data kejadian bencana berhasil dihapus');
    }

    // ===== TAMBAH METHOD SHOW UNTUK DETAIL =====
    public function show($id)
    {
        $kejadian = KejadianBencana::findOrFail($id);

        // Ambil semua file media untuk kejadian ini
        $mediaFiles = Media::where('ref_table', 'kejadian_bencana')
                          ->where('ref_id', $id)
                          ->orderBy('sort_order')
                          ->get();

        return view('pages.kejadian-bencana.show', compact('kejadian', 'mediaFiles'));
    }
}
