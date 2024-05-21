<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Quiz;
use Carbon\Carbon;
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

        $user = Auth::user();

        $dailySubmissions = Answer::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->count();

        if ($dailySubmissions >= 5) {
            return redirect()->back()->with('error', 'You have reached the maximum daily submission limit.');
        }

        $quiz = Quiz::findOrFail($request->quiz_id);

        if (!$quiz->isSubmissionPeriodActive()) {
            return redirect()->back()->with('error', 'Submission period for this quiz has ended.');
        }


        $rules = [
            'username' => 'required|string|max:255',
        ];

        foreach ($request->input('answers') as $quizId => $answers) {
            foreach ($answers as $index => $answer) {
                $rules["answers.$quizId.$index"] = 'required|string|max:255';
            }
        }

        $request->validate($rules);

        $quizAnswers = [];
        foreach ($request->input('answers') as $quizId => $answers) {
            foreach ($answers as $answer) {
                $quizAnswers[] = [
                    'quiz_id' => $quizId,
                    'user_id' => Auth::id(),
                    'username' => $request->input('username'),
                    'answer' => $answer,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        Answer::insert($quizAnswers);
        return redirect()->back()->with('success', 'Your answers have been submitted successfully.');
    }

    // public function listUserAnswers()
    // {
    //     $quizAnswers = Answer::with('quiz', 'user')->get();
    //     return view('front.partials.answers_list', compact('quizAnswers'));
    // }

    public function quizResults()
    {
        // Get quizzes that have answers
        $quizzes = Quiz::has('answers')->with('answers.user')->get();

        return view('front.account.result', compact('quizzes'));
    }
}
