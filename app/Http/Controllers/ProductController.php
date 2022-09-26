<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::select('id', 'name', 'price', 'thumbnail_url', 'status')->paginate(5);
        return view('admin.product.list', compact('products'));
    }
    public function delete(Product $product)
    {
        $product->delete();
        return redirect()->back();
    }
    public function create()
    {
        return view('admin.product.create');
    }
    public function store(Request $request)
    {
        $product = new Product();
        $product->fill($request->all());
        if ($request->hasFile('thumbnail_url')) {
            $image = $request->thumbnail_url;
            $imageName = $image->hashName();
            $imageName = $request->name . '_' . $imageName;
            $product->thumbnail_url = $image->storeAs('images/product', $imageName);
        }
        $product->save();
        return redirect()->route('products.list');
    }

    public function update_status(Request $request, Product $product)
    {
        if ($product->status == 1) {
            $product->status = 0;
        } else {
            $product->status = 1;
        }
        $product->update(['status' => $product->status]);
        return redirect()->back();
    }
    public function search(Request $request)
    {
        $products = Product::where('name', 'LIKE', '%' . $request->keyword . '%')->paginate(5);
        return view('admin.product.list', compact('products'));
    }
    public function apiGetListProduct()
    {
        $products = Product::all();

        return  response()->json(
            $$products,
            200
        );
    }
}
