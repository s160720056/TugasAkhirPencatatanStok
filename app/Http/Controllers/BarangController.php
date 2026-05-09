<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Exports\ExportBarang;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index()
    {
        if (empty(config('database.connections.dynamic.database'))) {
            return redirect('/home');
        }
        return view('page.barang.index');
    }

    public function indexWebView()
    {
        if (empty(config('database.connections.dynamic.database'))) {
            return redirect('/home');
        }
        $webView = true;
        return view('page.barang.index', compact('webView'));
    }

    // DataTable
    public function getDataTable(Request $request)
    {
$barang = Barang::select([
    'id_barang', 
    'kode_barang', 
    'nama_barang', 
    'seri', 
    'stok_awal', 
    'stok_akhir', 
    'tanggal_input',
    'STATUS_BARANG'
])->where('STATUS_BARANG', '!=', '2');

        return DataTables::of($barang)
            ->addIndexColumn()
            ->editColumn('stok_awal', fn($row) => number_format($row->stok_awal ?? 0))
            ->editColumn('stok_akhir', fn($row) => number_format($row->stok_akhir ?? 0))
            ->editColumn('tanggal_input', fn($row) => $row->tanggal_input ? \Carbon\Carbon::parse($row->tanggal_input)->format('d/m/Y') : '-')
            ->make(true);
    }

    public function getData()
    {
        $barang = Barang::select('id_barang', 'kode_barang', 'nama_barang', 'seri')
            ->whereNotIn('STATUS_BARANG', ['0', '2'])
            ->get();

        return response()->json($barang);
    }

    public function export_excel()
    {
        return Excel::download(new ExportBarang, 'barang.xlsx');
    }

    public function store(Request $request)
    {
        $id_toko = session()->get('id_toko');

        $request->validate([
            'kode_barang' => 'required|unique:barang,kode_barang,NULL,id_barang|max:255',
            'nama_barang' => 'required|string|max:255',
            'seri'        => 'nullable|string',
            'stok_awal'   => 'nullable|integer|min:0',
          
        ]);


        $barang = Barang::create([
            'kode_barang'   => $request->kode_barang,
            'nama_barang'   => $request->nama_barang,
            'seri'          => $request->seri,
            'stok_awal'     => $request->stok_awal ?? 0,
            'stok_akhir'    => $request->stok_awal ?? 0,     // awal = akhir saat create
            'tanggal_input' =>  now()->toDateString(),
            'STATUS_BARANG' => $request->STATUS_BARANG ?? '1',
          
        ]);

        return response()->json([
            'message' => 'Barang berhasil ditambahkan',
            'data'    => $barang
        ]);
    }

    public function getBarangDetail($id)
    {
        $barang = Barang::find($id);
        if (!$barang) {
            return response()->json(['message' => 'Barang tidak ditemukan'], 404);
        }
        return response()->json($barang);
    }

    public function update(Request $request, string $id)
    {
        $id_toko = session()->get('id_toko');

        $barang = Barang::where('id_barang', $id)
                        ->first();

        if (!$barang) {
            return response()->json(['message' => 'Barang tidak ditemukan'], 404);
        }

        $request->validate([
            'kode_barang' => 'required|unique:barang,kode_barang,' . $id . ',id_barang',
            'nama_barang' => 'required|string|max:255',
            'seri'        => 'nullable|string',
            'stok_awal'   => 'nullable|integer|min:0',
          
        ]);

        $barang->update([
            'kode_barang'   => $request->kode_barang,
            'nama_barang'   => $request->nama_barang,
            'seri'          => $request->seri,
            'stok_awal'     => $request->stok_awal ?? $barang->stok_awal,
            'tanggal_input' =>  now()->toDateString(),
            'STATUS_BARANG' => $request->STATUS_BARANG ?? $barang->STATUS_BARANG,
        ]);

        // Optional: update stok_akhir jika diperlukan
        // $barang->stok_akhir = ... logic mutasi stok

        return response()->json(['message' => 'Barang berhasil diperbarui']);
    }

    public function destroy(string $id)
    {
        try {
            $barang = Barang::findOrFail($id);
            $barang->update(['STATUS_BARANG' => '2']);

            return response()->json(['message' => 'Barang berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus barang'], 500);
        }
    }
}