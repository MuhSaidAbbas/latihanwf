@extends('master')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-black text-white">
    <h1 class="text-5xl font-bold mb-4">404</h1>
    <p class="text-lg text-gray-400 mb-8">Halaman yang kamu cari tidak ditemukan.</p>
    <a href="{{ url('/') }}" class="bg-white text-black px-6 py-2 rounded-lg font-semibold hover:bg-gray-200 transition">
        Kembali ke Beranda
    </a>
</div>
@endsection
