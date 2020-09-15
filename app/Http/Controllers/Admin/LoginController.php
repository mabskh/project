<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
     public function getLogin(){
        return view('admin.auth.login');
     }

    public function save()
    {

        $admin = new App\Models\Admin();
        $admin->name = "admin";
        $admin->email = "admin@admin.com";
        $admin->password = bcrypt("123456");
        $admin->save();

    }

    public function login(LoginRequest $request)
    {
        // Validation from Login controller
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            // notify()->success('تم الدخول بنجاح  ');
            return redirect()->route('admin.dashboard');
        }
        // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
        return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);
    }

    public function logout()
    {
        $gaurd = $this->getGaurd();
        $gaurd->logout();
        return redirect()->route('admin.login');
    }

    private function getGaurd()
    {
        return auth('admin');
    }



}
