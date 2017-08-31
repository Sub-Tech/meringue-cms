@extends('admin.app')

@section('content')
    <div class="panel panel-flat">

        <div class="panel-heading">
            <h3>Galleries</h3>
        </div>

        <div class="panel-body">
            <ul>
                @forelse($galleries as $gallery)
                    <a href="{{ route('PhotoGallery.edit', ['gallery' => $gallery->id]) }}">
                        <li>{{ $gallery->name }}</li>
                    </a>
                @empty
                    <i>No Galleries yet</i>
                @endforelse
            </ul>

            <a href="{{ route('PhotoGallery.create') }}" class="btn btn-primary">
                Create New Gallery
            </a>

        </div>

    </div>
@endsection