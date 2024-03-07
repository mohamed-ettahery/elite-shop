<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            "name" => "required|min:4",
            'image' => 'required',
        ]);
        if ($request->has('image')) {
            $file = $request->image;
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/categories'), $image_name);
            $request->image = $image_name;
        }
        // Category::create($request->all());
        Category::create([
            'name' => $request->name,
            'image' => $request->image,
        ]);
        return redirect()->route('categories.index')->with("success", "Catégorie à été ajouté avec succés");
    }
    public static function getAllCategories()
    {
        $categories = Category::all();
        return $categories;
    }
    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view("admin.categories.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        request()->validate([
            "name" => "required|min:4",
            // 'image' => 'required',
        ]);
        if ($request->has('image')) {
            $file = $request->image;
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/categories'), $image_name);
            if (file_exists(public_path("uploads/categories/" . $request->image))) {
                unlink(public_path("uploads/categories/" . $request->image));
            }
            $image = $image_name;
        } else {
            $image = $request->old_img;
        }
        // $category->update($request->all());
        $category->update([
            "name" => $request->name,
            "image" => $image,
        ]);
        return redirect()->route('categories.index')->with("success", "Catégorie à été modifié avec succés");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with("success", "Catégorie à été supprimé avec succés");
    }
}
