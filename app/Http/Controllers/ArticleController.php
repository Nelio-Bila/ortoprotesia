<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Article;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        return Article::with(['category', 'hpro'])->orderBy('id', 'desc')->get();
    }

    public function myArticles($id)
    {
        return Article::with(['category', 'hpro'])->orderBy('id', 'desc')->where("health_professional_id", $id)->get();
    }
    public function myViewsCount($id)
    {
        return Article::with(['category', 'hpro'])->orderBy('id', 'desc')->where("health_professional_id", $id)->sum('views');
    }


    // TODO
    public function myTodayViewsCount($id)
    {
        return Article::with(['category', 'hpro'])->orderBy('id', 'desc')->where("health_professional_id", $id)->whereDate('updated_at', Carbon::today())->sum('views');
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
        return response()->json(Article::with(['category', 'hpro'])->orderBy('id', 'desc')->where('category_id', $category_id)->get());
    }
    public function byPeriod($period)
    {
        if (strcmp($period, "week") === 0) {
            return response()->json(Article::with(['category', 'hpro'])->orderBy('id', 'desc')->whereBetween(
                'created_at',
                [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
            )->get());
        } elseif (strcmp($period, "month") === 0) {
            return response()->json(Article::with(['category', 'hpro'])->orderBy('id', 'desc')->where('created_at', '>=', Carbon::now()->subdays(30))->get());
        } elseif (strcmp($period, "year") === 0) {
            return response()->json(Article::with(['category', 'hpro'])->orderBy('id', 'desc')->whereYear('created_at', date('Y'))->get());
        } else {
        }
    }
    public function byViews($popularity)
    {
        if (strcmp($popularity, "most") === 0)
            return response()->json(Article::with(['category', 'hpro'])->orderBy('views', 'desc')->get());
        elseif (strcmp($popularity, "least") === 0)
            return response()->json(Article::with(['category', 'hpro'])->orderBy('views', 'asc')->get());
    }

    public function store(ArticleRequest $request)
    {
        $article = new Article();

        if ($request->file()) {

            $image_name = $request->file('featuredImage')->getRealPath();
            //the upload method handles the uploading of the file and can accept attributes to define what should happen to the image

            //Also note you could set a default height for all the images and Cloudinary does a good job of handling and rendering the image.
            Cloudder::upload($image_name, null, array(
                "folder" => "ortoprotesia/articles/headers",  "overwrite" => FALSE,
                "resource_type" => "image", "responsive" => TRUE, "transformation" => array("quality" => "70", "width" => "250", "height" => "250", "crop" => "scale")
            ));

            //Cloudinary returns the publicId of the media uploaded which we'll store in our database for ease of access when displaying it.

            $public_id = Cloudder::getPublicId();

            $width = 250;
            $height = 250;

            //The show method returns the URL of the media file on Cloudinary
            $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height, "crop" => "scale", "quality" => 70, "secure" => "true"]);

            //In a situation where the user has already uploaded a file we could use the delete method to remove the media and upload a new one.
            // if ($public_id != null) {
            //     $image_public_id_exist = Article::select('header_image_public_id')->where('id', Article::id)->get();
            //     Cloudder::delete($image_public_id_exist);
            // }

            $article->title = $request->title;
            $article->body = $request->body;
            $article->jsonData = $request->jsonData;
            $article->postExcerpt = $request->postExcerpt;
            $article->slug = $request->slug;
            $article->featuredImage = $image_url;
            $article->header_image_public_id = $public_id;
            $article->metaDescription = $request->metaDescription;
            $article->health_professional_id = $request->health_professional_id;
            $article->category_id = $request->category_id;

            // $article->path = '/storage/' . $image_path;
            $article->save();

            return response()->json(['success' => 'Article posted successfully.']);
        }
    }
    public function update(ArticleRequest $request, $id)
    {


        $article = Article::find($id);

        if ($request->file()) {

            $image_name = $request->file('featuredImage')->getRealPath();
            //the upload method handles the uploading of the file and can accept attributes to define what should happen to the image

            //Also note you could set a default height for all the images and Cloudinary does a good job of handling and rendering the image.
            Cloudder::upload($image_name, null, array(
                "folder" => "ortoprotesia/articles/headers",  "overwrite" => FALSE,
                "resource_type" => "image", "responsive" => TRUE, "transformation" => array("quality" => "70", "width" => "250", "height" => "250", "crop" => "scale")
            ));

            //Cloudinary returns the publicId of the media uploaded which we'll store in our database for ease of access when displaying it.

            $public_id = Cloudder::getPublicId();

            $width = 250;
            $height = 250;

            //The show method returns the URL of the media file on Cloudinary
            $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height, "crop" => "scale", "quality" => 70, "secure" => "true"]);

            //In a situation where the user has already uploaded a file we could use the delete method to remove the media and upload a new one.
            if ($public_id != null) {
                $image_public_id_exist = Article::select('header_image_public_id')->where('id', $article->id)->get();
                Cloudder::delete($image_public_id_exist);
            }

            $article->title = $request->title;
            $article->body = $request->body;
            $article->postExcerpt = $request->postExcerpt;
            $article->featuredImage = $image_url;
            $article->header_image_public_id = $public_id;
            $article->metaDescription = $request->title;
            $article->category_id = $request->category_id;

            $article->save();

            return response()->json(['success' => 'Article updated successfully.']);
        }
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        return response()->noContent();
    }
}