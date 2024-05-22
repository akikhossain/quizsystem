<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AdminQuizController extends Controller
{
    public function create()
    {
        return view('admin.dashboard');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif',
            'deadline' => 'required|date'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('images');
            }
        }

        $quiz = new Quiz();
        $quiz->image1 = $imagePaths[0] ?? null;
        $quiz->image2 = $imagePaths[1] ?? null;
        $quiz->deadline = $request->deadline;
        $quiz->save();

        session()->flash('success', 'Quiz created successfully');
        return redirect()->route('admin.list');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $quizzes = Quiz::all();
            return DataTables::of($quizzes)
                ->editColumn('image1', function ($quiz) {
                    return '<img src="' . asset($quiz->image1) . '" width="100" height="100">';
                })
                ->editColumn('image2', function ($quiz) {
                    return '<img src="' . asset($quiz->image2) . '" width="100" height="100">';
                })
                ->editColumn('deadline', function ($quiz) {
                    return \Carbon\Carbon::parse($quiz->deadline)->format('d M, Y');
                })
                ->addColumn('current_date', function () {
                    return \Carbon\Carbon::now()->format('d M, Y');
                })
                ->addColumn('action', function ($quiz) {
                    return '<a href="' . route('admin.quiz-result', $quiz->id) . '" class="btn btn-primary btn-sm">View Answer</a>
                            <a href="#" class="btn btn-success btn-sm">Import</a>
                            <a href="#" class="btn btn-warning btn-sm">Export</a>';
                })


                ->rawColumns(['image1', 'image2', 'action'])
                ->make(true);
        }

        return view('admin.list');
    }

    public function quizResult($quizId)
    {

        $quiz = Quiz::findOrFail($quizId);
        $answers = Answer::where('quiz_id', $quizId)->with('user')->paginate(4);

        return view('admin.quiz-answer', compact('quiz', 'answers'));
    }


    public function quizBestAnswers($quizId)
    {
        $quiz = Quiz::findOrFail($quizId);

        // Get the answers along with their counts, grouped by the answer text
        $bestAnswers = Answer::where('quiz_id', $quizId)
            ->select('answer', \DB::raw('count(*) as total'))
            ->groupBy('answer')
            ->orderBy('total', 'desc')
            ->get();

        return view('admin.quiz-best-answers', compact('quiz', 'bestAnswers'));
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
