<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->total) {
            return response()->json(Article::with(['category', 'health_professional'])->orderBy('id', 'desc')->paginate($request->total));
        } else {
            return response()->json(Article::with(['category', 'health_professional'])->orderBy('id', 'desc')->get());
        }
    }

    public function show($id)
    {
        return Article::find($id);
    }

    public function store()
    {
    }
    public function update()
    {
    }
    public function destroy()
    {
    }
}