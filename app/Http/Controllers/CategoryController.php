<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryRegisterRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::orderBy('id', 'desc')->get());
    }
    public function store(CategoryRegisterRequest $request)
    {
        $imageName = time() . '.' . $request->file('image')->getClientOriginalName();

        $request->file('image')->storeAs('images/categories', $imageName);
        // $request->image->move(public_path('images/categories'), $imageName);
        try {
            $category = Category::create([
                'name' => $request->name,
                'image' => $imageName,
            ]);

            return $category;
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }

        // STart
        // foreach ($request->media as $image) {
        //     $from = public_path('tmp/uploads/' . $image);
        //     $to = public_path('images/categories/' . $image);

        //     File::move($from, $to);
        //     $category = Category::create([
        //         'name' => $request->name,
        //         'image' => $image,
        //     ]);

        //     return $category;
        // }
    }

    public function update(CategoryRegisterRequest $request, Category $category)
    {
        $category->update($request->validated());

        return $category;
    }

    public function show($id)
    {
        return response()->json(Category::find($id)->get());
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->noContent();
    }
}