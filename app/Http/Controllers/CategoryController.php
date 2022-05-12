<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRegisterRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::orderBy('id', 'desc')->get());
    }
    public function store(CategoryRegisterRequest $request)
    {
        $imageName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('images/categories'), $imageName);
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
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->noContent();
    }
}