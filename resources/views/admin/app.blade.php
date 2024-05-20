<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet">
    <title>ImageInEveryWhere</title>
    <style>
        .image-preview {
            width: 100%;
            height: 300px;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            color: #6c757d;
            font-size: 24px;
            background-size: cover;
            background-position: center;
        }

        .image-input {
            display: none;
        }
    </style>
</head>

<body>

    @include('admin.partial.navbar')

    <!-- Navbar -->

    {{-- <main>
        <section>
            <form action="{{ route('admin.store') }}" method="post" id="imageHandleForm" class="imageHandleForm"
                enctype="multipart/form-data">
                @csrf
                <div class="container mt-5">
                    <div class="card mx-auto" style="max-width: 800px;">
                        <div class="card-body">
                            <h5 class="card-title text-center mb-4">Upload Images</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="image-preview" id="imagePreview1">500 x 500</div>
                                    <label for="imageUpload1" class="btn btn-outline-secondary btn-block mt-2">
                                        <i class="fas fa-camera"></i> Choose Image 1
                                    </label>
                                    <input type="file" name="images[]" class="image-input" id="imageUpload1"
                                        accept="image/*">
                                    <p></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="image-preview" id="imagePreview2">500 x 500</div>
                                    <label for="imageUpload2" class="btn btn-outline-secondary btn-block mt-2">
                                        <i class="fas fa-camera"></i> Choose Image 2
                                    </label>
                                    <input type="file" name="images[]" class="image-input" id="imageUpload2"
                                        accept="image/*">
                                    <p></p>
                                </div>

                                <div class="mb-3">
                                    <label for="deadline" class="form-label">Quiz Deadline</label>
                                    <input type="datetime-local" name="deadline" class="form-control" id="deadline">
                                    <p></p>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark btn-block">UPLOAD IMAGES</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main> --}}
    @yield('content')

    @include('admin.partial.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"
        integrity="sha384-VzV1eZBh7Dy5Kc9DJNfNLrm8zZy98SMvT84P1C6pMm5u1wU71O6Ja1kSOrKZ2S5G" crossorigin="anonymous">
    </script>

    <script>
        document.getElementById('imageUpload1').addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('imagePreview1').style.backgroundImage = `url(${e.target.result})`;
                        document.getElementById('imagePreview1').innerHTML = '';
                    }
                    reader.readAsDataURL(file);
                }
            });

            document.getElementById('imageUpload2').addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('imagePreview2').style.backgroundImage = `url(${e.target.result})`;
                        document.getElementById('imagePreview2').innerHTML = '';
                    }
                    reader.readAsDataURL(file);
                }
            });

            $("#imageHandleForm").submit(function(event) {
                event.preventDefault();
                var element = $(this);

                $("button[type=submit]").prop('disabled', true);

                var formData = new FormData(this);

                $.ajax({
                    url: '{{ route('admin.store') }}',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $("button[type=submit]").prop('disabled', false);
                        if (response['status'] == true) {
                            window.location.href = "{{ route('admin.list') }}";
                        }
                    },
                    error: function(jqXHR, exception) {
                        console.log("Something went wrong");
                    }
                });
            });
    </script>
    @yield('customJs')
</body>

</html>