@php
    $plugin = \App\Helpers\PluginInitialiser::getPlugin($block->plugin->class_name);
    $editSettings = $plugin->registerBlock();
@endphp

{{-- If the Plugin relies on premade Instances --}}
@if (array_key_exists('instances', $editSettings))

    <form action="{{ route('block.update', ['block'=>$block]) }}" method="post">
        <input type="hidden" name="id" value="{{ $block->id }}">

        <div class="form-group">
            <select name="instance_id" class="form-control">
                @foreach($editSettings['instances'] as $instance)
                    <option value="{{ $instance->id }}">{{ $instance->name }}</option>
                @endforeach
            </select>
        </div>

        <input class="btn btn-primary" type="submit" value="Assign {{ $plugin->getName() }}">
    </form>

    {{-- Else if the Plugin can be spun up on the go --}}
@elseif (array_key_exists('inputs', $editSettings))

    <form action="{{ route('instance.store') }}" method="post">

        <input type="hidden" name="vendor" value="{{ $plugin->getVendor() }}">
        <input type="hidden" name="plugin" value="{{ $plugin->getName() }}">
        <input type="hidden" name="block_id" value="{{ $block->id }}">
        <input type="hidden" name="section_id" value="{{ $block->section->id }}">

        @foreach($editSettings['inputs'] as $inputName => $inputDetails)
            <div class="form-group">
                <label>{{ ucfirst($inputName) }}</label>
                <input type="{{ $inputDetails['type'] }}" name="{{ $inputName }}" class="form-control">
            </div>
        @endforeach

        <input class="btn btn-primary" type="submit" value="Save">
    </form>

@endif