@extends('front.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4 ">Quiz Results</h1>
    @if ($quizzes->isEmpty())
    <p class="text-center">No quiz results available.</p>
    @else
    <div class="row justify-content-center">
        <div class="col-md-10">
            <table class="table table-striped my-4">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Submission Period</th>
                        <th>Answers</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quizzes as $quiz)
                    <tr>
                        <td>{{ $quiz->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($quiz->deadline)->format('j F, Y') }}</td>
                        <td>
                            @if ($quiz->answers->isEmpty())
                            <p>No answers submitted for this quiz.</p>
                            @else
                            <ul>
                                @foreach ($quiz->answers as $answer)
                                <li>{{ $answer->user->name }} - {{ $answer->answer }}</li>
                                @endforeach
                            </ul>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection