@extends('admin.app')

@section('content')
    <div class="panel panel-flat">

        <div class="panel-heading">
            <h3>Response #{{ $response->id }} for <strong>{{ $response->form->name }}</strong>,
                submitted {{ $response->created_at->diffForHumans() }}</h3>
        </div>

        <div class="panel-body">
            @foreach($response->answers as $field => $value)
                <p><strong>{{ $field }}:</strong> {{ $value }}</p>
            @endforeach

            @isset($response->email)
                <a href="mailto:{{ $response->email }}">
                    <button class="btn btn-primary">Respond</button>
                </a>
            @endisset
        </div>

    </div>
@endsection