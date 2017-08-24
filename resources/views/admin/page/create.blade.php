@extends('admin.app')

@section('content')

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h3>Add New Page</h3>
        </div>
        <div class="panel-body">

            <form action="{{ route('admin.page.store') }}" method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name" id="name">
                </div>

                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input class="form-control" type="text" name="slug" id="slug">
                </div>

                <input class="btn btn-primary" type="submit">
            </form>
        </div>
    </div>

@endsection