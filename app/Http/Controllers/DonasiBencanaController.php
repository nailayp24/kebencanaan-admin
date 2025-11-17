<?php
// app/Http\Controllers/DonasiBencanaController.php

namespace App\Http\Controllers;

use App\Models\DonasiBencana;
use App\Models\KejadianBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonasiBencanaController extends Controller
{
    public function index()
    {
        $donasi = DonasiBencana::with('kejadianBencana')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.donasi-bencana.index', compact('donasi'));
    }

    public function create()
    {
        $kejadian = KejadianBencana::where('status_kejadian', '!=', 'selesai')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('pages.donasi-bencana.create', compact('kejadian'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kejadian_id' => 'required|exists:kejadian_bencana,kejadian_id',
            'donatur_nama' => 'required|max:100',
            'jenis' => 'required|in:uang,barang,jasa',
            'nilai' => 'nullable|numeric|min:0',
            'keterangan' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi');
        }

        DonasiBencana::create($request->all());

        return redirect()->route('donasi-bencana.index')
            ->with('success', 'Data donasi berhasil ditambahkan');
    }

    public function show($id)
    {
        $donasi = DonasiBencana::with('kejadianBencana')->findOrFail($id);
        return view('pages.donasi-bencana.show', compact('donasi'));
    }

    public function edit($id)
    {
        $donasi = DonasiBencana::findOrFail($id);
        $kejadian = KejadianBencana::where('status_kejadian', '!=', 'selesai')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('pages.donasi-bencana.edit', compact('donasi', 'kejadian'));
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
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi');
        }

        $donasi->update($request->all());

        return redirect()->route('donasi-bencana.index')
            ->with('success', 'Data donasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $donasi = DonasiBencana::findOrFail($id);
        $donasi->delete();

        return redirect()->route('donasi-bencana.index')
            ->with('success', 'Data donasi berhasil dihapus');
    }
}
