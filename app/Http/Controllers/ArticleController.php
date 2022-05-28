<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->total) {
            $articles = Article::with(['category', 'hpro'])->orderBy('id', 'desc')->paginate($request->total);
            // $articles->setBaseUrl('https://' . $request->getHost() . '/' . $request->path());
            response()->json($articles);
        } else {
            $articles = Article::with(['category', 'hpro'])->orderBy('id', 'desc')->paginate(2);
            // $articles->setBaseUrl('https://' . $request->getHost() . '/' . $request->path());
            return response()->json($articles);
        }
    }

    public function related($id, $article)
    {
        return response()->json(Article::with(['category', 'hpro'])->orderBy('id', 'desc')->where('category_id', $id)->where('id', '!=', $article)->limit(5)->get());
    }

    public function search($criteria)
    {
        return response()->json(Article::with(['category', 'hpro'])->orderBy('id', 'desc')->where('title', 'like', '%' . $criteria . '%')->get());
    }

    public function latest()
    {
        return response()->json(Article::with(['category', 'hpro'])->orderBy('id', 'desc')->limit(5)->get());
    }

    public function show($id)
    {
        return Article::with(['category', 'hpro'])->find($id);
    }

    public function incrementViews($id)
    {
        $article =  Article::find($id);
        $article->views++;

        $article->save();
    }

    public function byCategory($category_id)
    {
        return response()->json(Article::with(['category', 'hpro'])->orderBy('id', 'desc')->where('category_id', $category_id)->paginate(10));
    }
    public function byPeriod($period)
    {
        if (strcmp($period, "week") === 0) {
            return response()->json(Article::with(['category', 'hpro'])->orderBy('id', 'desc')->whereBetween(
                'created_at',
                [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
            )->paginate(10));
        } elseif (strcmp($period, "month") === 0) {
            return response()->json(Article::with(['category', 'hpro'])->orderBy('id', 'desc')->where('created_at', '>=', Carbon::now()->subdays(30))->paginate(10));
        } elseif (strcmp($period, "year") === 0) {
            return response()->json(Article::with(['category', 'hpro'])->orderBy('id', 'desc')->whereYear('created_at', date('Y'))->paginate(10));
        } else {
        }
    }
    public function byViews($popularity)
    {
        if (strcmp($popularity, "most") === 0)
            return response()->json(Article::with(['category', 'hpro'])->orderBy('views', 'desc')->paginate(10));
        elseif (strcmp($popularity, "least") === 0)
            return response()->json(Article::with(['category', 'hpro'])->orderBy('views', 'asc')->paginate(10));
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