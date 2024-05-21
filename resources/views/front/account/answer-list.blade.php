@extends('front.app')
@section('content')
<div class="container mt-5">
    <h2>User Answers</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Username</th>
                <th>Answer</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quizAnswers as $answer)
            <tr>
                <td>{{ $answer->name }}</td>
                <td>{{ $answer->answer }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection