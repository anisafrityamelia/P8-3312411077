<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F9F5E8] font-sans">
    <div class="max-w-7xl mx-auto mt-16 overflow-x-auto">
        <div><h1 class="text-3xl font-bold text-center text-[#5A0717] mb-8">INPUT PRODUK</h1></div>
        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-black px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('produk.simpan') }}">
            @csrf
            <table class="table">
                <tr>
                    <td class="font-bold text-[#5A0717]">Nama:</td>
                    <td><input type="text" id="nama" name="nama" 
                        class="w-full border border-gray-400 rounded px-3 py-1 mb-1 focus:outline-none focus:ring focus:border-blue-100"></td>
                </tr>
                <tr>
                    <td class="font-bold text-[#5A0717]">Deskripsi:</td>
                    <td><textarea id="deskripsi" name="deskripsi" 
                        class="w-full border border-gray-400 rounded px-3 py-1 focus:outline-none focus:ring focus:border-blue-100"></textarea></td>
                </tr>
                <tr>
                    <td class="font-bold text-[#5A0717]">Harga:</td>
                    <td><input type="number" id="harga" name="harga" 
                        class="w-full border border-gray-400 rounded px-3 py-1 focus:outline-none focus:ring focus:border-blue-100"></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1.5 px-4 rounded mt-4 mb-6">Simpan</button>
        </form>
        <h1 class="text-3xl font-bold text-center text-[#5A0717] mb-8">LIST PRODUK</h1>
        <table class="min-w-full border border-gray-400 bg-white mb-16">
            <thead class="bg-[#5A0717]">
                <tr>
                    <th class="px-6 py-4 text-center text-sm font-semibold text-[#F9F5E8]">No</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold text-[#F9F5E8]">Nama Produk</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold text-[#F9F5E8]">Deskripsi Produk</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold text-[#F9F5E8]">Harga Produk</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold text-[#F9F5E8]">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($nama as $index => $item)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-sm text-gray-800">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm text-gray-800">{{ $item }}</td>
                    <td class="px-6 py-4 text-sm text-gray-800">{{ $desc[$index] }}</td>
                    <td class="px-6 py-4 text-sm text-gray-800">Rp {{ $harga[$index] }}</td>
                    <td class="text-center px-4">
                        <div class="flex justify-center gap-2">
                            <button type="button"
                                onclick="openModal({{ $id[$index] }}, '{{ $item }}', '{{ $desc[$index] }}', {{ $harga[$index] }})"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded transition duration-200">Edit</button>
                            <form action="{{ route('produk.delete', $id[$index]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure want to delete {{ $item }}?')"
                                class="bg-red-600 hover:bg-red-700 text-white py-1 px-2 rounded transition duration-200">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                <h2 class="text-lg font-bold mb-4 text-[#5A0717]">Edit Produk</h2>
                <form method="POST" id="editForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId">
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-[#5A0717] mb-1">Nama Produk</label>
                        <input type="text" id="editNama" name="nama" class="w-full border border-gray-400 rounded px-3 py-1">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-[#5A0717] mb-1">Deskripsi</label>
                        <textarea id="editDeskripsi" name="deskripsi" class="w-full border border-gray-400 rounded px-3 py-1"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-[#5A0717] mb-1">Harga</label>
                        <input type="number" id="editHarga" name="harga" class="w-full border border-gray-400 rounded px-3 py-1">
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-1 rounded">Batal</button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 rounded">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function openModal(id, nama, deskripsi, harga) {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editId').value = id;
            document.getElementById('editNama').value = nama;
            document.getElementById('editDeskripsi').value = deskripsi;
            document.getElementById('editHarga').value = harga;
            document.getElementById('editForm').action = `/listproduk/${id}`;
        }
        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</body>
</html>