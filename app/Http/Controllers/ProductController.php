<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Show the form of create product.
     */
    public function create()
    {
        $subcategories = Subcategory::get();
        return view('create', ['subcategories' => $subcategories]);
    }

    /**
     * Filter product by title, category, subcategory and price range
     */
    public function filter(Request $request)
    {
        if ($request->filterby == 'title') {
            $products = Product::where('title', 'like',  "%$request->search%")->get();
        }
        else if ($request->filterby == 'category') {
            $products = new Collection();
            $categories = Category::where('title', 'like',  "%$request->search%")->get();
            foreach ($categories as $category) {
                $products = $products->merge($category->products);
            }
        }
        else if ($request->filterby == 'subcategory') {
            $products = new Collection();
            $subcategories = Subcategory::where('title', 'like', "%$request->search%")->get();
            foreach ($subcategories as $subcategory) {
                $products = $products->merge($subcategory->products);
            }
        }
        else if ($request->filterby == 'price') {
            $products = new Collection();
            if (isset($request->min) && isset($request->max) && ((int)$request->min < (int)$request->max)) {
                $products = Product::whereBetween('price', [(int)$request->min, (int)$request->max])->get();
            }
        }
        return view('home', ['products' => $products]);
    }

    /**
     * Store product with image
     */
    public function store(StoreProductRequest $request)
    {
        $thumbnail = $request->file('thumbnail');
        $newThumbnailName = rand() . '.' . $thumbnail->getClientOriginalExtension();
        $destinationPath = public_path('/uploads');
        $thumbnail->move($destinationPath, $newThumbnailName);

        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'subcategory_id' => $request->input('subcategory'),
            'price' => $request->input('price'),
            'thumbnail' => $newThumbnailName
        ];

        Product::create($data);
        return redirect(url('/create'))->with('createProduct', 'Product Created Successfully!!!');
    }

    /**
     * Delete product with image
     */
    public function delete($id)
    {
        $product = Product::find($id);
        unlink(public_path('/uploads/' . $product->thumbnail));
        $product->delete();
        return redirect(url()->previous())->with('productDelete', 'Product Deleted successfully!');
    }
}
