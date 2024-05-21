@extends('front.app')
@section('content')
<section class="section-1">

</section>
<section class="section-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="box shadow-lg">
                    <i class="fa icon fa-regular fa-pen-to-square text-primary m-0 mr-3"></i>
                    <h2 class="font-weight-semi-bold m-0">Create Posts</h2>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="box shadow-lg">
                    <i class="fa icon fa-solid fa-calendar-days text-primary m-0 mr-3"></i>
                    <h2 class="font-weight-semi-bold m-0">Date-wise Filtering</h2>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="box shadow-lg">
                    <i class="fa icon fa-solid fa-users text-primary m-0 mr-3"></i>
                    <h2 class="font-weight-semi-bold m-0">User Profiles</h2>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="box shadow-lg">
                    <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">24/7 Support</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <form class="d-flex w-75 mx-auto">
        <input class="form-control me-2 py-3 rounded-pill" value="{{ Request::get('keyword') }}" name="keyword"
            type="search" placeholder="Type to search..." aria-label="Search">
        <button class="btn btn-outline-success px-3 rounded-pill" type="submit">Search</button>
    </form>
</div>

<section class="section-4 pt-5">
    <div class="container">
        <div class="section-title">
            <h2>Featured Quizes</h2>
        </div>
        <div class="section-title">
            <a href="{{ route('quiz.results') }}">See the Result</a>
        </div>
        <div class="row pb-3">
            <div class="container w-50 mx-auto mt-5">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if($quizzes->isNotEmpty())
                @foreach($quizzes as $quiz)
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col">
                                <img src="{{ asset($quiz->image1) }}" class="img-fluid" alt="Quiz Image 1">
                            </div>
                            <div class="col">
                                <img src="{{ asset($quiz->image2) }}" class="img-fluid" alt="Quiz Image 2">
                            </div>
                        </div>
                        <a href="#" class="btn btn-link under">Instructions</a>
                        <h6 class="card-title" style="font-size: 15px">Submit Your Answers (Max 5 attempts)</h6>
                        <h6 class="card-title">Deadline: {{ \Carbon\Carbon::parse($quiz->deadline)->format('d M, Y') }}
                        </h6>
                        <form id="quizForm-{{ $quiz->id }}" action="{{ route('submit.quiz') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" name="username" placeholder="A Fun Username"
                                    required>
                            </div>
                            <div class="answer-group active">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="answers[{{ $quiz->id }}][]"
                                        placeholder="Answer 1" required>
                                    <button class="btn btn-outline-secondary addAnswerBtn" type="button">+</button>
                                </div>
                            </div>
                            <div class="answer-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="answers[{{ $quiz->id }}][]"
                                        placeholder="Answer 2">
                                </div>
                            </div>
                            <div class="answer-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="answers[{{ $quiz->id }}][]"
                                        placeholder="Answer 3">
                                </div>
                            </div>
                            <div class="answer-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="answers[{{ $quiz->id }}][]"
                                        placeholder="Answer 4">
                                </div>
                            </div>
                            <div class="answer-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="answers[{{ $quiz->id }}][]"
                                        placeholder="Answer 5">
                                </div>
                            </div>
                            @guest
                            <div class="alert alert-warning" role="alert">
                                You need to <a href="{{ route('account.login') }}" class="alert-link">log in</a> or <a
                                    href="{{ route('account.register') }}" class="alert-link">register</a> to submit
                                your
                                answers.
                            </div>
                            @else
                            <button type="submit" class="btn btn-primary">Submit</button>
                            @endguest
                        </form>
                    </div>
                </div>
                @endforeach
                @else
                <p>No quizzes available at the moment.</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.addAnswerBtn').forEach(function (button) {
            button.addEventListener('click', function () {
                const form = button.closest('form');
                let answerGroups = form.querySelectorAll('.answer-group');
                let activeGroups = form.querySelectorAll('.answer-group.active');

                if (activeGroups.length < 5) {
                    answerGroups[activeGroups.length].classList.add('active');
                }
            });
        });

        document.querySelectorAll('form').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!@json(auth()->check())) {
                    event.preventDefault();
                    window.location.href = "{{ route('account.login') }}";
                }
            });
        });
    });
</script>
@endsection