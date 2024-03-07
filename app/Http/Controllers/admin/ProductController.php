<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'information' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
            'category_id' => 'required',
        ]);

        if ($request->has('image')) {
            $file = $request->image;
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $image_name);
        }
        Product::create([
            "name" => $request->name,
            "price" => $request->price,
            "description" => $request->description,
            "information" => $request->information,
            "image" => $image_name,
            "category_id" => $request->category_id,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Produit à été ajouté avec succés.');
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
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'information' => 'required',
            'category_id' => 'required',
        ]);

        if ($request->has('image')) {
            $file = $request->image;
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $image_name);
            if (file_exists(public_path("uploads/products/{$product->image}"))) {
                unlink(public_path("uploads/products/{$product->image}"));
            }
            $image = $image_name;
        } else {
            $image = $request->old_img;
        }

        $product->update([
            "name" => $request->name,
            "price" => $request->price,
            "description" => $request->description,
            "information" => $request->information,
            "image" => $image,
            "category_id" => $request->category_id,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Produit à été modifié avec succés');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (file_exists(public_path("uploads/products/{$product->image}"))) {
            unlink(public_path("uploads/products/{$product->image}"));
        }
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Produit à été supprimé avec succés');
    }
}
