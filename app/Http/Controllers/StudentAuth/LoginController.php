<?php

namespace App\Http\Controllers\StudentAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/student/home';

    public function __construct()
    {
        $this->middleware('guest:web_student')->except('logout');
    }

    public function showLoginForm()
    {
        return view('students.login');
    }

    public function login(Request $request)
    {
        $this->validate($request,
            [
            'stu_id' => 'required|exists:students',
            'password' => 'required|min:6'
            ],[
                'stu_id.required' => 'The student id field is required.',
                'stu_id.exists' => 'The student id is not registered in the system.',
           ]);

        if (Auth::guard('web_student')->attempt(['stu_id' => $request->stu_id,
        'password' => $request->password], $request->remember))
        {
            return redirect()->intended(route('student.home'));
        }

        return redirect()->back()->withInput($request->only('stu_id', 'remember'));
    }
}
