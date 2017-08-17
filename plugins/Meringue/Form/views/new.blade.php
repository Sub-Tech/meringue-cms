@extends('admin.app')

@section('content')
    <form action="{{ route('Form.store')}}" method="POST">

        <div class="form-group">
            <label for="name">Form Name</label>
            <input class="form-control" type="text" name="name" id="name">
        </div>

        <input class="btn btn-primary" type="submit" value="Submit">
    </form>
@endsection