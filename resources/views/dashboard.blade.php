<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold">Halo, {{ Auth::user()->name }}!</h3>
                    <p class="mt-1">
                        Status Akun: 
                        <span class="px-2 py-1 text-xs font-semibold rounded bg-blue-100 text-blue-800 uppercase">
                            {{ Auth::user()->role }}
                        </span>
                    </p>

                    <div class="mt-4 p-4 border rounded-lg bg-gray-50">
                        @if(Auth::user()->role === 'guru')
                            <p class="text-green-700 font-medium">
                                ✅ Mode Guru/Pengelola Studio: Anda dapat menyetujui peminjaman, mencatat kondisi barang, dan memonitor studio.
                            </p>
                            <div class="mt-4">
                                <a href="{{ route('kondisi.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs rounded-md uppercase tracking-widest shadow-sm">
                                    📋 Buka Pencatatan Kondisi Barang
                                </a>
                            </div>
                        @else
                            <p class="text-indigo-700 font-medium">
                                🎒 Mode Siswa: Anda dapat melihat daftar alat dan mengajukan peminjaman studio.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
