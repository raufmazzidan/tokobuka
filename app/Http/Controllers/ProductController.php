<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('product', [
            'page' => 'Product',
            'data' => Product::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product-create', [
            'page' => 'Product'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'stock' => 'required|numeric|min:0',
            'buy_price' => 'required|numeric',
            'sell_price' => 'required|numeric',
            'image' => 'required'
        ]);

        $image_path = $request->file('image')->store('image', 'public');

        Product::create([
            'image' => $image_path,
            'name' => $request['name'],
            'description' => $request['description'],
            'category' => $request['category'],
            'stock' => $request['stock'],
            'buy_price' => $request['buy_price'],
            'sell_price' => $request['sell_price'],
        ]);

        return redirect('/product');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product-edit', [
            'page' => 'Product',
            'data' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'stock' => 'required|numeric|min:0',
            'buy_price' => 'required|numeric',
            'sell_price' => 'required|numeric',
        ]);


        $image = "";

        if ($request['image']) {
            if (gettype($request['image']) == 'string') {
                $image = $request['image'];
            } else {
                $image = $request->file('image')->store('image', 'public');
            }
        } else {
            $image = $product->image;
        }


        $p = [
            'image' => $image,
            'name' => $request['name'],
            'description' => $request['description'],
            'category' => $request['category'],
            'stock' => $request['stock'],
            'buy_price' => $request['buy_price'],
            'sell_price' => $request['sell_price'],
        ];

        Product::where('id', $product->id)->update($p);

        return redirect('/product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $d = Product::find($id);
        $d->delete();
        return redirect('/product');
    }
}