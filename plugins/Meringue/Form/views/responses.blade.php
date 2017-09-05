@extends('admin.app')

@section('content')
    <div class="panel panel-flat">

        <div class="panel-heading">
            <h3>Responses for <strong>{{ $form->name }}</strong></h3>
        </div>

        <div class="panel-body">
            <ul>
                @forelse($form->responses->reverse() as $response)
                    <a href="{{ route('Form.response', ['form' => $form->id, 'response' => $response->id]) }}">
                        <li>Response #{{ $response->id }}, submitted {{ $response->created_at->diffForHumans() }}</li>
                    </a>
                @empty
                    <i>No responses yet</i>
                @endforelse
            </ul>
        </div>

    </div>
@endsection