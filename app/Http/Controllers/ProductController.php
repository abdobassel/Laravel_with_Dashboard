<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'desc' => 'nullable|string',
            'category' => 'required|exists:categories,id',

            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('product_img')) {
            $productImage = $request->file('product_img');

            $fileName = time() . '_' . $productImage->getClientOriginalName();
            // اختر المسار المناسب لتخزين الصورة، هنا سنختار مجلد public
            $filePath = 'uploads/product_pictures/';

            $productImage->move(public_path($filePath), $fileName);
            // حفظ اسم الصورة في قاعدة البيانات




            // طباعة محتويات الطلب للتصحيح
            //   dd($request->all());

            $productData = [
                'name' => $validatedData['name'],
                'price' => $validatedData['price'],
                'description' => $validatedData['desc'] ?? 'No description provided',
                'category_id' => $validatedData['category'],
                'product_picture' => $filePath . $fileName,
                'user_id' => auth()->user()->id,
            ];

            Product::create($productData);

            return redirect()->route('admin.products')->with('success', 'Product added successfully!');
        } else {
            return back()->withErrors(['product_img' => 'Product image is required.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($productid)
    {
        $categories = Category::all();
        $product = Product::find($productid);
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $productid)
    {
        $product = Product::find($productid);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'desc' => 'nullable|string',
            'category' => 'required|exists:categories,id',


            'product_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',


        ]);


        // Update the product data

        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->description = $validatedData['desc'] ?? 'No description provided';
        $product->category_id = $validatedData['category'];
        $product->user_id = auth()->user()->id;

        // Check if a new product image was uploaded
        if ($request->hasFile('product_img')) {
            if ($product->product_picture && file_exists(public_path($product->product_picture))) {
                unlink(public_path($product->product_picture));
            }

            $productImage = $request->file('product_img');
            $fileName = time() . '_' . $productImage->getClientOriginalName();
            $filePath = 'uploads/product_pictures/';
            $productImage->move(public_path($filePath), $fileName);
            $product->product_picture = $filePath . $fileName;
        }

        // Save the updated product data

        $product->save();

        return back()->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product) {
            $product->delete();
        }

        return back()->with('success', 'Product Deleted successfully!');
    }
}
