@extends('master')

@section('content')
<div class="max-w-3xl mx-auto px-6 pt-24 pb-12">
    <h1 class="text-3xl font-bold mb-8 text-center">Manajemen Kategori</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-6 text-center">
            {{ session('success') }}
        </div>
    @endif

    <form action="/admin/categories" method="POST" class="mb-6 flex space-x-2">
        @csrf
        <input type="text" name="name" placeholder="Nama kategori"
               class="flex-1 p-2 rounded bg-gray-800 text-white" required>
        <button class="bg-white text-black px-4 rounded font-semibold hover:bg-gray-200">
            Tambah
        </button>
    </form>

    <table class="min-w-full bg-gray-900 text-white rounded-xl overflow-hidden">
        <thead>
            <tr class="bg-gray-800">
                <th class="py-3 px-4 text-left">#</th>
                <th class="py-3 px-4 text-left">Nama Kategori</th>
                <th class="py-3 px-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $index => $category)
                <tr class="border-b border-gray-700 hover:bg-gray-800 transition">
                    <td class="py-3 px-4">{{ $index + 1 }}</td>
                    <td class="py-3 px-4">{{ $category->name }}</td>
                    <td class="py-3 px-4 text-center">
                        <form action="/admin/categories/{{ $category->id }}" method="POST"
                              onsubmit="return confirm('Yakin hapus kategori ini?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
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
