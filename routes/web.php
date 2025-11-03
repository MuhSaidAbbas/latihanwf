<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
# Halaman form tambah produk
Route::get('/admin/products/create', function () {
    return view('admin.create-product');
});

# Proses form tambah produk
Route::post('/admin/products', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required',
        'category' => 'required',
        'price' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Simpan file gambar
   $imagePath = $request->file('image')->store('products', 'public');

    // copy file ke public/storage agar bisa diakses langsung
    $publicPath = public_path('storage/' . $imagePath);
    @mkdir(dirname($publicPath), 0777, true);
    copy(storage_path('app/public/' . $imagePath), $publicPath);

    Product::create([
        'name' => $validated['name'],
        'category' => $validated['category'],
        'price' => $validated['price'],
        'image' => '/storage/' . $imagePath,
    ]);


    return redirect('/admin/products/create')->with('success', 'Produk berhasil ditambahkan!');
});