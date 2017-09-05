@extends('admin.app')

@section('content')

    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-flat">

                <div class="panel-heading">
                    <h3>Gallery {{ $gallery->name }}</h3>
                </div>

                <div class="panel-body">
                    @forelse($gallery->images as $image)
                        <img src="{{ $image->url }}">
                    @empty
                        <i>No Images yet</i>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-flat">

                <div class="panel-heading">
                    <h4>Add New Image</h4>
                </div>

                <div class="panel-body">
                    <form action="{{ route('PhotoGallery.image.create', ['gallery' => $gallery->id]) }}"
                          method="post">
                        <div class="form-group">
                            <label for="url">URL</label>
                            <input name="url" class="form-control" id="url">
                        </div>
                        <input type="submit" class="btn btn-primary" value="Save">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection