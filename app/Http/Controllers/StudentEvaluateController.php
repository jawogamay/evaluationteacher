<?php

namespace App\Http\Controllers;

use App\StudentEvaluate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\QuestionInForm;
use App\Faculty;
use App\TeacherEvaluation;
use App\QuestionRating;
class StudentEvaluateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:web_student');
    }
    public function index()
    {
        //
        
        return StudentEvaluate::where('student_id',Auth::guard('web_student')->id())->with('studentevaluate')->whereHas('studentevaluate', function($q) {
            $q->whereDate('start_date','<=',NOW());
            $q->whereDate('end_date','>',NOW());
        })->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        

        $data = $this->validate($request,[
            'ratingss' => 'required|array',
            'ratingss.*.question_num' => 'required',
            'ratingss.*.rates' => 'required'

        ]);
        
        foreach($data['ratingss'] as $rates){
            QuestionRating::create([
                'form_id' => $request['form_id'],
                'question_number' => $rates['question_num'],
                'rate' => $rates['rates']

            ]);
        } 

        TeacherEvaluation::create([
            'student_id' => Auth::guard('web_student')->id(),
            'form_id' => $request['form_id'],
            'teacher_id' => $request['teacher_id']

        ]);
        return 'Success';

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentEvaluate  $studentEvaluate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return QuestionInForm::where('form_id',$id)->with('questionaires')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentEvaluate  $studentEvaluate
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentEvaluate $studentEvaluate)
    {
        //
    }
    public function getTeachers(){
        return Faculty::where('pos_id',1)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentEvaluate  $studentEvaluate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentEvaluate $studentEvaluate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentEvaluate  $studentEvaluate
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentEvaluate $studentEvaluate)
    {
        //
    }
}
