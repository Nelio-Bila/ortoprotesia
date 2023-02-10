<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRegisterRequest;
use App\Models\Category as ArticleCategory;
use Illuminate\Support\Str;

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
                'id' => Str::uuid()->toString(),
                'name' => $request->name,
            ]);

            return $category;
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function update(CategoryRegisterRequest $request, $id)
    {
        try {
            $category = ArticleCategory::find($id);
            $category->name = $request->name;

            $category->save();

            return response()->json($category);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
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
                'message' => $exception->getMessage(),
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
                'message' => $exception->getMessage(),
            ], 400);
        }
    }
}
