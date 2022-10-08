<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Notice;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use App\Http\Requests\NoticeRequest;
use App\Http\Requests\NoticeUpdateRequest;

class NoticeController extends Controller
{
    public function index()
    {
        return Notice::with(['category'])->orderBy('id', 'desc')->get();
    }


    public function related($id, $notice)
    {
        return response()->json(Notice::with(['category'])->orderBy('id', 'desc')->where('category_id', $id)->where('id', '!=', $notice)->limit(5)->get());
    }

    public function search($criteria)
    {
        return response()->json(Notice::with(['category'])->orderBy('id', 'desc')->where('title', 'like', '%' . $criteria . '%')->orWhere('body', 'like', '%' . $criteria . '%')->get());
    }

    public function latest()
    {
        return response()->json(Notice::with(['category'])->orderBy('id', 'desc')->limit(5)->get());
    }

    public function show($id)
    {
        return Notice::with(['category'])->find($id);
    }

    public function byCategory($category_id)
    {
        return response()->json(Notice::with(['category'])->orderBy('id', 'desc')->where('category_id', $category_id)->get());
    }
    public function byPeriod($period)
    {
        if (strcmp($period, "week") === 0) {
            return response()->json(Notice::with(['category'])->orderBy('id', 'desc')->whereBetween(
                'created_at',
                [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]
            )->get());
        } elseif (strcmp($period, "month") === 0) {
            return response()->json(Notice::with(['category'])->orderBy('id', 'desc')->where('created_at', '>=', Carbon::now()->subdays(30))->get());
        } elseif (strcmp($period, "year") === 0) {
            return response()->json(Notice::with(['category'])->orderBy('id', 'desc')->whereYear('created_at', date('Y'))->get());
        } else {
        }
    }

    public function store(NoticeRequest $request)
    {
        $notice = new Notice();

        if ($request->file()) {

            $image_name = $request->file('featuredImage')->getRealPath();
            //the upload method handles the uploading of the file and can accept attributes to define what should happen to the image

            //Also note you could set a default height for all the images and Cloudinary does a good job of handling and rendering the image.
            Cloudder::upload($image_name, null, array(
                "folder" => "ortoprotesia/notices/headers",  "overwrite" => FALSE,
                "resource_type" => "image", "responsive" => TRUE, "transformation" => array("quality" => "70", "width" => "500", "height" => "250", "crop" => "scale")
            ));

            //Cloudinary returns the publicId of the media uploaded which we'll store in our database for ease of access when displaying it.

            $public_id = Cloudder::getPublicId();

            $width = 250;
            $height = 250;

            //The show method returns the URL of the media file on Cloudinary
            $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height, "crop" => "scale", "quality" => 70, "secure" => "true"]);


            $notice->title = $request->title;
            $notice->body = $request->body;
            $notice->slug = $request->slug;
            $notice->featuredImage = $image_url;
            $notice->header_image_public_id = $public_id;
            $notice->category_id = $request->category_id;

            $notice->save();

            return response()->json(['success' => 'Notice posted successfully.']);
        }
    }
    public function update(NoticeUpdateRequest $request, $id)
    {


        $notice = Notice::find($id);

        if ($request->file()) {

            $image_name = $request->file('featuredImage')->getRealPath();
            //the upload method handles the uploading of the file and can accept attributes to define what should happen to the image

            //Also note you could set a default height for all the images and Cloudinary does a good job of handling and rendering the image.
            Cloudder::upload($image_name, null, array(
                "folder" => "ortoprotesia/notices/headers",  "overwrite" => FALSE,
                "resource_type" => "image", "responsive" => TRUE, "transformation" => array("quality" => "70", "width" => "500", "height" => "250", "crop" => "scale")
            ));

            //Cloudinary returns the publicId of the media uploaded which we'll store in our database for ease of access when displaying it.

            $public_id = Cloudder::getPublicId();

            $width = 250;
            $height = 250;

            //The show method returns the URL of the media file on Cloudinary
            $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height, "crop" => "scale", "quality" => 70, "secure" => "true"]);

            //In a situation where the user has already uploaded a file we could use the delete method to remove the media and upload a new one.
            if ($public_id != null) {
                $image_public_id_exist = Notice::select('header_image_public_id')->where('id', $notice->id)->get();
                Cloudder::delete($image_public_id_exist);
            }

            $notice->title = $request->title;
            $notice->body = $request->body;
            $notice->featuredImage = $image_url;
            $notice->header_image_public_id = $public_id;
            $notice->category_id = $request->category_id;

            $notice->save();

            return response()->json(['success' => 'Notice updated successfully.']);
        } else {
            $notice->title = $request->title;
            $notice->body = $request->body;
            $notice->category_id = $request->category_id;

            $notice->save();

            return response()->json(['success' => 'Notice updated successfully.']);
        }
    }

    public function destroy($id)
    {
        $notice = Notice::find($id);
        $notice->delete();

        return response()->noContent();
    }
}