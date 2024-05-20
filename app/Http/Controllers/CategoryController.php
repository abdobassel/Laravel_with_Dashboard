<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('products.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.categories.create');
        //
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',

            'desc' => 'nullable|string',


            'category_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('category_img')) {
            $categoryImage = $request->file('category_img');

            $fileName = time() . '_' . $categoryImage->getClientOriginalName();
            // اختر المسار المناسب لتخزين الصورة، هنا سنختار مجلد public
            $filePath = 'uploads/category_pictures/';

            $categoryImage->move(public_path($filePath), $fileName);
            // حفظ اسم الصورة في قاعدة البيانات

            $categoryData = [
                'name' => $validatedData['name'],
                'description' => $validatedData['desc'] ?? 'No description provided',
                'category_picture' => $filePath . $fileName,
                'user_id' => auth()->user()->id,
            ];

            Category::create($categoryData);

            return back()->with('success', 'Category added successfully!');
        } else {
            return back()->withErrors(['category_img' => 'category image is required.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($categoryid)
    {
        $category = Category::find($categoryid);
        return view('products.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($categoryid)
    {
        $category = Category::find($categoryid);
        $category->delete();

        return back()->with('success', 'Category Deleted successfully!');
    }
}
