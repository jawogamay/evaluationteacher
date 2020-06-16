<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Admin;
use App\Student;
use App\Faculty;
use App\Department;
use App\Position;
use App\Section;
use App\AcademicYear;
use App\Semester;
use App\Question;
use App\StudentEvaluate;
use App\EvaluationForm;
use App\QuestionInForm;
use App\EvaluatorList;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web_admin');
    }

    public function index()
    {
        return view('admins.home');
    }

    public function user()
    {
        return view('admins.user');
    }

    public function evaluation()
    {
        return view('admins.evaluation');
    }

    public function school()
    {
        return view('admins.school');
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
            'fname' => 'required|min:3|max:15',
            'lname' => 'required|min:3|max:15',
        ],[
            'fname.required' => 'The first name field is required.',
            'fname.max' => 'The first name may not be greater than 15 characters.',
            'fname.min' => 'The first name must be at least 3 characters.',
            'lname.required' => 'The last name field is required.',
            'lname.max' => 'The last name may not be greater than 15 characters.',
            'lname.min' => 'The last name must be at least 3 characters.'
       ]);
    }

    protected function editAllInfo(array $data)
    {
        $id = Auth::guard('web_admin')->id();
        return Admin::where('id', $id)
            ->update([
                'fname' => $data['fname'],
                'lname' => $data['lname'],
        ]);
    }


    // CHANGE USERNAME

    public function changeUsername(Request $request)
    {
        $this->validatorUsername($request->all())->validate();

        $this->changeAllUsername($request->all());
    }

    protected function validatorUsername(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:20|unique:admins'
        ]);
    }

    protected function changeAllUsername(array $data)
    {
        $id = Auth::guard('web_admin')->id();
        return Admin::where('id', $id)
            ->update([
                'username' => $data['username'],
        ]);
    }


    // CHANGE PASSWORD

    public function changePassword(Request $request)
    {
        $this->validatorPassword($request->all())->validate();

        $this->changeAllPassword($request->all());
    }

    protected function validatorPassword(array $data)
    {
        return Validator::make($data, [
            'password' => 'required|min:6|max:30|confirmed',
        ]);
    }

    protected function changeAllPassword(array $data)
    {
        $id = Auth::guard('web_admin')->id();
        return Admin::where('id', $id)
            ->update([
                'password' => bcrypt($data['password']),
        ]);
    }



    // View Student

    public function studentView()
    {
        $sections = Section::all();
        $students = Student::all();
        return response(['students'=>$students,'sections'=>$sections]);
    }

    // STUDENT CREATE

    public function studentCreate(Request $request)
    {
        $this->validatorStudent($request->all())->validate();

        $this->allStudent($request->all());

    }

    protected function validatorStudent(array $data)
    {
        return Validator::make($data, [
            'fname' => 'required|max:15|min:3',
            'mi' => 'nullable|max:1',
            'lname' => 'required|max:15|min:3',
            'birthdate' => 'required|date',
            'address' => 'required|max:75|min:10',
            'contact' => 'nullable|max:15|min:11',
            'stu_id' => 'required|max:15|unique:students',
            'sec_id' => 'required',
            'password' => 'required|min:6|max:30',
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
            'stu_id.unique' => 'The student id has already been taken.',
            'sec_id.required' => 'The section field is required.',
       ]);
    }

    protected function allStudent(array $data)
    {
        Student::create([
        'fname' => $data['fname'],
        'mi' => $data['mi'],
        'lname' => $data['lname'],
        'birthdate' => $data['birthdate'],
        'address' => $data['address'],
        'contact' => $data['contact'],
        'stu_id' => $data['stu_id'],
        'sec_id' => $data['sec_id'],
        'password' => bcrypt($data['password'])
        ]);
    }

    // STUDENT UPDATE

    public function studentUpdate(Request $request)
    {
        $this->studentUpdateValidator($request->all())->validate();

        $this->studentAllUpdate($request->all());
    }

    protected function studentUpdateValidator(array $data)
    {
        return Validator::make($data, [
            'fname' => 'required|max:15|min:3',
            'mi' => 'nullable|max:1',
            'lname' => 'required|max:15|min:3',
            'birthdate' => 'required|date',
            'address' => 'required|max:75|min:10',
            'contact' => 'nullable|max:15|min:11',
            'stu_id' => 'required|max:15',
            'sec_id' => 'required',
            'password' => 'nullable|min:6|max:30',
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
            'stu_id.unique' => 'The student id has already been taken.',
            'sec_id.required' => 'The section field is required.',
       ]);
    }


    protected function studentAllUpdate(array $data)
    {
        Student::where('id', $data['id'])
            ->update([
                'stu_id' => $data['stu_id'],
                'fname' => $data['fname'],
                'mi' => $data['mi'],
                'lname' => $data['lname'],
                'birthdate' => $data['birthdate'],
                'address' => $data['address'],
                'contact' => $data['contact'],
                'sec_id' => $data['sec_id'],
                'password' => bcrypt($data['password'])
            ]);
    }

    // DELETE STUDENT

    public function studentDelete(Request $request)
    {
        $id = $request->id;

        $students = Student::findOrFail($id);
        $students->delete();

        return $students;
    }




    // VIEW FACULTY

    public function facultyView()
    {
        $faculties = Faculty::all();
        $positions = Position::all();
        return response(['faculties'=>$faculties, 'positions'=>$positions]);
    }


    // FACULTY CREATE

    public function facultyCreate(Request $request)
    {
        $this->validatorFaculty($request->all())->validate();

        $this->allFaculty($request->all());

    }

    protected function validatorFaculty(array $data)
    {
        return Validator::make($data, [
            'fname' => 'required|max:15|min:3',
            'mi' => 'nullable|max:1',
            'lname' => 'required|max:15|min:3',
            'birthdate' => 'required|date',
            'address' => 'required|max:75|min:10',
            'contact' => 'nullable|max:15|min:11',
            'username' => 'required|max:20|unique:faculties',
            'pos_id' => 'required',
            'password' => 'required|min:6|max:30',
        ],[
            'fname.required' => 'The first name field is required.',
            'fname.max' => 'The first name may not be greater than 15 characters.',
            'fname.min' => 'The first name must be at least 3 characters.',
            'mi.max' => 'The middle initial may not be greater than 1 characters.',
            'lname.required' => 'The last name field is required.',
            'lname.max' => 'The last name may not be greater than 15 characters.',
            'lname.min' => 'The last name must be at least 3 characters.',
            'pos_id.required' => 'The position field is required.'
       ]);
    }

    protected function allFaculty(array $data)
    {
        Faculty::create([
        'fname' => $data['fname'],
        'mi' => $data['mi'],
        'lname' => $data['lname'],
        'birthdate' => $data['birthdate'],
        'address' => $data['address'],
        'contact' => $data['contact'],
        'username' => $data['username'],
        'pos_id' => $data['pos_id'],
        'password' => bcrypt($data['password'])
        ]);
    }

    // FACULTY UPDATE

    public function facultyUpdate(Request $request)
    {
        $this->facultyUpdateValidator($request->all())->validate();

        $this->facultyAllUpdate($request->all());
    }

    protected function facultyUpdateValidator(array $data)
    {
        return Validator::make($data, [
            'fname' => 'required|max:15|min:3',
            'mi' => 'nullable|max:1',
            'lname' => 'required|max:15|min:3',
            'birthdate' => 'required|date',
            'address' => 'required|max:75|min:10',
            'contact' => 'nullable|max:15|min:11',
            'username' => 'required|max:20',
            'pos_id' => 'required',
            'password' => 'nullable|min:6|max:30',
        ],[
            'fname.required' => 'The first name field is required.',
            'fname.max' => 'The first name may not be greater than 15 characters.',
            'fname.min' => 'The first name must be at least 3 characters.',
            'mi.max' => 'The middle initial may not be greater than 1 characters.',
            'lname.required' => 'The last name field is required.',
            'lname.max' => 'The last name may not be greater than 15 characters.',
            'lname.min' => 'The last name must be at least 3 characters.',
            'pos_id.required' => 'The position field is required.'
       ]);
    }


    protected function facultyAllUpdate(array $data)
    {
        Faculty::where('id', $data['id'])
            ->update([
                'username' => $data['username'],
                'pos_id' => $data['pos_id'],
                'fname' => $data['fname'],
                'mi' => $data['mi'],
                'lname' => $data['lname'],
                'birthdate' => $data['birthdate'],
                'address' => $data['address'],
                'contact' => $data['contact'],
                'password' => bcrypt($data['password'])
            ]);
    }

    // DELETE FACULTY

    public function facultyDelete(Request $request)
    {
        $id = $request->id;

        Faculty::where('id', $id)
        ->delete();
    }


    // VIEW SCHOOL

    public function schoolView()
    {
        $departments = Department::all();
        $positions = Position::all();
        $sections = Section::all();
        $academic_years = AcademicYear::all();
        $semesters = Semester::all();
        return response(['departments'=>$departments,'sections'=>$sections, 'positions'=>$positions, 'academic_years' => $academic_years, 'semesters' => $semesters]);
    }

    // DEPARTMENT CREATE

    public function departmentCreate(Request $request)
    {
        $this->validatorDepartment($request->all())->validate();

        $this->allDepartment($request->all());

    }

    protected function validatorDepartment(array $data)
    {
        return Validator::make($data, [
            'dept_code' => 'required|min:3|max:10|unique:departments',
            'dept_name' => 'required|min:3|max:75|unique:departments',
            'dept_desc' => 'required|min:6|max:100|unique:departments',
        ],[
            'dept_code.required' => 'The code field is required.',
            'dept_code.max' => 'The code may not be greater than 10 characters.',
            'dept_code.min' => 'The code must be at least 3 characters.',
            'dept_code.unique' => 'The code has already been taken.',
            'dept_name.required' => 'The department name field is required.',
            'dept_name.max' => 'The department name may not be greater than 75 characters.',
            'dept_name.min' => 'The department name must be at least 3 characters.',
            'dept_name.unique' => 'The department name has already been taken.',
            'dept_desc.required' => 'The description field is required.',
            'dept_desc.max' => 'The description may not be greater than 100 characters.',
            'dept_desc.min' => 'The description must be at least 6 characters.',
            'dept_desc.unique' => 'The description has already been taken.',
       ]);
    }

    protected function allDepartment(array $data)
    {
        Department::create([
        'dept_code' => $data['dept_code'],
        'dept_name' => $data['dept_name'],
        'dept_desc' => $data['dept_desc']
        ]);
    }

    // DEPARTMENT UPDATE

    public function departmentUpdate(Request $request)
    {
        $this->departmentUpdateValidator($request->all())->validate();

        $this->departmentAllUpdate($request->all());
    }

    protected function departmentUpdateValidator(array $data)
    {
        return Validator::make($data, [
            'dept_code' => 'required|min:3|max:10',
            'dept_name' => 'required|min:3|max:75',
            'dept_desc' => 'required|min:6|max:100',
        ],[
            'dept_code.required' => 'The code field is required.',
            'dept_code.max' => 'The code may not be greater than 10 characters.',
            'dept_code.min' => 'The code must be at least 3 characters.',
            'dept_name.required' => 'The department name field is required.',
            'dept_name.max' => 'The department name may not be greater than 75 characters.',
            'dept_name.min' => 'The department name must be at least 3 characters.',
            'dept_desc.required' => 'The description field is required.',
            'dept_desc.max' => 'The description may not be greater than 100 characters.',
            'dept_desc.min' => 'The description must be at least 6 characters.',
       ]);
    }


    protected function departmentAllUpdate(array $data)
    {
        Department::where('id', $data['id'])
            ->update([
                'dept_code' => $data['dept_code'],
                'dept_name' => $data['dept_name'],
                'dept_desc' => $data['dept_desc']
            ]);
    }

    // DELETE DEPARTMENT

    public function departmentDelete(Request $request)
    {
        $id = $request->id;

        Department::where('id', $id)
        ->delete();
    }



    // POSITION CREATE

    public function positionCreate(Request $request)
    {
        $this->validatorPosition($request->all())->validate();

        $this->allPosition($request->all());

    }

    protected function validatorPosition(array $data)
    {
        return Validator::make($data, [
            'pos_name' => 'required|min:3|max:10|unique:positions',
        ],[
            'pos_name.required' => 'The position name field is required.',
            'pos_name.max' => 'The position name may not be greater than 10 characters.',
            'pos_name.min' => 'The position name must be at least 3 characters.',
            'pos_name.unique' => 'The position name has already been taken.'
       ]);
    }

    protected function allPosition(array $data)
    {
        Position::create([
        'pos_name' => $data['pos_name']
        ]);
    }

    // POSITION UPDATE

    public function positionUpdate(Request $request)
    {
        $this->positionUpdateValidator($request->all())->validate();

        $this->positionAllUpdate($request->all());
    }

    protected function positionUpdateValidator(array $data)
    {
        return Validator::make($data, [
            'pos_name' => 'required|min:3|max:10',
        ],[
            'pos_name.required' => 'The position name field is required.',
            'pos_name.max' => 'The position name may not be greater than 10 characters.',
            'pos_name.min' => 'The position name must be at least 3 characters.',
       ]);
    }


    protected function positionAllUpdate(array $data)
    {
        Position::where('id', $data['id'])
            ->update([
                'pos_name' => $data['pos_name']
            ]);
    }

    // DELETE POSITION

    public function positionDelete(Request $request)
    {
        $id = $request->id;

        Position::where('id', $id)
        ->delete();
    }

    // SECTION CREATE

    public function sectionCreate(Request $request)
    {
        $this->validatorSection($request->all())->validate();

        $this->allSection($request->all());

    }

    protected function validatorSection(array $data)
    {
        return Validator::make($data, [
            'sec_code' => 'required|min:3|max:10|unique:sections',
        ],[
            'sec_code.required' => 'The section code field is required.',
            'sec_code.max' => 'The section code may not be greater than 10 characters.',
            'sec_code.min' => 'The section code must be at least 3 characters.',
            'sec_code.unique' => 'The section code has already been taken.'
       ]);
    }

    protected function allSection(array $data)
    {
        Section::create([
        'sec_code' => $data['sec_code']
        ]);
    }

    // SECTION UPDATE

    public function sectionUpdate(Request $request)
    {
        $this->sectionUpdateValidator($request->all())->validate();

        $this->sectionAllUpdate($request->all());
    }

    protected function sectionUpdateValidator(array $data)
    {
        return Validator::make($data, [
            'sec_code' => 'required|min:3|max:10',
        ],[
            'sec_code.required' => 'The section code field is required.',
            'sec_code.max' => 'The section code may not be greater than 10 characters.',
            'sec_code.min' => 'The section code must be at least 3 characters.',
       ]);
    }


    protected function sectionAllUpdate(array $data)
    {
        Section::where('id', $data['id'])
            ->update([
                'sec_code' => $data['sec_code']
            ]);
    }

    // DELETE SECTION

    public function sectionDelete(Request $request)
    {
        $id = $request->id;

        Section::where('id', $id)
        ->delete();
    }

    // ACADEMIC CREATE

    public function academicCreate(Request $request)
    {
        $this->validatorAcademic($request->all())->validate();

        $this->allAcademic($request->all());

    }

    protected function validatorAcademic(array $data)
    {
        return Validator::make($data, [
            'year_start' => 'required|numeric|min:3',
            'year_end' => 'required|numeric|min:3'
        ],[
            'year_start.numeric' => 'The year start must be a year.',
            'year_end.numeric' => 'The year end must be a year.',
       ]);
    }

    protected function allAcademic(array $data)
    {
        AcademicYear::create([
            'year_start' => $data['year_start'],
            'year_end' => $data['year_end']
        ]);
    }

    // ACADEMIC UPDATE

    public function academicUpdate(Request $request)
    {
        $this->academicUpdateValidator($request->all())->validate();

        $this->academicAllUpdate($request->all());
    }

    protected function academicUpdateValidator(array $data)
    {
        return Validator::make($data, [
            'year_start' => 'required|numeric|min:3',
            'year_end' => 'required|numeric|min:3'
        ],[
            'year_start.numeric' => 'The year start must be a year.',
            'year_end.numeric' => 'The year end must be a year.',
       ]);
    }


    protected function academicAllUpdate(array $data)
    {
        AcademicYear::where('id', $data['id'])
        ->update([
            'year_start' => $data['year_start'],
            'year_end' => $data['year_end']
        ]);
    }

    // DELETE ACADEMIC

    public function academicDelete(Request $request)
    {
        $id = $request->id;

        AcademicYear::where('id', $id)
        ->delete();
    }

    // SEMESTER CREATE

    public function semesterCreate(Request $request)
    {
        $this->validatorSemester($request->all())->validate();

        $this->allSemester($request->all());

    }

    protected function validatorSemester(array $data)
    {
        return Validator::make($data, [
            'sem_name' => 'required|min:3|max:30',
        ]);
    }

    protected function allSemester(array $data)
    {
        Semester::create([
            'sem_name' => $data['sem_name']
        ]);
    }

    // SEMESTER UPDATE

    public function semesterUpdate(Request $request)
    {
        $this->semesterUpdateValidator($request->all())->validate();

        $this->semesterAllUpdate($request->all());
    }

    protected function semesterUpdateValidator(array $data)
    {
        return Validator::make($data, [
            'sem_name' => 'required|min:3|max:30',
        ]);
    }


    protected function semesterAllUpdate(array $data)
    {
        Semester::where('id', $data['id'])
        ->update([
            'sem_name' => $data['sem_name']
        ]);
    }

    // DELETE SEMESTER

    public function semesterDelete(Request $request)
    {
        $id = $request->id;

        Semester::where('id', $id)
        ->delete();
    }



    // EVALUATION

    public function evaluationView()
    {
        $questions = Question::orderBy('id', 'DESC')->get();
        $evaluations = EvaluationForm::orderBy('id', 'DESC')->get();
        $questionforms = QuestionInForm::orderBy('id', 'DESC')->get();
        $evaluators = EvaluatorList::orderBy('id', 'DESC')->get();
        $students = Student::all();
        $faculties = Faculty::all();

        return response(['questions'=>$questions, 'evaluations'=>$evaluations, 'questionforms'=>$questionforms,
        'students'=>$students, 'faculties'=>$faculties, 'evaluators'=>$evaluators]);
    }

    // QUESTION CREATE

    protected function questionCreate(Request $request)
    {
        $this->validate($request, [
            'ques_category' => 'required',
            'ques_statement' => 'required|min:6|max:250',
        ],
        [
            'ques_category.require' => 'The question category field is required.',
            'ques_statement.required' => 'The question statement field is required.',
            'ques_statement.min' => 'The question statement must be at least 6 characters.',
            'ques_statement.max' => 'The question statement may not be greater than 100 characters.',
        ]);

            $questions = new Question;
            $questions->ques_category = $request->ques_category;
            $questions->ques_statement = $request->ques_statement;
            $questions->save();

        return $questions;
    }

    // QUESTION UPDATE

    public function questionUpdate(Request $request)
    {
        $this->questionUpdateValidator($request->all())->validate();

        $this->questionAllUpdate($request->all());
    }

    protected function questionUpdateValidator(array $data)
    {
        return Validator::make($data, [
            'ques_category' => 'required',
            'ques_statement' => 'required|min:6|max:250',
        ],
        [
            'ques_category.require' => 'The question category field is required.',
            'ques_statement.required' => 'The question statement field is required.',
            'ques_statement.min' => 'The question statement must be at least 6 characters.',
            'ques_statement.max' => 'The question statement may not be greater than 100 characters.',
        ]);
    }


    protected function questionAllUpdate(array $data)
    {
        Question::where('id', $data['id'])
        ->update([
            'ques_category' => $data['ques_category'],
            'ques_statement' => $data['ques_statement'],
        ]);
    }

    // DELETE SEMESTER

    public function questionDelete(Request $request)
    {
        $id = $request->id;

        Question::where('id', $id)
        ->delete();
    }

    // EVALUATION FORM CREATE

    protected function evaluationCreate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3|max:50',
            'type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

            $evaluations = new EvaluationForm;
            $evaluations->title = $request->title;
            $evaluations->type = $request->type;
            $evaluations->start_date = $request->start_date;
            $evaluations->end_date = $request->end_date;
            $evaluations->save();

        return $evaluations;
    }

    // EVALUATION FORM UPDATE

    protected function evaluationUpdate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:3|max:50'
        ]);

            $evaluations = EvaluationForm::find($request->id);
            $evaluations->title = $request->title;
            $evaluations->save();

        return $evaluations;
    }

    // EVALUATION SET PERIOD

    protected function setPeriod(Request $request)
    {
        $this->validate($request, [
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

            $evaluations = EvaluationForm::find($request->id);
            $evaluations->start_date = $request->start_date;
            $evaluations->end_date = $request->end_date;
            $evaluations->save();

        return $evaluations;
    }

    // DELETE EVALUATION

    public function evaluationDelete(Request $request)
    {
        $id = $request->id;

        EvaluationForm::where('id', $id)
        ->delete();
    }

    // QUESTION FORM CREATE

    protected function questionformCreate(Request $request)
    {
        $this->validate($request, [
            'ques_id' => 'required',
        ]);

            $questionforms = new QuestionInForm;
            $questionforms->form_id = $request->form_id;
            $questionforms->ques_id = $request->ques_id;
            $questionforms->save();

        return $questionforms;
    }

    // DELETE QUESTION FORM

    public function questionformDelete(Request $request)
    {
        $id = $request->id;

        QuestionInForm::where('id', $id)
        ->delete();
    }


    // STUDENT EVALUATOR CREATE

    protected function studentEvaluatorCreate(Request $request)
    {
        $this->validate($request, [
            'student_id' => 'required|numeric',
        ]);

            $evaluators = new StudentEvaluate;
            $evaluators->form_id = $request->id;
            $evaluators->student_id = $request->student_id;
            $evaluators->save();

        return $evaluators;
    }

    // FACULTY EVALUATOR CREATE

    protected function facultyEvaluatorCreate(Request $request)
    {
        $this->validate($request, [
            'faculty_id' => 'required|numeric',
        ]);

            $evaluators = new EvaluatorList;
            $evaluators->form_id = $request->id;
            $evaluators->faculty_id = $request->faculty_id;
            $evaluators->save();

        return $evaluators;
    }

    // DELETE EVALUATION

    public function evaluatorDelete(Request $request)
    {
        $id = $request->id;

        $evaluators = EvaluatorList::findOrFail($id);
        $evaluators->delete();

        return $evaluators;
    }


    // LOGOUT

    public function logout()
    {
        auth()->logout();
        return redirect()->route('admin.login');
    }

}
