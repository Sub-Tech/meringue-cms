@extends('admin.app')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h3>Forms</h3>
        </div>
        <div class="panel-body">
            <ul>
                @forelse($forms as $form)
                    <li>{{ $form->name }}, created {{ $form->created_at->format('d/m/Y') }} <a
                                href="{{ route('Form.edit', ['form' => $form->id]) }}">Edit</a>
                    </li>
                @empty
                    <i>No forms yet</i>
                @endforelse
            </ul>

            <a href="{{ route('Form.create') }}">
                <button class="btn btn-primary">Create New Form</button>
            </a>
        </div>
    </div>
@endsection