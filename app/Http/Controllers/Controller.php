<?php

namespace App\Http\Controllers;

abstract class Controller
{
        public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dipulihkan!');
    }

}
