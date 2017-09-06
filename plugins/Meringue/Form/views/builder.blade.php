@extends('admin.app')

@section('content')
    <div class="inputs col-md-9">
        <div class="panel panel-flat">

            <div class="panel-heading">
                <h3>{{ ucfirst($form->name) }} Preview</h3>
            </div>

            <div class="panel-body">
                <form>
                    @forelse($form->inputs as $input)

                        <div class="form-group">
                            <label for="{{ $input->form_input_id }}">{{ $input->label }}</label>

                            <a href="{{ route('Form.input.delete', ['form' => $form->id,'input' => $input->id]) }}">Delete</a>

                            @include('Meringue/Form/views/inputs/' . $input->type)
                        </div>
                    @empty
                        <div class="alert alert-warning alert-bordered">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                        class="sr-only">Close</span></button>
                            <span class="text-semibold">No Inputs Have Been Created Yet!</span> You probably should
                            think about adding a input
                        </div>
                    @endforelse
                </form>
            </div>

        </div>
    </div>

    <div class="col-md-3">
        <div class="panel panel-flat">

            <div class="panel-heading">
                <h3>Add Inputs</h3>
            </div>

            <div class="panel-body">

                @foreach($inputTypes as $inputType)




                @endforeach

                <form action="{{ route('Form.input.create', ['form' => $form->id]) }}" method="POST">

                    <div class="form-group">
                        <label for="label">Label</label>
                        <input type="text" placeholder="Label" name="label" id="label" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="type">Input Type</label>
                        <select name="type" id="type" class="form-control" required>
                            <option disabled selected value="">Input Type</option>
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
                        <strong>Required</strong>
                        <div class="checkbox">
                            <label><input type="checkbox" name="validation_required">Required</label>
                        </div>
                    </div>

                    <hr/>

                    <div class="form-group">
                        <strong>Value Type</strong>
                        <div class="checkbox">
                            <label><input type="checkbox" name="validation_email">Email</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="validation_numeric">Numeric</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="validation_alpha_dash">Alphabetic</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="validation_image">Image</label>
                        </div>
                    </div>

                    <hr/>

                    <div class="form-group">
                        <strong>Other Rules</strong><br>
                        <label for="same">Input Must Match</label>
                        <select name="validation_same" class="form-control" id="same">
                            @forelse($form->inputs as $input)
                                <option value="{{ $input->name }}">{{ $input->label }}</option>
                            @empty
                                <option disabled value=""><i>No Inputs found</i></option>
                            @endforelse
                        </select>
                    </div>

                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Add New Input">
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection


