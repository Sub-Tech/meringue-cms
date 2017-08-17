@extends('admin.app')

@section('content')
    <div class="inputs col-md-9">
        <h3>Form Preview</h3>
        <hr/>
        @foreach($form->inputs as $input)
            <div class="form-group">
                <label for="{{ $input->name }}-{{$input->id}}">{{ $input->label }}</label>
                @include('Meringue/Form/views/inputs/' . $input->type)
            </div>
        @endforeach
    </div>

    <div class="col-md-3" style="border-right: thin #ddd solid">
        <h3>Add Inputs</h3>
        <hr/>
        <form action="/admin/Meringue/Form/{{ $form->id }}/inputs" method="POST">

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
                <div class="checkbox">
                    <label><input type="checkbox" name="required">Required</label>
                </div>
            </div>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Add New Input">
            </div>
        </form>
    </div>
@endsection


