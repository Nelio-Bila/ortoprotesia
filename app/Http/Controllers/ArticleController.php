<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->total) {
            return response()->json(Article::with(['category', 'hpro'])->orderBy('id', 'desc')->paginate($request->total));
        } else {
            return response()->json(Article::with(['category', 'hpro'])->orderBy('id', 'desc')->get());
        }
    }

    public function related($id, $article)
    {
        return response()->json(Article::with(['category', 'hpro'])->orderBy('id', 'desc')->where('category_id', $id)->where('id', '!=', $article)->limit(5)->get());
    }

    public function show($id)
    {
        return Article::with(['category', 'hpro'])->find($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'featuredImage' => 'required|mimes:jpg,jpeg,png|max:20048'
        ]);

        $article = new Article();

        if ($request->file()) {
            $image_name = time() . '_' . $request->featuredImage->getClientOriginalName();
            $image_path = $request->file('featuredImage')->storeAs('articles/headers', $image_name, 'public');

            $article->title = $request->title;
            $article->body = $request->body;
            $article->jsonData = $request->jsonData;
            $article->postExcerpt = $request->postExcerpt;
            $article->slug = $request->slug;
            $article->featuredImage = time() . '_' . $request->featuredImage->getClientOriginalName();
            $article->metaDescription = $request->metaDescription;
            $article->health_professional_id = 1;
            $article->category_id = $request->category_id;

            // $article->path = '/storage/' . $image_path;
            $article->save();

            return response()->json(['success' => 'Article posted successfully.']);
        }
    }
    public function update()
    {
    }
    public function destroy()
    {
    }
}