@extends('admin.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title">Create New Form</h6>
                    <div class="heading-elements">
                        <!-- Space For Buttons -->
                    </div>
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
        </div>
@endsection