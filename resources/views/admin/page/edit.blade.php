@extends('admin.app')

@section('content')
    <style>
        .addBlock {
            text-align: center;
            color: #888;
            padding: 10px 0;
        }

        .addBlock i {
            cursor: pointer;
        }

        .section {
            text-align: center;
            background: #F5F5F5;
            padding: 20px 20px 0px 20px;
            border-radius: 5px 0 5px 5px;
            position: relative;
            margin-top: 30px;
        }

        .section > .menu {
            position: absolute;
            bottom: 100%;
            right: 0;
        }

        .section > .menu ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .section > .menu ul li {
            display: inline-block;
            color: #888;
            background: #e6e6e6;
            border-radius: 3px 3px 0 0;
            font-size: 19px;
            padding: 5px 9px;
            cursor: pointer;
            line-height: 19px;
        }

        .section > .menu ul li:hover {
            color: #333333;
        }

        .block {
            margin-bottom: 15px;
        }

        .block .menu {
            position: absolute;
            bottom: 100%;
            left: 0;
        }

        .block .menu ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .block .menu ul li {
            display: inline-block;
            color: #888;
            background: #e6e6e6;
            border-radius: 3px 3px 0 0;
            font-size: 15px;
            padding: 5px 9px;
            cursor: pointer;
            height: 30px;
            line-height: 15px;
        }

        .block .menu ul li.image {
            width: 30px;
            height: 30px;
            background-color: white;
            background-size: contain;
            background-position: center center;
            background-repeat: no-repeat;
            bottom: -13px;
            position: relative;
        }

        .block .menu ul li:hover {
            color: #333333;
        }

        .block .blockInner {
            background: white;
            border-radius: 0 5px 5px 5px;
            padding: 10px;
            margin-top: 26px;
            position: relative;
        }

    </style>


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info panel-bordered">
                <div class="panel-heading">
                    <h6 class="panel-title">Page Editor<a class="heading-elements-toggle"><i class="icon-more"></i></a>
                    </h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    @foreach ($page->sections as $section)
                        <div class="section row">
                            <div class="menu">
                                <ul>
                                    <li><i class="fa fa-pencil" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-clone" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-trash-o" aria-hidden="true"></i></li>
                                </ul>
                            </div>
                            @foreach ($section->blocks as $block)
                                <div class="block col-md-<?= $block->width;?>" data-width="<?= $block->width;?>"
                                     data-id="<?=$block->id;?>">
                                    <div class="blockInner">
                                        <div class="menu">
                                            <ul>

                                                <li class="image"
                                                    style="background-image:url({{ $block->plugin->icon }});"></li>

                                                <li><i class="fa fa-pencil editBlock" data-toggle="modal"
                                                       data-target="#myModal" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-clone" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-trash-o deleteBlock" aria-hidden="true"></i></li>
                                                <li class="changeBlockWidth" data-adjustment="-1">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                </li>
                                                <li class="changeBlockWidth" data-adjustment="1">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </li>
                                                <li class="blockWidth"><?= $block->width; ?></li>
                                            </ul>
                                        </div>
                                        @php $plugin = \App\Helpers\PluginInitialiser::getPlugin($block->plugin_class) @endphp
                                        {{ $plugin->getName() }}
                                        @if (isset($block->instance_id))
                                            {{ $plugin->getInstance($block->instance_id)->name }}
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            <div class="pluginDrawer col-md-12"><h4>Plugins Drawer</h4></div>
                            @foreach($plugins as $plugin)
                                @php $plugin = \App\Helpers\PluginInitialiser::getPlugin($plugin->class) @endphp
                                <div class="col-md-2">
                                    <div class="panel panel-flat">
                                        <div class="panel-heading"><strong>{{ $plugin->getName() }}</strong></div>
                                        <div class="panel-body">
                                            <form method="POST" action="{{ route('block.store') }}">
                                                <input type="hidden" name="section_id" value="{{ $section->id }}">

                                                <input type="hidden" name="plugin_class"
                                                       value="{{ class_path($plugin->getVendor(), $plugin->getName()) }}">

                                                <input type="submit" class="btn btn-primary" value="Insert">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="addBlock col-md-12"><i class="fa fa-plus"></i></div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>The Select Instance Dropdown will go here</p>
                    <p>As will the new Instance form created by the Plugins</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        function updateBlock(id, data) {
            return $.ajax({
                url: '/admin/block/' + id,
                method: 'post',
                data: data
            });
        }

        function changeBlockWidth(id, width) {
            if (width <= 0 || width > 12) {
                return false;
            }
            updateBlock(id, {
                width: width
            }).success(function () {
                setBlockWidth(id, width);
            });
        }

        function getBlockWidth(id) {
            return $('.block[data-id=' + id + ']').data('width');
        }

        function setBlockWidth(id, width) {
            $('.block[data-id=' + id + ']').removeClass(function (index, className) {
                return (className.match(/(^|\s)col-md-\S+/g) || []).join(' ');
            }).addClass('col-md-' + width).data('width', width);
            $('.block[data-id=' + id + ']').find('.blockWidth').html(width);
        }

        $('.changeBlockWidth').on('click', function () {
            var id = $(this).closest('.block').data('id');
            changeBlockWidth(id, getBlockWidth(id) + $(this).data('adjustment'));
        });

        $('.deleteBlock').on('click', function () {
            var id = $(this).closest('.block').data('id');

            return $.ajax({
                url: "/admin/block/" + id,
                method: 'delete'
            }).success(function () {
                $('.block[data-id=' + id + ']').html("");
            });
        });
    </script>
@endsection