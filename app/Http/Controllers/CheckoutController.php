<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use DB;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.catalog')->withErrors('Your cart is empty.');
        }

        $totalCartValue = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('frontend.checkout', compact('cart', 'totalCartValue'));
    }
    
    public function store(CheckoutRequest $request)
    {
        $request->validated();

        $cart = session('cart', []);
        if (!$cart) {
            return redirect()->back()->withErrors('Cart is empty.');
        }
        
        $order = null;
        DB::transaction(function () use ($request, $cart, &$order) {
            // Stock validation
            foreach ($cart as $id => $item) {
                $product = Product::find($id);
                if (!$product || $product->stock_quantity < $item['quantity']) {
                    throw new \Exception("Insufficient stock for {$product?->name}");
                }
            }

            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(Str::random(6)),
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'total_price' => $request->total_cart_value,
            ]);
            
            foreach ($cart as $id => $item) {
                $order->products()->attach($id, ['quantity' => $item['quantity']]);
                Product::where('id', $id)->decrement('stock_quantity', $item['quantity']);
            }
        });

        session()->forget('cart');
        return view('frontend.order-success', ['orderNumber' => $order->order_number])
            ->with('success', 'Order placed successfully. Your order number is ' . $order->order_number);
    }

}
