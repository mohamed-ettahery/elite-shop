<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::where("is_admin", 1)->get();
        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'image' => 'required',
            'password' => 'min:6',
            'c_password' => 'min:6|required_with:password|same:password'
        ]);
        if ($request->has('image')) {
            $file = $request->image;
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profiles'), $image_name);
            $image = $image_name;
        }
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "image" => $image,
            "is_admin" => 1,
            "password" =>  password_hash($request->password, PASSWORD_DEFAULT)
        ]);

        return redirect()->route('admins.index')
            ->with('success', 'Admin à été ajouté avec succés.');
    }

    public function adminProfile()
    {
        if (!session()->has('admin')) {
            return redirect()->route("login.index");
        }
        $user = User::where("id", session()->get('admin'))->first();
        return view("admin.profile", compact("user"));
    }
    public function updateAdminProfile(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required",
        ]);

        $user = User::where('id', session()->get('admin'))->first();
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
                "email" => $request->email,
                "image" => $image_name,
            ]);
            return redirect()->route('adminProfile')->with('success', 'votre profile à été modifié avec succés.');
        } else {
            $user->update([
                "name" => $request->name,
                "email" => $request->email,
            ]);
            return redirect()->route('adminProfile')->with('success', 'votre profile à été modifié avec succés.');
        }
    }
    public function adminPassword()
    {
        return view("admin.password");
    }
    public function updateAdminPassword(Request $request)
    {
        $request->validate([
            "old_psw" => "required",
            "new_psw" => "required|min:6",
            "c_new_psw" => "min:6|required_with:new_psw|same:new_psw",
        ]);

        $user = User::where('id', session()->get('admin'))->first();

        if ($user && password_verify($request->old_psw, $user->password)) {
            if ($request->new_psw === $request->c_new_psw) {
                $user->update([
                    "password" => password_hash($request->new_psw, PASSWORD_DEFAULT)
                ]);
                return redirect()->route('adminPassword')->with('success', 'votre mot de passe à été bien modifié.');
            } else {
                return redirect()->back()->withInput()->with('error', '
               le mot de passe et le mot de passe de confirmation ne correspondent pas.');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Ancien mot de passe est incorrect !');
        }
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
    public function edit(User $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $admin)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        if ($request->has('image')) {
            $file = $request->image;
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profiles'), $image_name);
            if (file_exists(public_path("uploads/profiles/{$admin->image}"))) {
                unlink(public_path("uploads/profiles/{$admin->image}"));
            }
            $image = $image_name;
        } else {
            $image = $request->old_img;
        }
        $admin->update([
            "name" => $request->name,
            "email" => $request->email,
            "image" => $image
        ]);

        return redirect()->route('admins.index')
            ->with('success', 'Admin à été modifié avec succés.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {
        if (file_exists(public_path("uploads/profiles/{$admin->image}")) && $admin->image != "default.jpg") {
            unlink(public_path("uploads/profiles/{$admin->image}"));
        }
        $admin->delete();

        return redirect()->route('admins.index')
            ->with('success', 'Admin à été supprimé avec succés.');
    }
}
