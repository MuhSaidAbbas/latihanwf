@extends('master')

@section('content')
<div class="max-w-6xl mx-auto px-6 pt-24 pb-12">
    <h1 class="text-3xl font-bold mb-8 text-center">Dashboard Admin</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-6 text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="text-right mb-6">
        <a href="/admin/products/create" class="bg-white text-black px-4 py-2 rounded-lg font-semibold hover:bg-gray-200 transition">
            + Tambah Produk
        </a>
    </div>

    <table class="min-w-full bg-gray-900 text-white rounded-xl overflow-hidden">
        <thead>
            <tr class="bg-gray-800 text-left">
                <th class="py-3 px-4">#</th>
                <th class="py-3 px-4">Nama Produk</th>
                <th class="py-3 px-4">Kategori</th>
                <th class="py-3 px-4">Harga</th>
                <th class="py-3 px-4">Gambar</th>
                <th class="py-3 px-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $index => $product)
                <tr class="border-b border-gray-700 hover:bg-gray-800 transition">
                    <td class="py-3 px-4">{{ $index + 1 }}</td>
                    <td class="py-3 px-4">{{ $product->name }}</td>
                    <td class="py-3 px-4 capitalize">{{ $product->category->name ?? '-' }}</td>
                    <td class="py-3 px-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="py-3 px-4">
                        <img src="{{ $product->image }}" alt="Gambar {{ $product->name }}" class="w-20 h-20 object-cover rounded-lg">
                    </td>
                    <td class="py-3 px-4 text-center space-x-2">
                        {{-- Tombol Edit --}}
                        <a href="/admin/products/{{ $product->id }}/edit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg transition">
                            Edit
                        </a>

                        {{-- Tombol Hapus --}}
                        <form action="/admin/products/{{ $product->id }}" method="POST" class="inline"
                            onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg transition">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
