<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('shop', [
            'page' => 'Shop',
            'product' => Product::all()
        ]);
    }

    public function my_order()
    {
        return view('myorder', [
            'page' => 'My Order',
            'data' => Order::where('user_id', auth()->user()->id)->join('products', 'orders.product_id', '=', 'products.id')->orderByDesc('orders.updated_at')
                ->get()
        ]);
    }

    public function order_list()
    {
        return view('order', [
            'page' => 'Order',
            'data' => Order::join('products', 'orders.product_id', '=', 'products.id')->join('users', 'orders.user_id', '=', 'users.id')->orderByDesc('orders.updated_at')
                ->get(['users.name AS user_name', 'products.name AS product_name', 'orders.*'])
        ]);
    }

    public function order(Request $request)
    {
        Order::create([
            'product_id' => $request['product_id'],
            'user_id' => $request['user_id'],
            'status' => 'pending'
        ]);

        return redirect('/')->with(['success' => 'Berhasil order Product']);
    }

    public function order_update($id, Request $request)
    {
        $product = Product::find($request['product_id']);

        if ($product->stock < 1 && $request['status'] == 'completed') {
            return redirect('/order')->with(['error' => 'Stok Produk Habis, Silahkan update stok product anda']);
        }

        Order::where('id', $id)->update([
            'status' => $request['status']
        ]);

        if ($request['status'] == 'completed') {

            $p_product = [
                'stock' => $product->stock - 1
            ];

            Product::where('id', $request['product_id'])->update($p_product);

            return redirect('/order');

        } else {
            return redirect('/order');
        }
    }
}