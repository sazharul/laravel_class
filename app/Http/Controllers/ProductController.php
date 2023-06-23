<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id', 'asc')->paginate(10);
        return view('backend.product.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = Category::where('status', 'Active')->select('id', 'name')->orderBy('name', 'asc')->get();
        $data['brands'] = Brand::where('status', 'Active')->select('id', 'name')->orderBy('name', 'asc')->get();
        $data['units'] = Unit::where('status', 'Active')->select('id', 'name')->orderBy('name', 'asc')->get();
        return view('backend.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $file = $request->image;
        if ($file) {
            $extention = $file->getClientOriginalExtension();
            $fileName = time() . rand(1, 999999) . '.' . $extention;
            $file->move('images', $fileName);
            $path = '/images/' . $fileName;
        } else {
            $path = null;
        }


        $category = new Product();
        $category->name = $request->name;
        $category->price = $request->price;
        $category->category_id = $request->category_id;
        $category->brand_id = $request->brand_id;
        $category->unit_id = $request->unit_id;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->image = $path;
        $category->save();

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('backend.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        return view('backend.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = $request->except('image');

        $file = $request->image;
        if ($file) {
            $extention = $file->getClientOriginalExtension();
            $fileName = time() . rand(1, 999999) . '.' . $extention;
            $file->move('images', $fileName);
            $path = '/images/' . $fileName;
            $requestData['image'] = $path;
        }


        $product = Product::findOrFail($id);
        $product->update($requestData);

        return redirect()->route('product.index');
    }


    public function cart()
    {
        return view('backend.product.cart');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        return $product;
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        session()->put('cart', $cart);
        return count((array) session('cart'));


//        return response()->json([
//            'status' => 'success',
//            'code' => '200',
//            'data' => count((array) session('cart'))
//        ]);


//        session()->put('cart', $cart);
//        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update_cart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
