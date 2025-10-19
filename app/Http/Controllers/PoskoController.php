<?php

namespace App\Http\Controllers;

use App\Models\PoskoBencana;
use Illuminate\Http\Request;

class PoskoController extends Controller
{
    public function index()
    {
        $data = PoskoBencana::latest()->paginate(10);
        return view('posko.index', compact('data'));
    }

    public function create()
    {
        return view('posko.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kejadian_id' => 'required|numeric',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
             'kontak' => 'required|string|max:50',
            'penanggung_jawab' => 'required|string|max:255',
        ]);

        PoskoBencana::create($validated);

        return redirect()->route('posko.index')->with('success', 'Data posko berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $posko = PoskoBencana::findOrFail($id);
        return view('posko.edit', compact('posko'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kejadian_id' => 'required|numeric',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
             'kontak' => 'required|string|max:50',
            'penanggung_jawab' => 'required|string|max:255',
        ]);

        $posko = PoskoBencana::findOrFail($id);
        $posko->update($validated);

        return redirect()->route('posko.index')->with('success', 'Data posko berhasil diperbarui!');
    }

    public function destroy($id)
    {
        PoskoBencana::findOrFail($id)->delete();
        return redirect()->route('posko.index')->with('success', 'Data posko berhasil dihapus!');
    }
}
