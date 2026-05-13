<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Dashboard utama
    public function index()
    {
        // Cek login
        if (!session('username')) {
            return redirect()
                ->route('login.index')
                ->with('error', 'Silahkan login terlebih dahulu');
        }

        // List barang
        $list_barang = [

            "BRG001" => [
                "nama" => "Handuk",
                "harga" => 4500,
            ],

            "BRG002" => [
                "nama" => "Lampu",
                "harga" => 3000,
            ],

            "BRG003" => [
                "nama" => "Penggaris",
                "harga" => 2500,
            ],

            "BRG004" => [
                "nama" => "Pulpen",
                "harga" => 1500,
            ],
        ];

        return view('dashboard', compact('list_barang'));
    }

    // Aksi tambah / hapus barang
    public function aksi(Request $request)
    {

        // Tambah barang
        if ($request->has('add')) {

            $this->tambahBarang($request);

        }

        // Hapus barang
        elseif ($request->has('delete')) {

            $this->hapusBarang($request);

        }

        return redirect()->route('dashboard.index');
    }

    // Tambah barang ke session
    protected function tambahBarang(Request $request)
    {

        $data_barang = session('data_barang', []);

        // Jika barang sudah ada
        if (isset($data_barang[$request->kode_barang])) {

            $data_barang[$request->kode_barang]['jumlah']
                += $request->jumlah;

        }

        // Jika barang belum ada
        else {

            $data_barang[$request->kode_barang] = [

                "nama" => $request->nama_barang,

                "harga" => $request->harga_barang,

                "jumlah" => $request->jumlah
            ];
        }

        session([
            'data_barang' => $data_barang
        ]);
    }

    // Hapus barang
    protected function hapusBarang(Request $request)
    {

        $data_barang = session('data_barang', []);

        unset($data_barang[$request->delete]);

        session([
            'data_barang' => $data_barang
        ]);
    }

    // Reset keranjang
    public function reset()
    {

        session()->forget('data_barang');

        return redirect()->route('dashboard.index');
    }
}