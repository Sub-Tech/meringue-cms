@if (isset($block->instance_id))
    <div id="editor" contenteditable="true">
        {!! $block->plugin->class()->getInstance($block->instance_id)->content !!}
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
                    vendor: '{{ $block->plugin->class()->getVendor() }}',
                    plugin: '{{ $block->plugin->class()->getName() }}'
                }
            });
        }
    });
</script>