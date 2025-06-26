<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class WebController extends Controller
{
    //
    public function index()
    {
        return view('web.home');
    }
    public function shop()
    {

        $products = Product::all();
        // dump($  products);
        // die();
        // $products = Product::orderByDesc('created_at')->get();
        return view('web.shop', [
            'products' => $products,
        ]);
    }
    public function checkout()
    {
        return view('web.checkout');
    }
    public function notfound()
    {
        return view('web.notfound');
    }
    ////////////////// cart start //////////////////
    public function cart()
    {
        return view('web.cart');
    }
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        // get cart data from session-variables
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "sku" => $product->sku,
                "price" => $product->price,
                "description" => $product->description,
                "image" => $product->image,
                "quantity" => 1,
            ];
        }
        session()->put('cart', $cart);
        // dump(session()->get('cart', []));
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            // dd($request);
            $cart = session()->get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            // session()->flash('success', "Cart updated successfully");
            return redirect()->back()->with('success', 'Product updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            // session()->flash('success', "Product removed successfully");
            return redirect()->back()->with('success', "Product removed successfully");
        }

    }
    ////////////////// cart end //////////////////

    public function placeorder(Request $request)
    {
        $cart = session()->get('cart');
        $total = 0;
        foreach ($cart as $key => $details) {
            $total += $details['quantity'] * $details['price'];
        }

        $order = new Order();
        $order->name = $request->fname;
        $order->email = $request->email;
        $order->number = $request->number;
        $order->address = $request->address;
        $order->price = $total;
        $order->total = $total;
        $order->save();

        session()->forget('cart');
        return redirect()->back()->with('success', 'order placed succesfully');
    }

}
