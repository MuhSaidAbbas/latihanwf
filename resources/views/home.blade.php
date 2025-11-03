@extends('master')

@section('content')
<div class="max-w-6xl mx-auto px-6 pt-24">
    <h1 class="text-3xl font-bold mb-8 text-center">Koleksi Sepatu Terbaru</h1>

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
