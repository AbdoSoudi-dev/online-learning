<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Image;

class courseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::whereRemoved(0)->get();
        return response($courses,201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
//            "price"=> $request->price,
            "user_id" => $request->user()->id
        ]);

        return response($course,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        return response($course,201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
//            "price"=> $request->price,
            "user_id" => $request->user()->id
        ]);
        return response($request->title,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        $course->removed = 1;
        $course->save();

        return response("done",200);
    }
}
