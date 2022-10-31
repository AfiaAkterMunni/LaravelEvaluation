<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('create');
    }
    public function filter(Request $request)
    {
        // dd($request);
        if($request->filterby == 'title')
        {
            $products = Product::where('title', 'like',  "%$request->search%")->get();
        }
        else if($request->filterby == 'category')
        {
            $products = new Collection();
            $categories = Category::where('title', 'like',  "%$request->search%")->get();
            foreach($categories as $category)
            {
                $products = $products->merge($category->products);
            }
            // dd( $products);
        }
        else if($request->filterby == 'subcategory')
        {
            $products = new Collection();
            $subcategories = Subcategory::where('title', 'like', "%$request->search%")->get();
            foreach($subcategories as $subcategory)
            {
                $products = $products->merge($subcategory->products);
            }
        }
        else if($request->filterby == 'price')
        {
            $products = new Collection();
            if(isset($request->min) && isset($request->max) && ((int)$request->min < (int)$request->max) )
            {
                $products = Product::whereBetween('price', [(int)$request->min, (int)$request->max])->get();
            }
            // dd($request);
        }
        return view('home', ['products' => $products]);
    }
}
