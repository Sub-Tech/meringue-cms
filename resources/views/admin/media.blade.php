@extends('admin.app')

@section('content')
    <style>
        .media-item {
            width:15%;
            float:left;
            margin:10px;
            background:white;
            padding:10px;
        }
        .media-item .image {
            width:100%;
            border:1px solid #cacaca;
            height:100px;
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center center;
        }
        .media-item p {
            word-break: break-all;
        }
    </style>
    <form method="POST" action="{{ route('admin.media.upload') }}" enctype="multipart/form-data">
        <input type="file" name="media">
        <input type="submit">
    </form>


    @foreach($media as $file)
        <div class="media-item">
            <div class="image" style="background-image: url('/{{ $file->url }}')"></div>
            <p>{{ $file->url }}</p>
        </div>
    @endforeach
@endsection
