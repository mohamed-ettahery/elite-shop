<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsletters = Subscriber::all();
        return view("admin.newsletters.index", compact('newsletters'));
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
    public function show(Subscriber $subscriber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscriber $subscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscriber $subscriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Subscriber $subscriber)
    public function destroy($subscriber)
    {
        $subscriber = Subscriber::find($subscriber);
        if ($subscriber->delete()) {
            return redirect()->route('newsletters.index')
                ->with('success', 'Newsletter à été supprimé avec succés.');
        }
    }
}
