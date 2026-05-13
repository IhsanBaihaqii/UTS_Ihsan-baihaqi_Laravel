<div>

    <!-- HEADER -->
    <header class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                CRUD Barang
            </h1>

            <p class="text-gray-500">
                Laravel CRUD Barang
            </p>
        </div>

        <div class="text-right">

            <h2 class="text-xl font-semibold text-gray-800">
                {{ session('username') }}
            </h2>

            <p class="text-gray-500 mb-2">
                {{ session('role') }}
            </p>

            <a
                href="{{ route('logout.index') }}"
                class="inline-block bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded"
            >
                Logout
            </a>

        </div>

    </header>

    <!-- FORM -->
    <div class="bg-white rounded shadow p-6 mb-6">

        <h2 class="text-xl font-bold mb-4">
            Tambah Barang
        </h2>

        <form
            action="{{ route('barang.store') }}"
            method="POST"
        >

            @csrf

            <div class="grid grid-cols-2 gap-4">

                <div>

                    <label class="block mb-2 text-gray-700">
                        Kode Barang
                    </label>

                    <input
                        type="text"
                        name="kode_barang"
                        placeholder="Masukkan kode barang"
                        class="w-full border border-gray-300 rounded px-4 py-2"
                        required
                    >

                </div>

                <div>

                    <label class="block mb-2 text-gray-700">
                        Nama Barang
                    </label>

                    <input
                        type="text"
                        name="nama_barang"
                        placeholder="Masukkan nama barang"
                        class="w-full border border-gray-300 rounded px-4 py-2"
                        required
                    >

                </div>

                <div>

                    <label class="block mb-2 text-gray-700">
                        Harga Barang
                    </label>

                    <input
                        type="number"
                        name="harga_barang"
                        placeholder="Masukkan harga"
                        class="w-full border border-gray-300 rounded px-4 py-2"
                        required
                    >

                </div>

                <div>

                    <label class="block mb-2 text-gray-700">
                        Jumlah
                    </label>

                    <input
                        type="number"
                        name="jumlah"
                        placeholder="Masukkan jumlah"
                        class="w-full border border-gray-300 rounded px-4 py-2"
                        required
                    >

                </div>

            </div>

            <button
                type="submit"
                class="mt-6 bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded"
            >
                Tambah Barang
            </button>

        </form>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded shadow p-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-4">
            Data Barang
        </h2>

        @if ($barang->count())

            <div class="overflow-x-auto">

                <table class="w-full border border-gray-300">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="border p-3">
                                No
                            </th>

                            <th class="border p-3">
                                Kode Barang
                            </th>

                            <th class="border p-3">
                                Nama Barang
                            </th>

                            <th class="border p-3">
                                Harga
                            </th>

                            <th class="border p-3">
                                Jumlah
                            </th>

                            <th class="border p-3 text-center">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($barang as $item)

                            <tr>

                                <td class="border p-3 text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="border p-3">
                                    {{ $item->kode_barang }}
                                </td>

                                <td class="border p-3">
                                    {{ $item->nama_barang }}
                                </td>

                                <td class="border p-3 text-right">
                                    Rp {{ number_format($item->harga_barang, 0, ',', '.') }}
                                </td>

                                <td class="border p-3 text-center">
                                    {{ $item->jumlah }}
                                </td>

                                <td class="border p-3">

                                    <div class="flex gap-2 justify-center">

                                        <!-- EDIT -->
                                        <button
                                            onclick="openModal(
                                                '{{ $item->id }}',
                                                '{{ $item->kode_barang }}',
                                                '{{ $item->nama_barang }}',
                                                '{{ $item->harga_barang }}',
                                                '{{ $item->jumlah }}'
                                            )"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded"
                                        >
                                            Edit
                                        </button>

                                        <!-- DELETE -->
                                        <form
                                            action="{{ route('barang.destroy', $item->id) }}"
                                            method="POST"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded"
                                            >
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="bg-yellow-100 text-yellow-700 p-4 rounded">

                Belum ada data barang

            </div>

        @endif

    </div>

    <!-- MODAL EDIT -->
    <div
        id="editModal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center"
    >

        <div class="bg-white rounded p-6 w-full max-w-lg">

            <h2 class="text-2xl font-bold mb-4">
                Edit Barang
            </h2>

            <form
                id="editForm"
                method="POST"
            >

                @csrf
                @method('PUT')

                <div class="mb-4">

                    <label class="block mb-2">
                        Kode Barang
                    </label>

                    <input
                        type="text"
                        name="kode_barang"
                        id="edit_kode_barang"
                        class="w-full border border-gray-300 rounded px-4 py-2"
                    >

                </div>

                <div class="mb-4">

                    <label class="block mb-2">
                        Nama Barang
                    </label>

                    <input
                        type="text"
                        name="nama_barang"
                        id="edit_nama_barang"
                        class="w-full border border-gray-300 rounded px-4 py-2"
                    >

                </div>

                <div class="mb-4">

                    <label class="block mb-2">
                        Harga
                    </label>

                    <input
                        type="number"
                        name="harga_barang"
                        id="edit_harga_barang"
                        class="w-full border border-gray-300 rounded px-4 py-2"
                    >

                </div>

                <div class="mb-6">

                    <label class="block mb-2">
                        Jumlah
                    </label>

                    <input
                        type="number"
                        name="jumlah"
                        id="edit_jumlah"
                        class="w-full border border-gray-300 rounded px-4 py-2"
                    >

                </div>

                <div class="flex justify-end gap-2">

                    <button
                        type="button"
                        onclick="closeModal()"
                        class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
                    >
                        Update
                    </button>

                </div>

            </form>

        </div>

    </div>

    <script>

        function openModal(
            id,
            kode,
            nama,
            harga,
            jumlah
        ) {

            document
                .getElementById('editModal')
                .classList
                .remove('hidden');

            document
                .getElementById('editModal')
                .classList
                .add('flex');

            document
                .getElementById('editForm')
                .action =
                    `/dashboard/barang/update/${id}`;

            document
                .getElementById('edit_kode_barang')
                .value = kode;

            document
                .getElementById('edit_nama_barang')
                .value = nama;

            document
                .getElementById('edit_harga_barang')
                .value = harga;

            document
                .getElementById('edit_jumlah')
                .value = jumlah;
        }

        function closeModal() {

            document
                .getElementById('editModal')
                .classList
                .remove('flex');

            document
                .getElementById('editModal')
                .classList
                .add('hidden');
        }

    </script>

</div>