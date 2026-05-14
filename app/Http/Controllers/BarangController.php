<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    // READ
    public function index()
    {
        $barang = Barang::all();
        return view('dashboard', compact('barang'));
    }

    // CREATE
    public function store(Request $request)
    {
        Barang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'jumlah' => $request->jumlah
        ]);

        return redirect()->back();
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'jumlah' => $request->jumlah
        ]);
        return redirect()->back();
    }

    // DELETE
    public function destroy($id)
    {
        Barang::findOrFail($id)->delete();
        return redirect()->back();
    }
}