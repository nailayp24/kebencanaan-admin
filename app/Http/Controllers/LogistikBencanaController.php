<?php
// app/Http\Controllers/LogistikBencanaController.php

namespace App\Http\Controllers;

use App\Models\LogistikBencana;
use App\Models\KejadianBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LogistikBencanaController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['kejadian_id', 'satuan'];
        $searchableColumns = ['nama_barang', 'sumber'];

        $logistik = LogistikBencana::with('kejadianBencana')
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Untuk dropdown filter
        $kejadianOptions = KejadianBencana::orderBy('tanggal', 'desc')->get();
        $satuanOptions = LogistikBencana::distinct()->pluck('satuan');

        return view('pages.logistik-bencana.index', compact('logistik', 'kejadianOptions', 'satuanOptions'));
    }

    public function create()
    {
        $kejadian = KejadianBencana::where('status_kejadian', '!=', 'selesai')
            ->orderBy('tanggal', 'desc')
            ->get();

        // Default satuan
        $satuanDefault = ['Kg', 'Liter', 'Dus', 'Paket', 'Buah', 'Unit', 'Lainnya'];

        return view('pages.logistik-bencana.create', compact('kejadian', 'satuanDefault'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kejadian_id' => 'required|exists:kejadian_bencana,kejadian_id',
            'nama_barang' => 'required|max:100',
            'satuan' => 'required|max:20',
            'stok' => 'required|integer|min:0',
            'sumber' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi');
        }

        LogistikBencana::create($request->all());

        return redirect()->route('logistik-bencana.index')
            ->with('success', 'Data logistik berhasil ditambahkan');
    }

    public function show($id)
    {
        $logistik = LogistikBencana::with(['kejadianBencana', 'distribusi.posko'])->findOrFail($id);

        return view('pages.logistik-bencana.show', compact('logistik'));
    }

    public function edit($id)
    {
        $logistik = LogistikBencana::findOrFail($id);
        $kejadian = KejadianBencana::where('status_kejadian', '!=', 'selesai')
            ->orWhere('kejadian_id', $logistik->kejadian_id)
            ->orderBy('tanggal', 'desc')
            ->get();

        $satuanDefault = ['Kg', 'Liter', 'Dus', 'Paket', 'Buah', 'Unit', 'Lainnya'];

        return view('pages.logistik-bencana.edit', compact('logistik', 'kejadian', 'satuanDefault'));
    }

    public function update(Request $request, $id)
    {
        $logistik = LogistikBencana::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kejadian_id' => 'required|exists:kejadian_bencana,kejadian_id',
            'nama_barang' => 'required|max:100',
            'satuan' => 'required|max:20',
            'stok' => 'required|integer|min:0',
            'sumber' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi');
        }

        $logistik->update($request->all());

        return redirect()->route('logistik-bencana.index')
            ->with('success', 'Data logistik berhasil diperbarui');
    }

    public function destroy($id)
    {
        $logistik = LogistikBencana::findOrFail($id);

        // Cek apakah ada distribusi yang terkait
        if ($logistik->distribusi()->count() > 0) {
            return redirect()->route('logistik-bencana.index')
                ->with('error', 'Tidak dapat menghapus logistik karena sudah ada distribusi terkait');
        }

        $logistik->delete();

        return redirect()->route('logistik-bencana.index')
            ->with('success', 'Data logistik berhasil dihapus');
    }

    // API untuk mendapatkan stok tersedia
    public function getStokTersedia($id)
    {
        $logistik = LogistikBencana::findOrFail($id);
        return response()->json([
            'stok_tersedia' => $logistik->stok_tersedia
        ]);
    }
}
