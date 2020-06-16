<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Student;
use App\EvaluationForm;
use App\EvaluatorList;
use App\EvaluateTeacher;
use App\Faculty;
use App\Question;
use App\EvaluationRating;
use App\Comment;

class StudentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web_student');
    }

    public function index()
    {
        return view('students.home');
    }

    public function evaluation()
    {
        return view('students.evaluation');
    }


    // EDIT INFORMATION

    public function editInfo(Request $request)
    {
        $this->validatorInfo($request->all())->validate();

        $this->editAllInfo($request->all());
    }

    protected function validatorInfo(array $data)
    {
        return Validator::make($data, [
            'fname' => 'required|max:15',
            'mi' => 'nullable|max:15',
            'lname' => 'required|max:15',
            'birthdate' => 'required|max:15',
            'address' => 'required|max:15',
            'contact' => 'nullable|max:15',
            'stu_id' => 'required|max:15',
        ],[
            'fname.required' => 'The first name field is required.',
            'fname.max' => 'The first name may not be greater than 15 characters.',
            'fname.min' => 'The first name must be at least 3 characters.',
            'mi.max' => 'The middle initial may not be greater than 1 characters.',
            'lname.required' => 'The last name field is required.',
            'lname.max' => 'The last name may not be greater than 15 characters.',
            'lname.min' => 'The last name must be at least 3 characters.',
            'stu_id.required' => 'The student id field is required.',
            'stu_id.max' => 'The student id may not be greater than 15 characters.',
       ]);
    }

    protected function editAllInfo(array $data)
    {
        $id = Auth::guard('web_student')->id();
        return Student::where('id', $id)
            ->update([
                'fname' => $data['fname'],
                'mi' => $data['mi'],
                'fname' => $data['fname'],
                'birthdate' => $data['birthdate'],
                'address' => $data['address'],
                'contact' => $data['contact'],
                'stu_id' => $data['stu_id']
        ]);
    }


    // VIEW EVALUATION

    public function evaluationView()
    {
        $evaluations = EvaluationForm::orderBy('id', 'DESC')->get();
        $evaluators = EvaluatorList::orderBy('id', 'DESC')->get();
        $teachers = EvaluateTeacher::orderBy('id', 'DESC')->get();
        $faculties = Faculty::orderBy('id', 'DESC')->get();
        $questions = Question::orderBy('id', 'ASC')->get();
        $ratings = EvaluationRating::orderBy('id', 'ASC')->get();
        $comments = Comment::orderBy('id', 'ASC')->get();

        return response(['evaluations'=>$evaluations,'evaluators'=>$evaluators,'teachers'=>$teachers,'faculties'=>$faculties,'questions'=>$questions,'ratings'=>$ratings,'comments'=>$comments]);
    }



    // LOGOUT

    public function logout()
    {
        auth()->logout();
        return redirect()->route('student.login');
    }

}
