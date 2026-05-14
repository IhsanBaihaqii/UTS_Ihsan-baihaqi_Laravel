<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Invoice Automation</title>

    <!-- Tailwind CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
        rel="stylesheet"
    >

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    >

</head>

<body class="bg-gray-100">

    <!-- SIDEBAR -->
    <div class="flex h-screen">

        <div class="w-64 bg-gray-800 text-white flex flex-col justify-between fixed h-screen">

            <div class="p-4">

                <h1 class="text-2xl font-bold mb-6">
                    IHSAN BAIHAQI
                </h1>

                <nav>

                    <a
                        href="{{ url('/dashboard') }}"
                        class="block py-2 px-4 rounded hover:bg-gray-700 transition duration-200
                        {{ request()->is('dashboard') ? 'bg-gray-700' : '' }}"
                    >
                        Home
                    </a>

                    <a
                        href="{{ url('/dashboard/barang') }}"
                        class="block py-2 px-4 rounded hover:bg-gray-700 transition duration-200
                        {{ request()->is('dashboard/barang') ? 'bg-gray-700' : '' }}"
                    >
                        Barang
                    </a>

                    <a
                        href="{{ url('/dashboard/users') }}"
                        class="block py-2 px-4 rounded hover:bg-gray-700 transition duration-200
                        {{ request()->is('dashboard/pelanggan') ? 'bg-gray-700' : '' }}"
                    >
                        User
                    </a>

                    <a
                        href="{{ url('/dashboard/transaksi') }}"
                        class="block py-2 px-4 rounded hover:bg-gray-700 transition duration-200
                        {{ request()->is('dashboard/transaksi') ? 'bg-gray-700' : '' }}"
                    >
                        Transaksi
                    </a>

                    <a
                        href="#"
                        class="block py-2 px-4 rounded hover:bg-gray-700 transition duration-200"
                    >
                        Settings
                    </a>

                </nav>

            </div>

            <div class="p-4">

                <a
                    href="{{ route('logout.index') }}"
                    class="block text-center w-full bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded transition duration-200"
                >
                    Logout
                </a>

            </div>

        </div>

        <!-- MAIN CONTENT -->
        <div class="flex-grow p-6 bg-gray-100 pl-64">

            @if (request()->is('dashboard/barang'))

                @include('dashboard.barang')

            @elseif (request()->is('dashboard/users'))

                @include('dashboard.user')

            @elseif (request()->is('dashboard/transaksi'))

                @include('dashboard.transaksi')

            @else

                <div class="bg-white p-6 rounded shadow">

                    <h2 class="text-2xl font-bold mb-2">
                        NAMA: IHSAN BAIHAQI
                    </h2>
                    <h3 class="text-lg font-semibold mb-4">
                        NIM: 24012217
                    </h3>
                    <h3 class="text-lg font-semibold mb-4">
                        KELAS: 24M11
                    </h3>

                    <p class="text-gray-600">
                        Selamat datang di dashboard aplikasi saya.
                    </p>

                </div>

            @endif

        </div>

    </div>

</body>

</html>