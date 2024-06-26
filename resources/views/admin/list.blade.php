<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css"
        rel="stylesheet">
    <title>ImageInEveryWhere</title>
</head>

<body>
    @include('admin.partial.navbar')
    <div class="container">
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
        <h2 class="my-4">Quiz List</h2>
        {{-- <a href="" class="my-4 btn btn-info">All Answer</a> --}}
        <table class="table table-bordered" id="quizDataTable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Date</th>
                    <th>Image 1</th>
                    <th>Image 2</th>
                    <th>Deadline</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#quizDataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('admin/list') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'current_date', name: 'current_date' },
                    { data: 'image1', name: 'image1', orderable: false, searchable: false },
                    { data: 'image2', name: 'image2', orderable: false, searchable: false },
                    { data: 'deadline', name: 'deadline' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                pageLength: 4
            });

            $('#quizDataTable').on('click', '.view-answer-btn', function (e) {
            e.preventDefault();
            var quizId = $(this).data('quiz-id');
            window.location.href = "{{ url('admin/view-answer') }}/" + quizId;
        });
        });

    </script>
</body>

</html>