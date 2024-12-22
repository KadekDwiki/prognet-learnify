<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $title = "Register Page";
        return view('auth.register', compact("title"));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'telp' => 'required|max:15',
            'role' => 'string',
            'address' => 'required',
            'password' => 'required|min:6'
        ]);

        $validate['password'] = Hash::make($request->password);
        User::create($validate);

        return redirect(route('login'))->with('success', 'register berhasil');
    }
}