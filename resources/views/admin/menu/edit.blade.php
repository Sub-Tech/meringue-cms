@extends('admin.app')

@section('content')
    <div class="col-md-9">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h3>
                    Edit Menu
                </h3>
            </div>
            <div class="panel-body">
                <ul>
                    @foreach($parents as $parent)
                        <li>
                            {{ $parent->text }}
                            <ul>
                                @foreach($parent->children as $child)
                                    <li>{{ $child->text }}</li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h3>Add New Option</h3>
            </div>
            <div class="panel-body">
                <form action="{{ route('menu.option.store') }}" method="post">

                    <div class="form-group">
                        <label for="text">Text</label>
                        <input name="text" type="text" class="form-control" id="text">
                    </div>

                    <div class="form-group">
                        <label for="page">Page (priority)</label>
                        <select name="page" class="form-control" id="page">
                            <option value="">None</option>
                            @forelse($pages as $page)
                                <option value="{{ $page->id }}">{{ $page->name }}</option>
                            @empty
                                <option disabled>No Pages set up</option>
                            @endforelse
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="href">External Link</label>
                        <input name="href" type="text" class="form-control" id="href">
                    </div>


                    <div class="form-group">
                        <label for="parent_id">Parent Option</label>
                        <select name="parent_id" class="form-control" id="parent_id">
                            <option value="">None</option>
                            @forelse($parents as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->text }}</option>
                            @empty
                                <option disabled>No Pages set up</option>
                            @endforelse
                        </select>
                    </div>

                    <input type="submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection