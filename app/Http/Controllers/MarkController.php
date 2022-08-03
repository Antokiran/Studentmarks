<?php

namespace App\Http\Controllers;
use App\Models\Marks;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Term;
use DB;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$marks = Marks::orderBy('student_id' , 'asc')        
        //->get();
        $marks = Marks::join('students', 'marks.student_id', '=', 'students.id')
        ->WHERE('students.status',1)       
        ->get(['marks.*', 'students.status']);
         
        $teachers = Teacher::all();
        $students = Student::all();
        
        
        return view('marks.index',compact('students','teachers', 'marks'))->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $students = Student::all()
        ->WHERE('status', '1');
        $terms =  Term::all();
        return view('marks.create',compact('students','terms'));
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
            'student' => 'required',
            'term' => 'required',
            'mark1' => 'required',
            'mark2' => 'required',
            'mark3' => 'required',
            ]);
            $marks = new Marks;
            $maths = $request->mark1;
            $science = $request->mark2;
            $history = $request->mark3;
            $total = $maths+ $science+$history;
            $marks->student_id = $request->student;
            $marks->term_id = $request->term;
            $marks->maths = $request->mark1;
            $marks->science = $request->mark2;
            $marks->history = $request->mark3;
            $marks->total = $total;
            
            $marks->save();
            return redirect()->route('marks.index')
            ->with('success','Marks added successfully.');
    }

    public function ajax(Request $request)
    {
       $id =  $request->id;//id of student

       $student = Student::all();
                  //getting student details with help of id
        
       $terms = Term::select('id','term')->get();//getting all term details

       $termtwo = Term::select('id','term')
                ->WHERE('id',2)->get();//

       $termone = Term::select('id','term')
                ->WHERE('id',1)->get();         
       
       $term1 = Marks::select('term_id', 'student_id')
               ->WHERE('student_id',$id)
               ->WHERE('term_id',1)
               ->get(); 

       $term2 = Marks::select('term_id', 'student_id')
               ->WHERE('student_id',$id)
               ->WHERE('term_id',2)
               ->get();                   
             
        if((!$term1->isEmpty())&&($term2->isEmpty())){
            return response()->json([
                'terms' => $termtwo
           ]);  
        }elseif(($term1->isEmpty())&&(!$term2->isEmpty())){
            return response()->json([
                'terms' => $termone
           ]);  
        }elseif(($term1->isEmpty())&&($term2->isEmpty())){                     
            return response()->json([
                'terms'=> $terms
            ]);            
        } 
        
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
         $marks = Marks::select('id','term_id', 'student_id','history', 'maths', 'science')
                    ->WHERE('id',$id)        
                    ->get();  
         

         $terms = Term::select('id','term')->get();

        return view('marks.edit',compact('marks','terms'));
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
            
            'mark1' => 'required',
            'mark2' => 'required',
            'mark3' => 'required',
            ]);
            $marks = Marks::find($id);
            $maths = $request->mark1;
            $science = $request->mark2;
            $history = $request->mark3;
            $marks->maths = $maths ;
            $marks->science = $science;
            $marks->history = $history;
            $marks->total = $maths+ $science+$history;
           
            $marks->save();
            return redirect()->route('marks.index')
            ->with('success','Marks  updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $marks = Marks::findOrFail($id); 
        
        $marks->delete();
        return redirect()->route('marks.index')
            ->with('success','Term deleted successfully');
    }
}
