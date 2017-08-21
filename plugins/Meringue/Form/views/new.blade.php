@extends('admin.app')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h3>Create New Form</h3>
        </div>

        <div class="panel-body">
            <form action="{{ route('Form.store')}}" method="POST">

                <div class="form-group">
                    <label for="name">Form Name</label>
                    <input class="form-control" type="text" name="name" id="name">
                </div>

                <input class="btn btn-primary" type="submit" value="Submit">
            </form>
        </div>
    </div>
@endsection