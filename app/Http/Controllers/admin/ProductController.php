<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    //
    function index()
    {
        // $products = Product::orderByDesc('created_at')->get();
        $products = Product::all();
        return view('admin.products_list', ['products' => $products]);
    }

    function orders()
    {
        $orders = Order::all();
        return view('admin.orders_list', ['orders' => $orders]);
    }

    function create()
    {
        return view('admin.products_create');
    }

    function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->sku = $request->sku;
        $product->description = $request->description;
        $product->save();

        if ($request->image != "") {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . "." . $ext; // Unique image name;

            // save image to products directory
            $image->move(public_path('/uploads/products'), $imageName);

            // save image in the database
            $product->image = $imageName;
            $product->save();
        }

        // return redirect()->route('admin-products-index');
        return redirect()->action([ProductController::class, 'index']);
        // dump($request);
        // $product->name = $request->name

    }

    function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image != "") {
            // delete associated image file
            File::delete(public_path('/uploads/products/' . $product->image));
        }
        $product->delete();
        return redirect()->route('admin-products-index');

    }
    function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products_edit', ['product' => $product]);
    }
    function update($id, Request $request)
    {
        // echo "Update called with " . $id;
        // dump($request);
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != "") {
            // delete old image
            File::delete(public_path('uploads/products/' . $product->image));
            // Create new image file name
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; // unique Image Name

            //save image to the public directory
            $image->move(public_path('uploads/products/'), $imageName);
            $product->image = $imageName;
            $product->save();

        }
        return redirect()->route('admin-products-index');
    }

    // Cart methods
}
