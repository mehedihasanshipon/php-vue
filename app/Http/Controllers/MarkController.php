<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Mark;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marks = Mark::with('student','course')->get();
        return Inertia::render('Mark/Index',[
            'marks' => $marks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::select('id','name','student_id')->get();
        $courses = Course::select('id','course_name',)->get();
        return Inertia::render('Mark/Create',[
            'students' => $students,
            'courses' => $courses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'mark' => 'required|integer|string',
            'student_id' => 'required|integer',
            'course_id' => 'required|integer',
        ]);

        Mark::create([
            'marks' => $request->mark,
            'student_id' => $request->student_id,
            'course_id' => $request->course_id,
        ]);

        return Redirect::route('marks.index')->with('success', 'Marks Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function show(Mark $mark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function edit(Mark $mark)
    {
        $students = Student::select('id','name','student_id')->get();
        $courses = Course::select('id','course_name',)->get();

        return Inertia::render('Mark/Edit',[
            'mark' => $mark,
            'students' => $students,
            'courses' => $courses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mark $mark)
    {
        $request->validate([
            'mark' => 'required|integer|string',
            'student_id' => 'required|integer',
            'course_id' => 'required|integer',
        ]);

        $mark->update([
            'marks' => $request->mark,
            'student_id' => $request->student_id,
            'course_id' => $request->course_id,
        ]);

        return Redirect::route('marks.index')->with('success', 'Marks Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mark $mark)
    {
        $mark->delete();
        return Redirect::back()->with('success', 'Mark Deleted');
    }
}
