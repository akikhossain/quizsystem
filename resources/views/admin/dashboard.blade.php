@extends('admin.app')
@section('content')
<main>
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
</main>
@endsection
@section('customJs')
@endsection