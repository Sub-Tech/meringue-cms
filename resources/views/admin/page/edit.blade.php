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
            bottom: -1px;
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

        .block .blockInner img {
            width: 100%;
            height: 100%;
        }
    </style>

    @include('admin.page.details')

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
                        <div class="section row" style="margin-top: 50px">
                            <div class="menu">
                                <ul>
                                    <li><i class="fa fa-pencil css-button" aria-hidden="true" data-toggle="modal"
                                           data-target="#cssModal" data-section_id="{{ $section->id }}"></i></li>
                                    <li><i class="fa fa-clone" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-trash-o delete-section" aria-hidden="true"
                                           data-section_id="{{ $section->id }}"></i></li>
                                </ul>
                            </div>
                            <?php if(!$section->blocks->count()) {?>
                            <div class="alert alert-warning alert-bordered">
                                <b>No Blocks have been found, </b> we suggest you add some
                            </div>
                            <?php }?>
                            @foreach ($section->blocks as $block)
                                <div class="block col-md-<?= $block->width;?>" data-width="<?= $block->width;?>"
                                     data-instance_id="{{ $block->instance_id ?? "" }}"
                                     data-id="<?=$block->id;?>">
                                    <div class="blockInner">
                                        <div class="menu">
                                            <ul>
                                                <li class="image">{!! $block->plugin->class()->setFontAwesomeIcon() !!}</li>
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


                                        @if(!$block->plugin->active)
                                            <span style="color: red;"> INACTIVE</span>
                                        @endif

                                        @if($block->plugin->class() instanceof \App\Plugin\PageEditorInterface)
                                            @include($block->plugin->class()->renderBlockPreview($block))
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            <script>

                                /**
                                 * Render the appropriate Modal popup when an Edit Block button is clicked
                                 * Done by making an AJAX request to the ModalRenderer
                                 */
                                $('.editBlock').on('click', function () {
                                    var id = $(this).closest('.block').data('id');
                                    var instance_id = $(this).closest('.block').data('instance_id');

                                    var url = "/admin/blocks/" + id + "/modal";

                                    if (typeof(instance_id) !== 'undefined' && instance_id !== "") {
                                        url += "/" + instance_id
                                    }

                                    return $.ajax({
                                        url: url,
                                        method: 'get'
                                    }).success(function (resp) {
                                        $('#content-modal').html(resp);
                                    });
                                });
                            </script>

                            <script>
                                $('.css-button').on('click', function () {
                                    return $.ajax({
                                        url: "/admin/sections/" + $(this).attr('data-section_id') + "/modal",
                                        method: 'get'
                                    }).success(function (resp) {
                                        $('#css-modal-body').html(resp);
                                    });
                                });
                            </script>

                            {{-- PLUGIN DRAWER --}}
                            <div class="pluginDrawer col-md-12" style="display: none;"><h4>Blocks</h4>
                                @foreach($plugins as $plugin)
                                    @php $plugin = \App\Plugin\PluginInitialiser::getPlugin($plugin->class) @endphp
                                    <div class="col-md-2">
                                        <div class="panel panel-flat">
                                            <div class="panel-heading"><strong>{{ $plugin->getName() }}</strong></div>
                                            <div class="panel-body">
                                                <form method="POST"
                                                      action="{{ route('block.store', ['section' => $section->id]) }}">
                                                    <input type="hidden" name="plugin_class"
                                                           value="{{ class_path($plugin->getVendor(), $plugin->getName()) }}">

                                                    <input type="submit" class="btn btn-primary" value="Insert">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="addBlock col-md-12"><i class="fa fa-plus"></i></div>

                        </div>
                    @endforeach

                    <form method="post" action="{{ route('section.store', ['page_id' => $page->id]) }}">
                        <input type="hidden" name="order" value="1"> {{-- TODO REMOVE --}}

                        <input class="btn btn-success" type="submit" style="margin-top: 20px" value="Add New Section">
                    </form>
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
                    <h4 class="modal-title">Select / Insert Content</h4>
                </div>
                <div class="modal-body" id="content-modal">
                    <p>Loading...</p>
                </div>
            </div>

        </div>
    </div>


    <!-- Modal -->
    <div id="cssModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Section CSS</h4>
                </div>
                <div class="modal-body" id="css-modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h3>Custom CSS</h3>
        </div>
        <div class="panel-body">
            <form action="{{ route('page.css', ['page' => $page]) }}" method="POST">
                {{ method_field("PATCH") }}
                <div class="form-group">
                    <textarea class="form-control" id="custom-css"
                              name="custom_css">{!! $page->custom_css !!}</textarea>
                </div>
                <input type="submit" class="btn btn-primary">
            </form>
        </div>
    </div>

    <script>

        function updateBlock(id, data) {
            return $.ajax({
                url: '/admin/blocks/' + id,
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


        /**
         * Delete a block
         */
        $('.deleteBlock').on('click', function () {
            var id = $(this).closest('.block').data('id');

            return $.ajax({
                url: "/admin/blocks/" + id,
                method: 'delete'
            }).success(function () {
                $('.block[data-id=' + id + ']').html("");
            });
        });

        /**
         * Delete a block
         */
        $('.delete-section').on('click', function () {
            var id = $(this).data('section_id');
            var self = $(this);

            return $.ajax({
                url: "/admin/sections/" + id,
                method: 'delete'
            }).success(function () {
//                console.log('donzo');
                self.closest(".section").html("");
            });
        });

        /**
         * Reset Modal Body upon close
         */
        $('#myModal').on('hidden.bs.modal', function () {
            $('.modal-body').html("Loading...");
        });

        $('.addBlock').on('click', function () {
            $(this).closest('.section').find('.pluginDrawer').show();
        })

    </script>
@endsection