<?php
// app/Http\Controllers/DonasiBencanaController.php

namespace App\Http\Controllers;

use App\Models\DonasiBencana;
use App\Models\KejadianBencana;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class DonasiBencanaController extends Controller
{
        public function index(Request $request)
    {
        $filterableColumns = ['kejadian_id', 'jenis'];
        $searchableColumns = ['donatur_nama', 'keterangan'];

        $donasi = DonasiBencana::with('kejadianBencana')
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Untuk dropdown filter
        $kejadianOptions = KejadianBencana::orderBy('tanggal', 'desc')->get();
        $jenisOptions = [
            'uang' => 'Uang',
            'barang' => 'Barang',
            'jasa' => 'Jasa'
        ];

        return view('pages.donasi-bencana.index', compact('donasi', 'kejadianOptions', 'jenisOptions'));
    }

    public function create()
    {
        $kejadian = KejadianBencana::where('status_kejadian', '!=', 'selesai')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('pages.donasi-bencana.create', compact('kejadian'));
    }

     // ===== TAMBAHKAN UPLOAD FILE =====
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kejadian_id' => 'required|exists:kejadian_bencana,kejadian_id',
            'donatur_nama' => 'required|max:100',
            'jenis' => 'required|in:uang,barang,jasa',
            'nilai' => 'nullable|numeric|min:0',
            'keterangan' => 'nullable',
            // Tambah validasi untuk file upload
            'bukti_donasi.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi');
        }

        // Simpan donasi
        $donasi = DonasiBencana::create($request->except('bukti_donasi'));

        // ===== UPLOAD MULTIPLE FILE KE TABEL MEDIA =====
        if ($request->hasFile('bukti_donasi')) {
            foreach ($request->file('bukti_donasi') as $index => $file) {
                if ($file->isValid()) {
                    // 1. Generate nama file unik
                    $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();

                    // 2. Simpan file ke storage
                    $file->storeAs('uploads/donasi_bencana', $fileName, 'public');

                    // 3. Simpan ke tabel media
                    Media::create([
                        'ref_table' => 'donasi_bencana',
                        'ref_id' => $donasi->donasi_id,
                        'file_name' => $fileName,
                        'caption' => 'Bukti Donasi - ' . ($index + 1),
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => $index
                    ]);
                }
            }
        }

        return redirect()->route('donasi-bencana.index')
            ->with('success', 'Data donasi berhasil ditambahkan');
    }

    public function show($id)
    {
        $donasi = DonasiBencana::with('kejadianBencana')->findOrFail($id);

        // Ambil semua file media untuk donasi ini
        $mediaFiles = Media::where('ref_table', 'donasi_bencana')
                          ->where('ref_id', $id)
                          ->orderBy('sort_order')
                          ->get();

        return view('pages.donasi-bencana.show', compact('donasi', 'mediaFiles'));
    }

    public function edit($id)
    {
        $donasi = DonasiBencana::findOrFail($id);
        $kejadian = KejadianBencana::where('status_kejadian', '!=', 'selesai')
            ->orderBy('tanggal', 'desc')
            ->get();

        // Ambil file yang sudah diupload untuk donasi ini
        $mediaFiles = Media::where('ref_table', 'donasi_bencana')
                          ->where('ref_id', $id)
                          ->orderBy('sort_order')
                          ->get();

        return view('pages.donasi-bencana.edit', compact('donasi', 'kejadian', 'mediaFiles'));
    }

    public function update(Request $request, $id)
    {
        $donasi = DonasiBencana::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kejadian_id' => 'required|exists:kejadian_bencana,kejadian_id',
            'donatur_nama' => 'required|max:100',
            'jenis' => 'required|in:uang,barang,jasa',
            'nilai' => 'nullable|numeric|min:0',
            'keterangan' => 'nullable',
            'bukti_donasi.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi');
        }

        $donasi->update($request->except('bukti_donasi', 'delete_media'));

        // ===== UPLOAD FILE BARU =====
        if ($request->hasFile('bukti_donasi')) {
            // Hitung file yang sudah ada
            $existingCount = Media::where('ref_table', 'donasi_bencana')
                                 ->where('ref_id', $id)
                                 ->count();

            foreach ($request->file('bukti_donasi') as $index => $file) {
                if ($file->isValid()) {
                    $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                    $file->storeAs('uploads/donasi_bencana', $fileName, 'public');

                    Media::create([
                        'ref_table' => 'donasi_bencana',
                        'ref_id' => $donasi->donasi_id,
                        'file_name' => $fileName,
                        'caption' => 'Bukti Donasi - Baru',
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
                    Storage::disk('public')->delete('uploads/donasi_bencana/' . $media->file_name);
                    // Hapus dari database
                    $media->delete();
                }
            }
        }

        return redirect()->route('donasi-bencana.index')
            ->with('success', 'Data donasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $donasi = DonasiBencana::findOrFail($id);

        // Hapus file media terkait sebelum hapus donasi
        $mediaFiles = Media::where('ref_table', 'donasi_bencana')
                          ->where('ref_id', $id)
                          ->get();

        foreach ($mediaFiles as $media) {
            Storage::disk('public')->delete('uploads/donasi_bencana/' . $media->file_name);
            $media->delete();
        }

        $donasi->delete();

        return redirect()->route('donasi-bencana.index')
            ->with('success', 'Data donasi berhasil dihapus');
    }
}
