<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!session()->has('user')) {
            return redirect()->route("login.index");
        }
        $user = User::where("id", session()->get('user'))->first();
        return view("profile", compact("user"));
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            "name" => "required",
            "address" => "required",
            "city" => "required",
            "phone" => "required",
            "email" => "required",
        ]);

        $user = User::where('id', session()->get('user'))->first();
        if ($request->has('image')) {
            $file = $request->image;
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profiles'), $image_name);
            if ($user->image != "default.jpg") {
                if (file_exists(public_path("uploads/profiles/{$user->image}"))) {
                    unlink(public_path("uploads/profiles/{$user->image}"));
                }
            }
            $user->update([
                "name" => $request->name,
                "address" => $request->address,
                "city" => $request->city,
                "phone" => $request->phone,
                "email" => $request->email,
                "image" => $image_name,
            ]);
            return redirect()->route('profile')->with('success', 'votre profile à été modifié avec succés.');
        } else {
            $user->update([
                "name" => $request->name,
                "address" => $request->address,
                "city" => $request->city,
                "phone" => $request->phone,
                "email" => $request->email,
            ]);
            return redirect()->route('profile')->with('success', 'votre profile à été modifié avec succés.');
        }
    }
    public function password()
    {
        return view("password");
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            "old_psw" => "required",
            "new_psw" => "required|min:6",
            "c_new_psw" => "min:6|required_with:new_psw|same:new_psw",
        ]);

        $user = User::where('id', session()->get('user'))->first();

        if ($user && password_verify($request->old_psw, $user->password)) {
            if ($request->new_psw === $request->c_new_psw) {
                $user->update([
                    "password" => password_hash($request->new_psw, PASSWORD_DEFAULT)
                ]);
                return redirect()->route('password')->with('success', 'votre mot de passe à été bien modifié.');
            } else {
                return redirect()->back()->withInput()->with('error', '
               le mot de passe et le mot de passe de confirmation ne correspondent pas.');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Ancien mot de passe est incorrect !');
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
