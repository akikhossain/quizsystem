@extends('admin.app')
@section('content')
<div class="container card mt-5">
    <h2 class="text-center mt-5">Quiz Result - All Answers</h2>
    <p class="text-center">Submission Period: {{ \Carbon\Carbon::parse($quiz->deadline)->format('j F, Y') }}</p>
    <button type="button" class="btn btn-success mx-auto mb-2" style="width: 150px"><a class="text-white fw-bold"
            href="">Best
            Answers</a></button>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Answer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($answers as $answer)
                        <tr>
                            <td>{{ $answer->user->name }}</td>
                            <td>{{ $answer->answer }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2">No answers submitted for this quiz.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection