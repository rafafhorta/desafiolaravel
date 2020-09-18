<?php

namespace App\Http\Controllers;

use App\Course;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Requests\StoreCourseRequest;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        $categories = Category::all();
        return view('admin.courses.index', compact('courses', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = new Course();
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.courses.create', compact('course', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        $slug = Str::slug("$request->name", "$request->category_id", '-');
        $data = $request->all();
        if ($request->hasfile('imglink')) {
            $extension = $request->imglink->getClientOriginalExtension();
            $nameFile = "$slug.{$extension}";
            $request->imglink->storeAs('public/img/course', $nameFile);
            $data['imglink'] = $nameFile;
        } else {
            unset($data['imglink']);
        }
        $data['slug'] = $slug;
        Course::create($data);
        return redirect()->route('courses.index')->with('success',true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        $categories = Category::all();
        return view('admin.courses.show',compact('course', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course, string $slug  = null)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.courses.edit',compact('course', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $slug = Str::slug("$request->name", "$request->category_id", '-');
        $data = $request->all();
        if ($request->hasfile('imglink')) {
            $extension = $request->imglink->getClientOriginalExtension();
            $nameFile = "$slug.{$extension}";
            $request->imglink->storeAs('public/img/course', $nameFile);
            $data['imglink'] = $nameFile;
        } else {
            unset($data['imglink']);
        }
        $data['slug'] = $slug;
        $course->update($data);
        return redirect()->route('courses.index')->with('success',true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        Storage::delete('img/courses/' . $course->imglink);
        return redirect()->route('courses.index')->with('success',true);
    }
}
