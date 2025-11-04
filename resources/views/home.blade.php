@extends('master')

@section('content')
<div class="max-w-6xl mx-auto px-6 pt-24">
    <h1 class="text-3xl font-bold mb-8 text-center">Koleksi Sepatu Terbaru</h1>

    @foreach(\App\Models\Category::with('products')->get() as $category)
        <h2 class="text-2xl font-semibold mb-4">{{ ucfirst($category->name) }}</h2>
        <div class="grid md:grid-cols-3 gap-6 mb-10">
            @foreach ($category->products as $product)
                <div class="bg-gray-900 p-4 rounded-xl hover:scale-105 transition">
                    <img src="{{ $product->image }}" class="rounded-lg mb-3">
                    <h3 class="font-semibold">{{ $product->name }}</h3>
                    <p class="text-gray-400 text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>
    @endforeach

<section class="py-16 px-6 max-w-6xl mx-auto">
    <h2 class="text-2xl font-semibold mb-6">Semua Produk</h2>
    <div class="grid md:grid-cols-3 gap-6">
        @forelse ($products as $product)
            <div class="bg-gray-900 p-4 rounded-xl hover:scale-105 transition">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="rounded-lg mb-3">
                <h3 class="font-semibold">{{ $product->name }}</h3>
                <p class="text-gray-400 text-sm">
                    {{ $product->category->name ?? 'Tanpa Kategori' }}
                </p>
                <p class="text-gray-400 text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            </div>
        @empty
            <p class="text-gray-400">Belum ada produk.</p>
        @endforelse
    </div>
</section>


    {{-- Sneakers --}}
    <section id="sneakers" class="mb-12">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Sneakers</h2>
            <a href="/sneakers" class="text-sm text-gray-400 hover:text-white">Lihat Semua →</a>
        </div>
        <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-6">
            @foreach ($products->where('category', 'sneakers')->take(2) as $product)
                <div class="bg-gray-900 p-4 rounded-xl hover:scale-105 transition">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="rounded-lg mb-3">
                    <h3 class="font-semibold">{{ $product->name }}</h3>
                    <p class="text-gray-400 text-sm">Rp {{ $product->price }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Basket --}}
    <section id="basket" class="mb-12">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Basket</h2>
            <a href="/basket" class="text-sm text-gray-400 hover:text-white">Lihat Semua →</a>
        </div>
        <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-6">
            @foreach ($products->where('category', 'basket')->take(2) as $product)
                <div class="bg-gray-900 p-4 rounded-xl hover:scale-105 transition">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="rounded-lg mb-3">
                    <h3 class="font-semibold">{{ $product->name }}</h3>
                    <p class="text-gray-400 text-sm">Rp {{ $product->price }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Running --}}
    <section id="running" class="mb-12">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Running</h2>
            <a href="/running" class="text-sm text-gray-400 hover:text-white">Lihat Semua →</a>
        </div>
        <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-6">
            @foreach ($products->where('category', 'running')->take(2) as $product)
                <div class="bg-gray-900 p-4 rounded-xl hover:scale-105 transition">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="rounded-lg mb-3">
                    <h3 class="font-semibold">{{ $product->name }}</h3>
                    <p class="text-gray-400 text-sm">Rp {{ $product->price }}</p>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
