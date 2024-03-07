<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        if (session()->has('admin')) {
            return redirect('/owner');
        }
        if (session()->has('user')) {
            return redirect()->route('home');
        }
        return view("login");
    }
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if ($user && password_verify($password, $user->password)) {
            if ($user->is_admin) {
                session(['admin' => $user->id]);
                return redirect()->intended('/owner');
            } else {
                session(['user' => $user->id]);
                return redirect()->intended('/');
            }
        } else {
            return back()->withInput()->with('error', 'Email ou mot de passe invalide.');
        }
    }
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'city' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'password' => 'min:6',
        ]);
        $user = User::create([
            "name" => $request->name,
            "city" => $request->city,
            "address" => $request->address,
            "phone" => $request->phone,
            "email" => $request->email,
            "password" => password_hash($request->password, PASSWORD_DEFAULT)
        ]);
        session(['user' => $user->id]);
        return redirect()->route('home')
            ->with('success', 'votre compte à été creé avec succés.');
    }
    public function logOut()
    {
        Session::flush();
        return redirect()->route('login.index');
    }
}
