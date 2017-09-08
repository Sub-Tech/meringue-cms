@if (isset($block->instance_id))
    <div id="editor1" contenteditable="true">
        {!! $block->plugin->getInstance($block->instance_id)->content !!}
    </div>
@endif

<script>
    $('body').click(function () {
        if ($('#editor1').hasClass('cke_focus')) {
            $.ajax({
                method: 'patch',
                url: '/admin/instances/{{ $block->instance_id }}',
                data: {
                    content: CKEDITOR.instances.editor1.getData(),
                    vendor: '{{ $block->plugin->getVendor() }}',
                    plugin: '{{ $block->plugin->getName() }}'
                }
            });
        }
    });
</script>