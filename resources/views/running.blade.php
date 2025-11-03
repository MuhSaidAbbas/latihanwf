@extends('master')

@section('content')

<div class="max-w-6xl mx-auto px-6 pt-24">
    <h1 class="text-3xl font-bold mb-8 text-center">Koleksi Running</h1>
    <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-6">
        @foreach ($products as $product)
            <div class="bg-gray-900 p-4 rounded-xl hover:scale-105 transition">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="rounded-lg mb-3">
                <h3 class="font-semibold">{{ $product['name'] }}</h3>
                <p class="text-gray-400 text-sm">Rp {{ $product['price'] }}</p>
            </div>
        @endforeach
    </div>
</div>


@endsection