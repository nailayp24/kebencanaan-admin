<?php
// app/Http\Controllers/DistribusiLogistikController.php

namespace App\Http\Controllers;

use App\Models\DistribusiLogistik;
use App\Models\LogistikBencana;
use App\Models\PoskoBencana;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class DistribusiLogistikController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['logistik_id', 'posko_id'];
        $searchableColumns = ['penerima'];

        $distribusi = DistribusiLogistik::with(['logistik', 'posko'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Untuk dropdown filter
        $logistikOptions = LogistikBencana::with('kejadianBencana')->get();
        $poskoOptions = PoskoBencana::with('kejadianBencana')->get();

        return view('pages.distribusi-logistik.index', compact('distribusi', 'logistikOptions', 'poskoOptions'));
    }

    public function create()
    {
        $logistik = LogistikBencana::with('kejadianBencana')
            ->whereHas('kejadianBencana', function($query) {
                $query->where('status_kejadian', '!=', 'selesai');
            })
            ->get();

        $posko = PoskoBencana::with('kejadianBencana')
            ->whereHas('kejadianBencana', function($query) {
                $query->where('status_kejadian', '!=', 'selesai');
            })
            ->get();

        return view('pages.distribusi-logistik.create', compact('logistik', 'posko'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logistik_id' => 'required|exists:logistik_bencana,logistik_id',
            'posko_id' => 'required|exists:posko_bencana,posko_id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'penerima' => 'required|max:100',
            'bukti_distribusi.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Validasi stok tersedia
        if ($request->has('logistik_id') && $request->has('jumlah')) {
            $logistik = LogistikBencana::find($request->logistik_id);
            if ($logistik && $request->jumlah > $logistik->stok_tersedia) {
                $validator->errors()->add('jumlah', 'Jumlah distribusi melebihi stok tersedia. Stok tersedia: ' . $logistik->stok_tersedia);
            }
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi');
        }

        // Simpan distribusi
        $distribusi = DistribusiLogistik::create($request->except('bukti_distribusi'));

        // Upload file bukti distribusi
        if ($request->hasFile('bukti_distribusi')) {
            foreach ($request->file('bukti_distribusi') as $index => $file) {
                if ($file->isValid()) {
                    $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                    $file->storeAs('uploads/distribusi_logistik', $fileName, 'public');

                    Media::create([
                        'ref_table' => 'distribusi_logistik',
                        'ref_id' => $distribusi->distribusi_id,
                        'file_name' => $fileName,
                        'caption' => 'Bukti Distribusi - ' . ($index + 1),
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => $index
                    ]);
                }
            }
        }

        return redirect()->route('distribusi-logistik.index')
            ->with('success', 'Data distribusi logistik berhasil ditambahkan');
    }

    public function show($id)
    {
        $distribusi = DistribusiLogistik::with(['logistik.kejadianBencana', 'posko'])->findOrFail($id);

        // Ambil file media untuk distribusi ini
        $mediaFiles = Media::where('ref_table', 'distribusi_logistik')
                          ->where('ref_id', $id)
                          ->orderBy('sort_order')
                          ->get();

        return view('pages.distribusi-logistik.show', compact('distribusi', 'mediaFiles'));
    }

    public function edit($id)
    {
        $distribusi = DistribusiLogistik::findOrFail($id);

        $logistik = LogistikBencana::with('kejadianBencana')->get();
        $posko = PoskoBencana::with('kejadianBencana')->get();

        // Ambil file yang sudah diupload
        $mediaFiles = Media::where('ref_table', 'distribusi_logistik')
                          ->where('ref_id', $id)
                          ->orderBy('sort_order')
                          ->get();

        return view('pages.distribusi-logistik.edit', compact('distribusi', 'logistik', 'posko', 'mediaFiles'));
    }

    public function update(Request $request, $id)
    {
        $distribusi = DistribusiLogistik::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'logistik_id' => 'required|exists:logistik_bencana,logistik_id',
            'posko_id' => 'required|exists:posko_bencana,posko_id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'penerima' => 'required|max:100',
            'bukti_distribusi.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Validasi stok tersedia (hitung ulang dengan mengabaikan distribusi ini)
        if ($request->has('logistik_id') && $request->has('jumlah')) {
            $logistik = LogistikBencana::find($request->logistik_id);
            if ($logistik) {
                $stokSudahDidistribusi = $logistik->distribusi()
                    ->where('distribusi_id', '!=', $id)
                    ->sum('jumlah');
                $stokTersedia = $logistik->stok - $stokSudahDidistribusi;

                if ($request->jumlah > $stokTersedia) {
                    $validator->errors()->add('jumlah', 'Jumlah distribusi melebihi stok tersedia. Stok tersedia: ' . $stokTersedia);
                }
            }
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi');
        }

        $distribusi->update($request->except('bukti_distribusi', 'delete_media'));

        // Upload file baru
        if ($request->hasFile('bukti_distribusi')) {
            $existingCount = Media::where('ref_table', 'distribusi_logistik')
                                 ->where('ref_id', $id)
                                 ->count();

            foreach ($request->file('bukti_distribusi') as $index => $file) {
                if ($file->isValid()) {
                    $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                    $file->storeAs('uploads/distribusi_logistik', $fileName, 'public');

                    Media::create([
                        'ref_table' => 'distribusi_logistik',
                        'ref_id' => $distribusi->distribusi_id,
                        'file_name' => $fileName,
                        'caption' => 'Bukti Distribusi - Baru',
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => $existingCount + $index
                    ]);
                }
            }
        }

        // Hapus file yang dipilih
        if ($request->has('delete_media')) {
            foreach ($request->delete_media as $mediaId) {
                $media = Media::find($mediaId);
                if ($media) {
                    Storage::disk('public')->delete('uploads/distribusi_logistik/' . $media->file_name);
                    $media->delete();
                }
            }
        }

        return redirect()->route('distribusi-logistik.index')
            ->with('success', 'Data distribusi logistik berhasil diperbarui');
    }

    public function destroy($id)
    {
        $distribusi = DistribusiLogistik::findOrFail($id);

        // Hapus file media terkait
        $mediaFiles = Media::where('ref_table', 'distribusi_logistik')
                          ->where('ref_id', $id)
                          ->get();

        foreach ($mediaFiles as $media) {
            Storage::disk('public')->delete('uploads/distribusi_logistik/' . $media->file_name);
            $media->delete();
        }

        $distribusi->delete();

        return redirect()->route('distribusi-logistik.index')
            ->with('success', 'Data distribusi logistik berhasil dihapus');
    }
}
