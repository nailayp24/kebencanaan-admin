<?php
namespace App\Http\Controllers;

use App\Models\PoskoBencana;
use App\Models\KejadianBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PoskoBencanaController extends Controller
{
    public function index()
    {
      
        $posko = PoskoBencana::with(['kejadianBencana' => function($query) {
            $query->withDefault([
                'jenis_bencana' => 'Data Tidak Ditemukan',
                'lokasi_text' => '-'
            ]);
        }])->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.posko-bencana.index', compact('posko'));
    }

    // METHOD LAINNYA TETAP SAMA...
    public function create()
    {
        $kejadian = KejadianBencana::where(function($query) {
            $query->where('status_kejadian', '!=', 'selesai')
                  ->orWhereIn('status_kejadian', ['dilaporkan', 'diverifikasi', 'ditangani']);
        })->orderBy('tanggal', 'desc')->get();

        return view('admin.posko-bencana.create', compact('kejadian'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kejadian_id' => 'required|exists:kejadian_bencana,kejadian_id',
            'nama' => 'required|max:100',
            'alamat' => 'required',
            'kontak' => 'required|max:15',
            'penanggung_jawab' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi');
        }

        PoskoBencana::create($request->all());

        return redirect()->route('posko-bencana.index')
            ->with('success', 'Data posko bencana berhasil ditambahkan');
    }



    public function edit($id)
    {
        $posko = PoskoBencana::findOrFail($id);
        $kejadian = KejadianBencana::all();
        return view('admin.posko-bencana.edit', compact('posko', 'kejadian'));
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
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi');
        }

        $posko->update($request->all());

        return redirect()->route('posko-bencana.index')
            ->with('success', 'Data posko bencana berhasil diperbarui');
    }

    public function destroy($id)
    {
        $posko = PoskoBencana::findOrFail($id);
        $posko->delete();

        return redirect()->route('posko-bencana.index')
            ->with('success', 'Data posko bencana berhasil dihapus');
    }
}
