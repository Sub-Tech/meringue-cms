<div class="block col-md-<?= $block->width;?>" data-width="<?= $block->width;?>"
     data-instance_id="{{ $block->instance_id ?? "" }}"
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
        @php $plugin = \App\Plugin\PluginInitialiser::getPlugin($block->plugin_class) @endphp
        <strong>{{ $plugin->getName() }}</strong>
        @if (isset($block->instance_id))
            : {{ $plugin->getInstance($block->instance_id)->name }}
        @endif
        @if(!$block->plugin->active)
            <span style="color: red;"> INACTIVE</span>
        @endif
    </div>
</div>

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
            $('.modal-body').html(resp);
        });
    });Z
</script>