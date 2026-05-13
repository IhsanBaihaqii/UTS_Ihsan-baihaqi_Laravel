<div>

    <!-- HEADER -->
    <header class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Polgan Mart
            </h1>

            <p class="text-gray-500">
                Sistem penjualan sederhana
            </p>
        </div>

        <div class="text-right">

            <h2 class="text-xl font-semibold text-gray-800">
                Selamat datang,
                {{ session('username') }}
            </h2>

            <p class="text-gray-500 mb-2">
                Role: {{ session('role') }}
            </p>

            <a
                href="{{ route('logout.index') }}"
                class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition duration-200"
            >
                Logout
            </a>

        </div>

    </header>

    <!-- FORM -->
    <div class="bg-white rounded shadow p-6 mb-6">

        <form
            action="{{ route('dashboard.barang.aksi') }}"
            method="post"
        >

            @csrf

            <div class="mb-4">

                <label
                    for="list_barang"
                    class="block mb-2 font-medium text-gray-700"
                >
                    Kode Barang
                </label>

                <select
                    name="list_barang"
                    id="list_barang"
                    class="w-full border border-gray-300 rounded px-4 py-2"
                >

                    <option disabled selected>
                        -- Pilih Kode Barang --
                    </option>

                    @foreach ($list_barang as $kode => $item)

                        <option value="{{ $kode }}">
                            {{ $kode }} | {{ $item['nama'] }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-4">

                <label
                    for="kode_barang"
                    class="block mb-2 font-medium text-gray-700"
                >
                    Kode Barang
                </label>

                <input
                    type="text"
                    name="kode_barang"
                    id="kode_barang"
                    placeholder="Masukkan Kode Barang"
                    required
                    class="w-full border border-gray-300 rounded px-4 py-2"
                >

            </div>

            <div class="mb-4">

                <label
                    for="nama_barang"
                    class="block mb-2 font-medium text-gray-700"
                >
                    Nama Barang
                </label>

                <input
                    type="text"
                    name="nama_barang"
                    id="nama_barang"
                    placeholder="Masukkan Nama Barang"
                    required
                    class="w-full border border-gray-300 rounded px-4 py-2"
                >

            </div>

            <div class="mb-4">

                <label
                    for="harga_barang"
                    class="block mb-2 font-medium text-gray-700"
                >
                    Harga
                </label>

                <input
                    type="number"
                    name="harga_barang"
                    id="harga_barang"
                    placeholder="Masukkan Harga Barang"
                    required
                    class="w-full border border-gray-300 rounded px-4 py-2"
                >

            </div>

            <div class="mb-6">

                <label
                    for="jumlah"
                    class="block mb-2 font-medium text-gray-700"
                >
                    Jumlah
                </label>

                <input
                    type="number"
                    name="jumlah"
                    id="jumlah"
                    placeholder="Masukkan Jumlah"
                    required
                    class="w-full border border-gray-300 rounded px-4 py-2"
                >

            </div>

            <div class="flex gap-4">

                <button
                    type="submit"
                    value="add"
                    name="add"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded transition duration-200"
                >
                    Tambah
                </button>

                <button
                    type="reset"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded transition duration-200"
                >
                    Batal
                </button>

            </div>

        </form>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded shadow p-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-2">
            Daftar Barang
        </h2>

        <p class="text-gray-500 mb-6">
            Menampilkan barang yang di input
        </p>

        @php
            $data_barang = session('data_barang') ?? [];
            $grandtotal = 0;
        @endphp

        @if (session('data_barang'))

            <div class="overflow-x-auto">

                <table class="w-full border border-gray-300">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="border p-3 text-left">
                                Kode Barang
                            </th>

                            <th class="border p-3 text-left">
                                Nama Barang
                            </th>

                            <th class="border p-3 text-left">
                                Harga Barang
                            </th>

                            <th class="border p-3 text-left">
                                Jumlah
                            </th>

                            <th class="border p-3 text-left">
                                Total
                            </th>

                            <th class="border p-3 text-center">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($data_barang as $kode => $item)

                            @php

                                $total_harga =
                                    $item['harga'] * $item['jumlah'];

                                $grandtotal += $total_harga;

                                if ($grandtotal == 0) {

                                    $d = '0%';
                                    $diskon = 0;

                                } elseif ($grandtotal < 50000) {

                                    $d = '5%';
                                    $diskon = 0.05 * $grandtotal;

                                } elseif ($grandtotal <= 100000) {

                                    $d = '10%';
                                    $diskon = 0.10 * $grandtotal;

                                } else {

                                    $d = '15%';
                                    $diskon = 0.15 * $grandtotal;
                                }

                                $totalbayar = $grandtotal - $diskon;

                            @endphp

                            <tr>

                                <td class="border p-3">
                                    {{ $kode }}
                                </td>

                                <td class="border p-3">
                                    {{ $item['nama'] }}
                                </td>

                                <td class="border p-3 text-right">
                                    Rp {{ number_format($item['harga'], 0, ',', '.') }}
                                </td>

                                <td class="border p-3 text-center">
                                    {{ $item['jumlah'] }}
                                </td>

                                <td class="border p-3 text-right">
                                    Rp {{ number_format($total_harga, 0, ',', '.') }}
                                </td>

                                <td class="border p-3 text-center">

                                    <form
                                        method="post"
                                        action="{{ route('dashboard.barang.aksi') }}"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            name="delete"
                                            value="{{ $kode }}"
                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition duration-200"
                                        >
                                            Hapus
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                        <tr>

                            <td
                                colspan="4"
                                class="border p-3 text-right font-bold"
                            >
                                Total Belanja
                            </td>

                            <td class="border p-3 text-right font-bold">
                                Rp {{ number_format($grandtotal, 0, ',', '.') }}
                            </td>

                            <td class="border"></td>

                        </tr>

                        <tr>

                            <td
                                colspan="4"
                                class="border p-3 text-right font-bold"
                            >
                                Diskon {{ $d }}
                            </td>

                            <td class="border p-3 text-right font-bold">
                                Rp {{ number_format($diskon, 0, ',', '.') }}
                            </td>

                            <td class="border"></td>

                        </tr>

                        <tr>

                            <td
                                colspan="4"
                                class="border p-3 text-right font-bold"
                            >
                                Total Bayar
                            </td>

                            <td class="border p-3 text-right font-bold">
                                Rp {{ number_format($totalbayar, 0, ',', '.') }}
                            </td>

                            <td class="border"></td>

                        </tr>

                    </tbody>

                </table>

            </div>

            <form
                action="{{ route('dashboard.reset') }}"
                method="get"
                class="mt-6"
            >

                <button
                    type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded transition duration-200"
                >
                    Reset Keranjang
                </button>

            </form>

        @else

            <div
                class="bg-yellow-100 border border-yellow-300 text-yellow-700 px-4 py-3 rounded"
            >
                Belum ada daftar barang
            </div>

        @endif

    </div>

    <script>

        const selectBarang = document.getElementById("list_barang");

        const inputKodeBarang = document.getElementById("kode_barang");

        const inputNamaBarang = document.getElementById("nama_barang");

        const inputHargaBarang = document.getElementById("harga_barang");

        const inputJumlahBarang = document.getElementById("jumlah");

        let daftarBarang = @json($list_barang);

        selectBarang.addEventListener("change", function () {

            let barang = daftarBarang[selectBarang.value];

            if (barang) {

                inputKodeBarang.value = selectBarang.value;

                inputNamaBarang.value = barang.nama;

                inputHargaBarang.value = barang.harga;
            }

        });

    </script>

</div>