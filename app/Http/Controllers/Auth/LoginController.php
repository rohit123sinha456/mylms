<?php

namespace App\Http\Controllers\Auth;

use App\Models\Teacher;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:2'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            session(['admin' => bcrypt('admin')]);
            return redirect('/admin/login');
        }
        return redirect('/');
    }
    public function showadminLogin(Request $request){
        $teacher = Teacher::all();
        return view('admin',['teacher'=>$teacher]);
    }
    /*
    public function teacherLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:2'
        ]);

        if (Auth::guard('teacher')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return view('teacher');
        }
        return redirect()->route('login');
    }
    public function studentLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:2'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return view('student');
        }
        return redirect()->route('login');
    }*/
}

