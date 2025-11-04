@extends('master')

@section('content')
<div class="max-w-3xl mx-auto px-6 pt-24 pb-12">
    <h1 class="text-3xl font-bold mb-8 text-center">Tambah Produk Baru</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-6 text-center">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-600 text-white p-3 rounded mb-6">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/admin/products" method="POST" enctype="multipart/form-data" class="space-y-6 bg-gray-900 p-6 rounded-xl">
        @csrf
        <div>
            <label class="block font-semibold mb-2">Nama Produk</label>
            <input type="text" name="name" class="w-full p-2 rounded bg-gray-800 text-white focus:outline-none" required>
        </div>

    <select name="category_id" class="w-full p-2 rounded bg-gray-800 text-white" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>


        <div>
            <label class="block font-semibold mb-2">Harga</label>
            <input type="text" name="price" class="w-full p-2 rounded bg-gray-800 text-white focus:outline-none" required>
        </div>

        <div>
            <label class="block font-semibold mb-2">Gambar Produk</label>
            <input type="file" name="image" class="w-full bg-gray-800 text-gray-200 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-white file:text-black hover:file:bg-gray-300">
        </div>

        <button type="submit" class="w-full bg-white text-black py-2 rounded-lg font-semibold hover:bg-gray-200 transition">
            Simpan Produk
        </button>
    </form>
</div>
@endsection
