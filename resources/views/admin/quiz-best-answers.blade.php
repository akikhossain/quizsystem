@extends('admin.app')

@section('content')
<div class="container card mt-5">
    <h2 class="text-center mt-5">Quiz ({{ \Carbon\Carbon::parse($quiz->deadline)->format('j F, Y') }}) - Best Answers
    </h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Answer</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bestAnswers as $bestAnswer)
                        <tr>
                            <td>{{ $bestAnswer->answer }}</td>
                            <td>{{ $bestAnswer->total }}</td>
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