@extends('master')

@section('content')
<div class="max-w-6xl mx-auto px-6 pt-24 pb-12">
    <h1 class="text-3xl font-bold mb-6">Recycle Bin — Produk Terhapus</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-6">{{ session('success') }}</div>
    @endif

    <div class="mb-6">
        <a href="{{ route('products.index') }}" class="bg-white text-black px-4 py-2 rounded">Kembali ke Dashboard Produk</a>
    </div>

    <table class="min-w-full bg-gray-900 text-white rounded-xl overflow-hidden">
        <thead>
            <tr class="bg-gray-800 text-left">
                <th class="py-3 px-4">#</th>
                <th class="py-3 px-4">Nama</th>
                <th class="py-3 px-4">Kategori</th>
                <th class="py-3 px-4">Dihapus Pada</th>
                <th class="py-3 px-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($trashedProducts as $i => $product)
                <tr class="border-b border-gray-700">
                    <td class="py-3 px-4">{{ $i + 1 }}</td>
                    <td class="py-3 px-4">{{ $product->name }}</td>
                    <td class="py-3 px-4">{{ $product->category->name ?? '-' }}</td>
                    <td class="py-3 px-4">{{ $product->deleted_at->format('Y-m-d H:i') }}</td>
                    <td class="py-3 px-4 text-center space-x-2">
                        <form action="{{ route('products.restore', $product->id) }}" method="POST" class="inline">
                            @csrf
                            <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">Restore</button>
                        </form>

                        <form action="{{ route('products.forceDelete', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus permanen? Tindakan ini tidak dapat di-undo.');">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">Delete Permanen</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-6 px-4 text-center text-gray-400">Belum ada produk terhapus.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
