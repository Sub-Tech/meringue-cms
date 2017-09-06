@extends('admin.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title">Forms</h6>
            <div class="heading-elements">
                <a href="{{ route('Form.create') }}">
                    <button class="btn btn-sm btn-success">Create New Form</button>
                </a>
            </div>
        </div>
        <div class="panel-body">
            <?php if(!$forms) { ?>
            <ul>
                <?php foreach($forms as $form) { ?>
                <li>{{ $form->name }}, created {{ $form->created_at->format('d/m/Y') }}
                    <a href="{{ route('Form.edit', ['form' => $form->id]) }}">Edit</a>
                    <a href="{{ route('Form.responses', ['form' => $form->id]) }}">View Responses</a>
                </li>
                <?php } ?>
            </ul>
            <?php } else {?>
            <div class="alert alert-warning alert-bordered">
                <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                            class="sr-only">Close</span></button>
                <span class="text-semibold">Warning!</span> Better <a href="#" class="alert-link">check yourself</a>,
                you're not looking too good.
            </div>
            <?php } ?>


        </div>
    </div>
@endsection