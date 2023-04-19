<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Image;

class courseController extends Controller
{
    public function index()
    {
        return Course::all();
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        $imageName = date("YmdHis").$image->getClientOriginalName(). '.webp';

        Image::make($image)->encode('webp',70)->save(public_path('courses/'  .  $imageName));

       $course =  Course::create([
            "title"=> $request->title,
            "image"=> $imageName,
            "description"=> $request->description,
            "short_desc"=> $request->short_desc,
            "user_id" => $request->user()->id
        ]);

        return $course;
    }

    public function show($id)
    {
        return Course::find($id);
    }

    public function update(Request $request)
    {
        $course = Course::find($request->id);
        $imageName = $course->image;
        if ($request->hasFile("image")){
            $image = $request->file('image');
            $imageName = date("YmdHis").$image->getClientOriginalName(). '.webp';

            Image::make($image)->encode('webp',70)->save(public_path('courses/'  .  $imageName));
            @unlink(public_path('courses/'  .  $course->image));
        }

        Course::find($request->id)->update([
            "title"=> $request->title,
            "image"=> $imageName,
            "description"=> $request->description,
            "short_desc"=> $request->short_desc,
            "user_id" => $request->user()->id
        ]);
        return response($request->title,200);
    }

    public function destroy($id)
    {
        Course::find($id)->update(["removed" => 1]);

        return true;
    }
}
