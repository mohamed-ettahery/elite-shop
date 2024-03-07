<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $term = $request->input('term');

        $categories = Category::where('name', 'like', "%$term%")
            ->get();

        $products = Product::where('name', 'like', "%$term%")
            ->orWhereHas('category', function ($query) use ($term) {
                $query->where('name', 'like', "%$term%");
            })
            ->paginate(10)
            ->appends(['term' => $term]);

        $productCount = $products->total();

        return view('search', compact('products', 'term', 'productCount'));
    }
}
