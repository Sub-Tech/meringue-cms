@extends('admin.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Plugin Manager</h6>
                    <div class="heading-elements">
                        <span class="label bg-success heading-text">Plugins</span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($plugins as $plugin)
                            <tr>
                                <td>{{ $plugin->name }}</td>
                                <td>{{ $plugin->description }}</td>
                                <td>{{ $plugin->author }}</td>
                                <td>
                                    @if ($plugin->active)
                                        <span class='label bg-success'>Active</span>
                                    @else
                                        <span class='label bg-danger'>Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-right text-center">
                                                @if($plugin->active)
                                                    <li>
                                                        <a class="deactivatePlugin"
                                                           data-plugin='{{ $plugin->class_name }}'>
                                                            Deactivate Plugin
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a class="activePlugin" data-plugin='{{ $plugin->class_name }}'>
                                                            Activate Plugin
                                                        </a>
                                                    </li>
                                                @endif
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

    <script>
        $('.activePlugin').on('click', function () {
            var plugin = $(this).data('plugin');
            $.ajax({
                'url': '/admin/plugins/' + encodeURI(plugin) + '/activate',
                'method': 'post'
            }).success(function (res) {
                if (!res.success) {
                    new PNotify({
                        title: 'Error',
                        text: res.message,
                        icon: 'icon-warning22',
                        type: 'error',
                        addclass: 'bg-danger'
                    });
                } else {
                    location.reload();
                }
            });
        });

        $('.deactivatePlugin').on('click', function () {
            var plugin = $(this).data('plugin');
            $.ajax({
                'url': '/admin/plugins/' + encodeURI(plugin) + '/deactivate',
                'method': 'delete'
            }).success(function (res) {
                if (!res.success) {
                    new PNotify({
                        title: 'Error',
                        text: res.message,
                        icon: 'icon-warning22',
                        type: 'error',
                        addclass: 'bg-danger'
                    });
                } else {
                    location.reload();
                }
            });
        });
    </script>
@endsection