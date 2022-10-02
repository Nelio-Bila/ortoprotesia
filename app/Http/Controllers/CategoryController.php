<?php

namespace App\Http\Controllers;

use App\Models\Category as ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryRegisterRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(ArticleCategory::with(['articles'])->orderBy('id', 'desc')->get());
    }
    public function store(CategoryRegisterRequest $request)
    {

        try {
            $category = ArticleCategory::create([
                'name' => $request->name,
            ]);

            return $category;
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function update(CategoryRegisterRequest $request, $id)
    {
        try {
            $category = ArticleCategory::find($id);
            $category->name = $request->name;

            return response()->json($category);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function show($id)
    {
        try {
            $category = ArticleCategory::find($id);
            return response()->json($category);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $category = ArticleCategory::find($id);
            $category->delete();

            return response()->noContent();
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}