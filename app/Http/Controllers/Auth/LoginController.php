<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(LoginFormRequest $request)
    {
        $validated = $request->validated();

        if(auth()->attempt($validated)) {
            if(auth()->user()->role === 'admin') {
                return redirect(route('admin.index'));
            }
            return redirect(route('index'));
        }

        return back()->with([
            'incorrectData' => 'Пользователь не найден'
        ])->withInput();
    }

    public function logout()
    {
        auth()->logout();
        return redirect(route('index'));
    }
}
