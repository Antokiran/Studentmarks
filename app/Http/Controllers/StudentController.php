<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Term;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function home()
    {
        return view('students.home');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::latest()
        ->WHERE('status', '1')
        ->paginate(5);
        return view('students.index',compact('students'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::all();
        return view('students.create',compact('teachers'));

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
            'name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'teacher' => 'required',
            ]);
            $student = new Student;
            $student->name = $request->name;
            $student->age = $request->age;
            $student->gender = $request->gender;
            $student->teacher_id = $request->teacher;
            $student->status = "1";
            $student->save();
            return redirect()->route('students.index')
            ->with('success','Student has been created successfully.');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::select('*')
            ->WHERE('id',$id)
            ->get();
            
        $teachers = Teacher::all();
        
        return view('students.edit',compact('student','teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        
        $request->validate([
            'name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'teacher' => 'required',
            ]);
            $student = Student::find($id);
            $student->name = $request->name;
            $student->age = $request->age;
            $student->gender = $request->gender;
            $student->save();
            return redirect()->route('students.index')
            ->with('success','Student Has Been updated successfully');
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->status = '0';
        $student->save();
        
        return redirect()->route('students.index')
            ->with('success','Student Has Been deleted successfully');
    }
}
