<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontHomeController extends Controller
{
    public function home()
    {
        $quizzes = Quiz::all();
        return view('front.partials.home', compact('quizzes'));
    }

    public function submitQuiz(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return redirect()->back()->with('success', 'Your answers have been submitted successfully.');
    }
}
