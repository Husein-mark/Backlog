<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pencatatan Kondisi Barang Studio (Guru)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Notifikasi Sukses --}}
            @if(session('success'))
                <div class="p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Daftar Peminjaman & Kondisi Fisik Alat</h3>
                    <p class="text-sm text-gray-500">Catat kondisi barang saat diserahkan dan saat dikembalikan oleh siswa.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left font-medium text-gray-500">Peminjam</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500">Barang Studio</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500">Tenggat Kembali</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500">Kondisi Awal (Pinjam)</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-500">Kondisi Akhir & Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($peminjamans as $item)
                                <tr>
                                    {{-- Info Peminjam --}}
                                    <td class="px-4 py-3 font-semibold text-gray-900">
                                        {{ $item->user->name }}
                                        <div class="text-xs text-gray-400 font-normal">{{ $item->user->email }}</div>
                                    </td>

                                    {{-- Info Barang --}}
                                    <td class="px-4 py-3 text-gray-800">
                                        <span class="font-medium">{{ $item->barang->nama_barang }}</span>
                                        <span class="block text-xs text-gray-500">Kode: {{ $item->barang->kode_barang }}</span>
                                    </td>

                                    {{-- Tanggal --}}
                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $item->tanggal_kembali_rencana }}
                                        <span class="block text-xs font-semibold {{ $item->status === 'dipinjam' ? 'text-amber-600' : 'text-emerald-600' }}">
                                            Status: {{ ucfirst($item->status) }}
                                        </span>
                                    </td>

                                    {{-- Kondisi Awal --}}
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs font-semibold rounded bg-blue-50 text-blue-700 border border-blue-200">
                                            {{ $item->kondisi_awal ?? 'Baik' }}
                                        </span>
                                    </td>

                                    {{-- Form Catat Kondisi Akhir --}}
                                    <td class="px-4 py-3">
                                        @if($item->status === 'dipinjam')
                                            <form action="{{ route('kondisi.update', $item->id) }}" method="POST" class="space-y-2">
                                                @csrf
                                                @method('PUT')
                                                <select name="kondisi_akhir" required class="text-xs rounded border-gray-300 w-full focus:ring-blue-500">
                                                    <option value="">-- Pilih Kondisi Kembali --</option>
                                                    <option value="Baik">Baik (Normal/Lengkap)</option>
                                                    <option value="Rusak Ringan">Rusak Ringan (Lecet/Gores)</option>
                                                    <option value="Rusak Berat">Rusak Berat (Mati/Patah)</option>
                                                    <option value="Hilang">Hilang/Tidak Dikembalikan</option>
                                                </select>

                                                <input type="text" name="catatan_kondisi" placeholder="Catatan kerusakan (opsional)" class="text-xs rounded border-gray-300 w-full focus:ring-blue-500">

                                                <button type="submit" class="w-full px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded text-xs font-semibold transition">
                                                    Catat Pengembalian
                                                </button>
                                            </form>
                                        @else
                                            <div class="text-xs">
                                                <span class="font-semibold {{ in_array($item->kondisi_akhir, ['Rusak Ringan', 'Rusak Berat', 'Hilang']) ? 'text-red-600' : 'text-green-600' }}">
                                                    Kondisi: {{ $item->kondisi_akhir }}
                                                </span>
                                                @if($item->catatan_kondisi)
                                                    <p class="text-gray-500 italic mt-0.5">"{{ $item->catatan_kondisi }}"</p>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                        Belum ada data peminjaman barang.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>