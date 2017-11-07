@extends('admin.app')

@section('content')
    <form method="POST" action="{{ route('admin.media.upload') }}" enctype="multipart/form-data">
        <input type="file" name="media">
        <input type="submit">
    </form>

    @foreach($media as $file)
        <p>{{ $file->path }}</p>
    @endforeach
@endsection
