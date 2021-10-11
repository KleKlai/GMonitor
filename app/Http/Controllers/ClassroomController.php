<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use Auth;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware(['role_or_permission:teacher|student']);
    }

    public function index()
    {
        //Validate Current User
        if(Auth::user()->hasRole('student'))
        {
            return view('auth.register-success');
        }

        $classrooms = Classroom::archive(false)->whereHas('users', function ($query) {
            return $query->where('users.id', auth()->user()->id);
        })->withCount('users')->orderBy('id', 'desc')->get();

        return view('dashboard', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classroom.create');
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
            'name'  => 'required', 'string', 'max:80'
        ]);

        $classroom = Classroom::create([
            'name'      => $request->name,
        ]);

        //Attach User as a Teacher
        $classroom->users()->attach(auth()->user(), ['is_teacher' => true]);

        return redirect()->route('dashboard');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        $students = $classroom->students;

        return view('classroom.index', compact('classroom', 'students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'name'  => 'required', 'string', 'max:80'
        ]);

        $classroom->update([
            'name'      => $request->name,
            'section'   => $request->section
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return redirect()->route('classroom.index');
    }

    public function join($code)
    {
        dd($code);
    }
}
