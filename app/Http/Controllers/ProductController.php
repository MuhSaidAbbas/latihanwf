<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // existing methods: index(), create(), store(), edit(), update(), destroy()

    /**
     * Tampilkan halaman Recycle Bin (soft deleted products)
     */
    public function trash()
    {
        // Ambil hanya yang di-soft-delete (trashed)
        $trashedProducts = Product::onlyTrashed()->with('category')->latest()->get();

        // tampilkan view admin.products.trash (kita buat)
        return view('admin.products.trash', compact('trashedProducts'));
    }

    /**
     * Restore product yang di-soft-delete
     */
    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        // restore (hapus nilai deleted_at)
        $product->restore();

        return redirect()->route('products.trash')->with('success', 'Produk berhasil dipulihkan!');
    }

    /**
     * Hapus permanen product dari database (force delete)
     */
    public function forceDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        // Hapus file gambar fisik dulu kalau ada (opsional tapi disarankan)
        if ($product->image) {
            $filePath = public_path($product->image);
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
        }

        // Force delete dari database
        $product->forceDelete();

        return redirect()->route('products.trash')->with('success', 'Produk dihapus permanen!');
    }

        public function index()
    {
        // Ambil semua produk, termasuk yang sudah dihapus (soft delete)
        $products = \App\Models\Product::withTrashed()
            ->with('category')
            ->latest()
            ->get();

        // Kirim data ke view dashboard admin
        return view('admin.dashboard', compact('products'));
    }

}
