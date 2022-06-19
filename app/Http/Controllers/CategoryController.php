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
            $imageName = "category_default.png";
            if ($request->hasFile("image")) {
                $imageName = time() . '.' . $request->image->getClientOriginalName();

                $request->file('image')->storeAs('images/categories', $imageName);
                // $request->image->move(public_path('images/categories'), $imageName);
            }
            $category = ArticleCategory::create([
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

    // CategoryRegisterRequest $request
    public function update(Request $request, $id)
    {
        return $request;

        // $category->update($request->validated());

        // return $category;
    }

    public function show($id)
    {
        return ArticleCategory::where('id', $id)->get();
    }

    public function destroy(ArticleCategory $category)
    {
        $category->delete();

        return response()->noContent();
    }
}