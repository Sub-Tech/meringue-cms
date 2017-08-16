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
                        <?php foreach($plugins as $plugin) { ?>
                        <tr>
                            <td><?= $plugin->name;?></td>
                            <td><?= $plugin->description;?></td>
                            <td><?= $plugin->author;?></td>
                            <td>
                                <?php if ($plugin->active) {
                                    echo "<span class='label bg-success'>Active</span>";
                                } else {
                                    echo "<span class='label bg-danger'>Inactive</span>";
                                } ?>
                            </td>
                            <td class="text-center">
                                <ul class="icons-list">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                                    class="icon-menu7"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-right text-center">
                                            <li>
                                                <a class="activePlugin" data-plugin='{{ $plugin->class_name }}'>
                                                    Activate Plugin
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li><a href="#" style="color:red;">Delete</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <p>Can you not see a plugin in this list. <a onclick="refreshList()">Click here to refresh</a></p>
        </div>
    </div>





    <script>
        function refreshList() {
            $.ajax({
                'url': '/admin/plugin/refresh'
            }).success(function () {
                location.reload();
            });
        }

        $('.activePlugin').on('click', function () {
            $.ajax({
                'url': '/admin/plugin/activate',
                'method': 'post',
                data: {
                    'plugin': $(this).data('plugin')
                }
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