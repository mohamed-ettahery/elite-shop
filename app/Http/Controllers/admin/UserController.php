<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where("is_admin", 0)->get();
        return view("admin.users.index", compact('users'));
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
        if ($user->image != "default.jpg") {
            if (file_exists(public_path("uploads/profiles/{$user->image}")) && $user->image != "default.jpg") {
                unlink(public_path("uploads/profiles/{$user->image}"));
            }
        }
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'utilisateur à été supprimé avec succés.');
    }
}
