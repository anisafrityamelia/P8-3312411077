<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F9F5E8] font-sans">
    <div class="max-w-7xl mx-auto mt-16 px-4 overflow-x-auto">
        <h1 class="text-3xl font-bold text-center text-[#5A0717] mb-8">LIST PRODUK</h1>
        <table class="min-w-full border border-gray-400 bg-white mb-16">
            <thead class="bg-[#5A0717]">
                <tr>
                    <th class="px-6 py-4 text-center text-sm font-semibold text-[#F9F5E8]">No</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold text-[#F9F5E8]">Nama Produk</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold text-[#F9F5E8]">Deskripsi Produk</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold text-[#F9F5E8]">Harga Produk</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($nama as $index => $item)
                <tr class="hover:bg-gray-50 transition-colors text-center">
                    <td class="px-6 py-4 text-sm text-gray-800">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm text-gray-800">{{ $item }}</td>
                    <td class="px-6 py-4 text-sm text-gray-800">{{ $desc[$index] }}</td>
                    <td class="px-6 py-4 text-sm text-gray-800">Rp {{ $harga[$index] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
 