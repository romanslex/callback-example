<?php

namespace App\Http\Controllers\Data;

use App\Mail\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function SendComment(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:100',
            "msg" => "required|max:1000"
        ]);

        $title = $validatedData["title"];
        $msg = $validatedData["msg"];

        Mail::to("romanslex@gmail.com")
            ->send(new Feedback($title, $msg));
        return [];
    }
}
