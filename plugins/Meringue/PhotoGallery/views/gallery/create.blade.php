@extends('admin.app')

@section('content')
    <div class="panel panel-flat">

        <div class="panel-heading">
            <h3>Create New Gallery</h3>
        </div>

        <div class="panel-body">
            <form action="{{ route('PhotoGallery.store') }}" method="post">
                <div class="form-group">
                    <label for="name">Gallery Name</label>
                    <input name="name" class="form-control" id="name">
                </div>

                <div class="form-group">
                    <label for="name">Gallery Type</label>
                    <select name="class" class="form-control">
                        @foreach($galleryTypes as $className => $galleryType)
                            <option value="{{ $className }}">{{ $galleryType }}</option>
                        @endforeach
                    </select>
                </div>

                <input type="submit" class="btn btn-primary" value="Save">
            </form>
        </div>

    </div>



@endsection