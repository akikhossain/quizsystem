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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Games</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Projects</a>
                    </li>
                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <div class="d-flex align-items-center">
                <!-- Icon -->
                <a class="text-reset me-3" href="#">
                    <i class="fas fa-shopping-cart"></i>
                </a>

                <!-- Avatar -->
                <div class="dropdown">
                    <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#"
                        id="navbarDropdownMenuAvatar" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle" height="25"
                            alt="Black and White Portrait of a Man" loading="lazy" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                        <li>
                            <a class="dropdown-item" href="#">My profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Settings</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Right elements -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->

    <main>
        <section>
            <form action="" method="post" id="imageHandleForm" class="imageHandleForm">
                <div class="container mt-5">
                    <div class="card mx-auto" style="max-width: 800px;">
                        <div class="card-body">
                            <h5 class="card-title text-center mb-4">Upload Images</h5>
                            <form id="imageUploadForm">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="image-preview" id="imagePreview1">500 x 500</div>
                                        <label for="imageUpload1" class="btn btn-outline-secondary btn-block mt-2">
                                            <i class="fas fa-camera"></i> Choose Image 1
                                        </label>
                                        <input type="file" name="image" class="image-input" id="imageUpload1"
                                            accept="image/*">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="image-preview" id="imagePreview2">500 x 500</div>
                                        <label for="imageUpload2" class="btn btn-outline-secondary btn-block mt-2">
                                            <i class="fas fa-camera"></i> Choose Image 2
                                        </label>
                                        <input type="file" name="image" class="image-input" id="imageUpload2"
                                            accept="image/*">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-dark btn-block">UPLOAD IMAGES</button>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"
        integrity="sha384-VzV1eZBh7Dy5Kc9DJNfNLrm8zZy98SMvT84P1C6pMm5u1wU71O6Ja1kSOrKZ2S5G" crossorigin="anonymous">
    </script>

    <script>
        document.getElementById('imageUpload1').addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('imagePreview1').style.backgroundImage = `url(${e.target.result})`;
                document.getElementById('imagePreview1').innerHTML = '';
            }
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('imageUpload2').addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('imagePreview2').style.backgroundImage = `url(${e.target.result})`;
                document.getElementById('imagePreview2').innerHTML = '';
            }
            reader.readAsDataURL(file);
        }
    });
    </script>
</body>

</html>