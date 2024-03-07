<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $email = $request->input('email');
        Subscriber::create(['email' => $email]);
        return response()->json(['message' => 'Email subscribed successfully!']);
    }
    public function destroy($id)
    {
        $subscriber = Subscriber::where("id", $id)->first();
        $subscriber->delete();
    }
}
