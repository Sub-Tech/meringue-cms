@if (isset($block->instance_id))
    <img src="{{ $block->plugin->class()->getInstance($block->instance_id)->url }}">
@endif