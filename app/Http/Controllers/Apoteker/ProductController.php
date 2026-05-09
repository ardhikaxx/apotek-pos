<?php

namespace App\Http\Controllers\Apoteker;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('apoteker.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('apoteker.products.show', compact('product'));
    }

    public function addStock(Request $request, Product $product)
    {
        $request->validate(['qty' => 'required|integer|min:1']);
        $product->increment('stock', $request->qty);
        return back()->with('success', 'Stok berhasil ditambahkan.');
    }
}
