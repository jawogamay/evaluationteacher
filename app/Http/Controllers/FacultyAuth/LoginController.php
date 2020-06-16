<?php

namespace App\Http\Controllers\FacultyAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/faculty/home';

    public function __construct()
    {
        $this->middleware('guest:web_faculty')->except('logout');
    }

    public function showLoginForm()
    {
        return view('faculties.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|exists:faculties',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('web_faculty')->attempt(['username' => $request->username,
        'password' => $request->password], $request->remember))
        {
            return redirect()->intended(route('faculty.home'));
        }

        return redirect()->back()->withInput($request->only('username', 'remember'));
    }
}
