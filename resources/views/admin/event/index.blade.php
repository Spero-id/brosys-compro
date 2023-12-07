@extends('admin.template')
@section('title', 'Events')
@section('layout')
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Events</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="{{ url('admin/event') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputUsername1" class="fw-bold">Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{ old('title') }}" id="exampleInputUsername1" placeholder="Input Title..." name="title">
                        @error('title')
                                <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                    <label for="exampleInputUsername1" class="fw-bold">Image Event <span class="text-danger text-sm">*max 2mb </span></label>
                    <input type="file" value="{{ old('foto') }}" id="selectImage"  class="form-control" name="foto">
                    <img id="preview" src="#" alt="your image" width="100%" class="mt-3" style="display:none;"/>  
                        @error('foto')
                                <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="modal-footer gap-1">
                    <button type="button" class="btn btn-outline-warning btn-icon-text" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        <button type="submit" id="dis" class="btn btn-outline-primary btn-icon-text">
                            Submit
                        </button>
                    </div>
                </form>
      </div>
    </div>
  </div>
</div>

<div class="page-heading">
    <h3>Table Events</h3>
</div>
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card-body">
          
            <div class="card-title d-flex justify-content-end mb-5">
                <a data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-primary btn-lg btn-icon-text">
                    <i class="mdi mdi-upload btn-icon-prepend"></i>
                    +
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="table1">
                    <thead>
                        <tr class="text-center">
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Action</th>
                            <th style="text-align: center;">Event Name</th>
                            <th style="text-align: center;">Event Image</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($event as $item)
                    <tr class="fw-bold">
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td >
                            <div class="d-flex justify-content-center gap-1">
                                <a data-bs-toggle="modal" data-bs-target="#Edit{{$item->id}}" class="btn btn-warning btn-sm-lg text-white"><i class="bi bi-vector-pen"></i></a>
                                <div class="modal fade" id="Edit{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EditLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="EditLabel">Edit Event</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="{{ url('admin/event', $item->id) }}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="exampleInputUsername1" class="fw-bold">Title<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ $item->title }}" id="exampleInputUsername1" placeholder="Input Title..." name="title">                       
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1" class="fw-bold">Image Event <span class="text-danger text-sm">*max 2mb </span></label>
                                            <input id="imageInput" type="file" class="form-control" name="foto">
                                            <img src="{{asset('image/'.$item->foto)}}" id="image-before" class="mt-2"  width="100%" alt="">
                                            <div id="imagePreview" style="display: none;">
                                            </div>
                                        </div>
                                        <div class="modal-footer gap-1">
                                        <button type="button" class="btn btn-outline-warning btn-icon-text" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                            <button type="submit" id="dis" class="btn btn-outline-primary btn-icon-text">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                    </div>
                                    </div>
                                </div>
                                </div>

                                <form action="{{ url('admin/event', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-icon btn-danger delete" data-id="{{ $item->id }}"><i class="bi bi-trash-fill"></i></button>    
                                </form>
                            </div>
                        </td>
                        <td class="text-center">{{ Str::limit($item->title, 25)}}</td>
                        <td class="text-center"><img src="{{asset('image/'.$item->foto)}}"  height="100" alt=""></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
selectImage.onchange = evt => {
    preview = document.getElementById('preview');
    preview.style.display = 'block';
    const [file] = selectImage.files
    if (file) {
        preview.src = URL.createObjectURL(file)
    }
}

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Listen for changes in the file input
    var imageInput = document.getElementById('imageInput');
    var imagePreview = document.getElementById('imagePreview');
    var imageBefore = document.getElementById('image-before');

    imageInput.addEventListener('change', function (e) {
        // Get the selected file
        var file = e.target.files[0];

        // Check if a file is selected
        if (file) {
            // Read the file as a Data URL
            var reader = new FileReader();
            reader.onload = function (e) {
                // Set the preview image source and display it
                imagePreview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" width="100%;" style="margin-top: 1rem;">';
                imagePreview.style.display = 'block';
                imageBefore.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endsection