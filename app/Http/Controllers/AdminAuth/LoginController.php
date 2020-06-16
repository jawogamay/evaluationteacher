<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/admin/home';

    public function __construct()
    {
        $this->middleware('guest:web_admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admins.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|exists:admins',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('web_admin')->attempt(['username' => $request->username,
        'password' => $request->password], $request->remember))
        {
            return redirect()->intended(route('admin.home'));
        }

        return redirect()->back()->withInput($request->only('username', 'remember'));
    }
}
