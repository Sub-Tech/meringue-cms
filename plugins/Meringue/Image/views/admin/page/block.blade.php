@if (isset($block->instance_id))
    <img src="{{ $plugin->getInstance($block->instance_id)->url }}">
@endif