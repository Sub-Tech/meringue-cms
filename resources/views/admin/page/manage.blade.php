@extends('admin.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <!-- Marketing campaigns -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Page Manager</h6>
                    <div class="heading-elements">
                        <span class="label bg-success heading-text">{{ $pages->count() }} Pages</span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Author</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pages as $page)
                            <tr>

                                <td>{{ $page->name }}</td>
                                <td>{{ $page->author->name }}</td>
                                <td>{{ date('Y-m-d H:i:s', strtotime($page->created_at)) }}</td>

                                <td>
                                    @if($page->active == 1 )
                                        <span class="label bg-green">Active</span>
                                    @else
                                        <span class="label bg-red">Hidden</span>
                                    @endif

                                    @if($page->homepage)
                                        <span class="label bg-blue">Homepage</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-right text-center">
                                                <li><a href="{{ route('admin.page.edit', ['page' => $page->id]) }}">Edit
                                                        Page</a></li>
                                                <li><a href="{{ url($page->slug) }}">View Page</a></li>
                                                <li><a href="{{ route('homepage.update', ['page' => $page->id]) }}">Assign as Home Page</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#" style="color:red;">Delete</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection