@extends('master')

@section('content')
<div class="max-w-3xl mx-auto px-6 pt-24 pb-12">
    <h1 class="text-3xl font-bold mb-8 text-center">Edit Produk</h1>

    @if ($errors->any())
        <div class="bg-red-600 text-white p-3 rounded mb-6">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/admin/products/{{ $product->id }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-gray-900 p-6 rounded-xl">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold mb-2">Nama Produk</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full p-2 rounded bg-gray-800 text-white focus:outline-none" required>
        </div>

        <div>
            <label class="block font-semibold mb-2">Kategori</label>
            <select name="category" class="w-full p-2 rounded bg-gray-800 text-white focus:outline-none" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="sneakers" {{ $product->category == 'sneakers' ? 'selected' : '' }}>Sneakers</option>
                <option value="basket" {{ $product->category == 'basket' ? 'selected' : '' }}>Basket</option>
                <option value="running" {{ $product->category == 'running' ? 'selected' : '' }}>Running</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-2">Harga</label>
            <input type="text" name="price" value="{{ old('price', $product->price) }}" class="w-full p-2 rounded bg-gray-800 text-white focus:outline-none" required>
        </div>

        <div>
            <label class="block font-semibold mb-2">Gambar Sekarang</label>
            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded mb-3">
            <label class="block font-semibold mb-2">Ganti Gambar (Opsional)</label>
            <input type="file" name="image" class="w-full bg-gray-800 text-gray-200 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-white file:text-black hover:file:bg-gray-300">
        </div>

        <button type="submit" class="w-full bg-white text-black py-2 rounded-lg font-semibold hover:bg-gray-200 transition">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
