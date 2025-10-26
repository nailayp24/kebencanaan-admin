<?php
//tes
namespace App\Http\Controllers;

use App\Models\KejadianBencana;
use Illuminate\Http\Request;

class KejadianController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel kejadian_bencana
        $kejadian = KejadianBencana::orderBy('created_at', 'desc')->get();

        // Kirim ke view kejadian/index.blade.php
        return view('kejadian.index', compact('kejadian'));
    }

    public function create()
    {
        return view('kejadian.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_bencana' => 'required',
            'tanggal' => 'required|date',
            'lokasi_text' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'dampak' => 'required',
            'status' => 'required',
            'keterangan' => 'nullable',
        ]);

        KejadianBencana::create($request->all());

        return redirect()->route('kejadian.index')->with('success', 'Data kejadian berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kejadian = KejadianBencana::findOrFail($id);
        return view('kejadian.show', compact('kejadian'));
    }

    public function edit($id)
    {
        $kejadian = KejadianBencana::findOrFail($id);
        return view('kejadian.edit', compact('kejadian'));
    }

    public function update(Request $request, $id)
    {
        $kejadian = KejadianBencana::findOrFail($id);
        $kejadian->update($request->all());
        return redirect()->route('kejadian.index')->with('success', 'Data kejadian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kejadian = KejadianBencana::findOrFail($id);
        $kejadian->delete();
        return redirect()->route('kejadian.index')->with('success', 'Data kejadian berhasil dihapus.');
    }
}
