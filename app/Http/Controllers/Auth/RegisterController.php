<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
    public function store(RegisterFormRequest $request)
    {
        $validated = $request->validated();
        $user = User::create($validated);
        auth()->login($user);
        return redirect(route('index'));
    }
}
