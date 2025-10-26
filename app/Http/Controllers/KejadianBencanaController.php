<?php

namespace App\Http\Controllers;

use App\Models\KejadianBencana;
use App\Models\PoskoBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KejadianBencanaController extends Controller
{
    public function index()
    {
        $kejadian = KejadianBencana::orderBy('tanggal', 'desc')->paginate(10);
        return view('admin.kejadian-bencana.index', compact('kejadian'));
    }

    public function create()
    {
        return view('admin.kejadian-bencana.create');
    }

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
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi');
        }

        KejadianBencana::create($request->all());

        return redirect()->route('kejadian-bencana.index')
            ->with('success', 'Data kejadian bencana berhasil ditambahkan');
    }

    public function edit($id)
    {
        // GUNAKAN PRIMARY KEY YANG BENAR
        $kejadian = KejadianBencana::where('kejadian_id', $id)->firstOrFail();
        return view('admin.kejadian-bencana.edit', compact('kejadian'));
    }

    public function update(Request $request, $id)
    {
        // GUNAKAN PRIMARY KEY YANG BENAR
        $kejadian = KejadianBencana::where('kejadian_id', $id)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'jenis_bencana' => 'required|max:50',
            'tanggal' => 'required|date',
            'lokasi_text' => 'required',
            'rt' => 'required|max:3',
            'rw' => 'required|max:3',
            'dampak' => 'required',
            'status_kejadian' => 'required|in:dilaporkan,diverifikasi,ditangani,selesai',
            'keterangan' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi');
        }

        $kejadian->update($request->all());

        return redirect()->route('kejadian-bencana.index')
            ->with('success', 'Data kejadian bencana berhasil diperbarui');
    }

    public function destroy($id)
    {
        // GUNAKAN PRIMARY KEY YANG BENAR
        $kejadian = KejadianBencana::where('kejadian_id', $id)->firstOrFail();
        $kejadian->delete();

        return redirect()->route('kejadian-bencana.index')
            ->with('success', 'Data kejadian bencana berhasil dihapus');
    }
}
