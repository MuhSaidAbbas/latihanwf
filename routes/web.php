<?php

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/admin/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/admin/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/admin/products', [ProductController::class, 'store'])->name('products.store');
Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/admin/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::post('/admin/products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');

// HALAMAN ADMIN FORM TAMBAH PRODUK
Route::get('/admin/products/create', function () {
    $categories = Category::all(); 
    return view('admin.create-product', ['categories' => $categories]); 
});


// HAPUS PRODUK
Route::delete('/admin/products/{id}', function ($id) {
    $product = \App\Models\Product::findOrFail($id);

    // Hapus file gambar dari storage
    $filePath = public_path($product->image);
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    $product->delete();
    return redirect('/admin/products')->with('success', 'Produk berhasil dihapus!');
});

// HALAMAN EDIT PRODUK
Route::get('/admin/products/{id}/edit', function ($id) {
    $product = \App\Models\Product::findOrFail($id);
    return view('admin.edit-product', compact('product'));
});

// PROSES UPDATE PRODUK
Route::put('/admin/products/{id}', function (Illuminate\Http\Request $request, $id) {
    $validated = $request->validate([
        'name' => 'required',
        'category' => 'required',
        'price' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $product = \App\Models\Product::findOrFail($id);

    // Jika ada gambar baru diupload
    if ($request->hasFile('image')) {
        // Hapus gambar lama
        $oldPath = public_path($product->image);
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }

        // Simpan gambar baru
        $imagePath = $request->file('image')->store('products', 'public');

        // Copy ke public agar bisa diakses browser
        $publicPath = public_path('storage/' . $imagePath);
        @mkdir(dirname($publicPath), 0777, true);
        copy(storage_path('app/public/' . $imagePath), $publicPath);

        $product->image = '/storage/' . $imagePath;
    }

    // Update field lainnya
    $product->update([
        'name' => $validated['name'],
        'category' => $validated['category'],
        'price' => $validated['price'],
        'image' => $product->image,
    ]);

    return redirect('/admin/products')->with('success', 'Produk berhasil diperbarui!');
});

// HALAMAN UTAMA & KATEGORI PRODUK
Route::get('/home', fn() => view('home', [
    'products' => Product::all()
]));

Route::get('/sneakers', function () {
    $category = Category::where('name', 'sneakers')->first();
    $products = $category ? $category->products : collect(); // kalau tidak ada, kirim koleksi kosong
    return view('sneakers', compact('products'));
});

Route::get('/basket', function () {
    $category = Category::where('name', 'basket')->first();
    $products = $category ? $category->products : collect();
    return view('basket', compact('products'));
});

Route::get('/running', function () {
    $category = Category::where('name', 'running')->first();
    $products = $category ? $category->products : collect();
    return view('running', compact('products'));
});

// FALLBACK UNTUK HALAMAN YANG TIDAK DITEMUKAN
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

// PROSES TAMBAH PRODUK (POST)
Route::post('/admin/products', function (Request $request) {
    // Validasi input form
    $validated = $request->validate([
        'name' => 'required',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Simpan file gambar ke storage/app/public/products
    $imagePath = $request->file('image')->store('products', 'public');

    // Salin juga ke public/storage biar bisa diakses langsung di browser
    $publicPath = public_path('storage/' . $imagePath);
    @mkdir(dirname($publicPath), 0777, true);
    copy(storage_path('app/public/' . $imagePath), $publicPath);

    // Simpan data ke tabel products
    Product::create([
        'name' => $validated['name'],
        'category_id' => $validated['category_id'],
        'price' => $validated['price'],
        'image' => '/storage/' . $imagePath,
    ]);

    // Redirect kembali ke form dengan pesan sukses
    return redirect('/admin/products/create')
        ->with('success', 'Produk berhasil ditambahkan!');
});


// --- DAFTAR KATEGORI
Route::get('/admin/categories', function () {
    $categories = Category::latest()->get();
    return view('admin.categories.index', compact('categories'));
});

// --- TAMBAH KATEGORI
Route::post('/admin/categories', function (Illuminate\Http\Request $request) {
    $request->validate(['name' => 'required']);
    Category::create(['name' => $request->name]);
    return back()->with('success', 'Kategori berhasil ditambahkan!');
});

// --- HAPUS KATEGORI
Route::delete('/admin/categories/{id}', function ($id) {
    Category::findOrFail($id)->delete();
    return back()->with('success', 'Kategori berhasil dihapus!');
});
