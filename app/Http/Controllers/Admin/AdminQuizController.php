<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
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
        return response()->json([
            'status' => true,
            'message' => 'Quiz created successfully'
        ]);
    }

    // public function show(Quiz $quiz)
    // {
    //     $answers = $quiz->answers()->with('user')->get();
    //     return view('admin.quizzes.show', compact('quiz', 'answers'));
    // }

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
                ->rawColumns(['image1', 'image2'])
                ->make(true);
        }

        return view('admin.list');
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
