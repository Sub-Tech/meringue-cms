@extends('admin.app')

@section('content')
    <div class="inputs col-md-9">
        <div class="panel panel-flat">

            <div class="panel-heading">
                <h3>{{ ucfirst($form->name) }} Preview</h3>
            </div>

            <div class="panel-body">
                @forelse($form->inputs as $input)
                    <div class="form-group">
                        <label for="{{ $input->form_input_id }}">{{ $input->label }}</label>

                        <a href="{{ route('Form.input.delete', ['form' => $form->id,'input' => $input->id]) }}">Delete</a>

                        @include('Meringue/Form/views/inputs/' . $input->type)
                    </div>
                @empty
                    <i>No inputs yet</i>
                @endforelse
            </div>

        </div>
    </div>

    <div class="col-md-3">
        <div class="panel panel-flat">

            <div class="panel-heading">
                <h3>Add Inputs</h3>
            </div>

            <div class="panel-body">
                <form action="{{ route('Form.input.create', ['form' => $form->id]) }}" method="POST">

                    <div class="form-group">
                        <label for="label">Label</label>
                        <input type="text" placeholder="Label" name="label" id="label" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="type">Input Type</label>
                        <select name="type" id="type" class="form-control">
                            <option disabled selected>Input Type</option>
                            @foreach($inputTypes as $inputType)
                                <option value="{{ $inputType }}">{{ ucfirst($inputType) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="options">Options</label>
                        <textarea class="form-control" id="options" name="options"
                                  placeholder="value1|value2|value3"></textarea>
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
                            <label><input type="checkbox" name="required">Required</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Add New Input">
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection


