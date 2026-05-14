<div>

    <!-- HEADER -->
    <header class="flex justify-between items-center mb-6">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                CRUD User
            </h1>

            <p class="text-gray-500">
                Laravel CRUD User
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
            Tambah User
        </h2>

        <form
            action="{{ route('users.store') }}"
            method="POST"
        >

            @csrf

            <div class="grid grid-cols-2 gap-4">

                <div>

                    <label class="block mb-2 text-gray-700">
                        Nama
                    </label>

                    <input
                        type="text"
                        name="name"
                        placeholder="Masukkan nama"
                        class="w-full border border-gray-300 rounded px-4 py-2"
                        required
                    >

                </div>

                <div>

                    <label class="block mb-2 text-gray-700">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Masukkan email"
                        class="w-full border border-gray-300 rounded px-4 py-2"
                        required
                    >

                </div>

                <div>

                    <label class="block mb-2 text-gray-700">
                        Role
                    </label>

                    <select
                        name="role"
                        class="w-full border border-gray-300 rounded px-4 py-2"
                        required
                    >

                        <option value="">
                            -- Pilih Role --
                        </option>

                        <option value="admin">
                            Admin
                        </option>

                        <option value="user">
                            User
                        </option>

                    </select>

                </div>

            </div>

            <button
                type="submit"
                class="mt-6 bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded"
            >
                Tambah User
            </button>

        </form>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded shadow p-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-4">
            Data User
        </h2>

        @if ($users->count())

            <div class="overflow-x-auto">

                <table class="w-full border border-gray-300">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="border p-3">
                                No
                            </th>

                            <th class="border p-3">
                                Nama
                            </th>

                            <th class="border p-3">
                                Email
                            </th>

                            <th class="border p-3">
                                Role
                            </th>

                            <th class="border p-3 text-center">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($users as $item)

                            <tr>

                                <td class="border p-3 text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="border p-3">
                                    {{ $item->name }}
                                </td>

                                <td class="border p-3">
                                    {{ $item->email }}
                                </td>

                                <td class="border p-3 text-center">

                                    @if ($item->role == 'admin')

                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded text-sm">
                                            Admin
                                        </span>

                                    @else

                                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded text-sm">
                                            User
                                        </span>

                                    @endif

                                </td>

                                <td class="border p-3">

                                    <div class="flex gap-2 justify-center">

                                        <!-- EDIT -->
                                        <button
                                            onclick="openModal(
                                                '{{ $item->id }}',
                                                '{{ $item->name }}',
                                                '{{ $item->email }}',
                                                '{{ $item->role }}'
                                            )"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded"
                                        >
                                            Edit
                                        </button>

                                        <!-- DELETE -->
                                        <form
                                            action="{{ route('users.destroy', $item->id) }}"
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

                Belum ada data user

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
                Edit User
            </h2>

            <form
                id="editForm"
                method="POST"
            >

                @csrf
                @method('PUT')

                <div class="mb-4">

                    <label class="block mb-2">
                        Nama
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="edit_name"
                        class="w-full border border-gray-300 rounded px-4 py-2"
                    >

                </div>

                <div class="mb-4">

                    <label class="block mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        id="edit_email"
                        class="w-full border border-gray-300 rounded px-4 py-2"
                    >

                </div>

                <div class="mb-6">

                    <label class="block mb-2">
                        Role
                    </label>

                    <select
                        name="role"
                        id="edit_role"
                        class="w-full border border-gray-300 rounded px-4 py-2"
                    >

                        <option value="admin">
                            Admin
                        </option>

                        <option value="user">
                            User
                        </option>

                    </select>
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
            name,
            email,
            role
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
                    `/dashboard/users/update/${id}`;
            document
                .getElementById('edit_name')
                .value = name;
            document
                .getElementById('edit_email')
                .value = email;
            document
                .getElementById('edit_role')
                .value = role;
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