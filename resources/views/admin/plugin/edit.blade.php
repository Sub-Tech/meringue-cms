@php $editSettings = $plugin->registerBlock(); @endphp

@if (array_key_exists('instances', $editSettings))
    <form action="{{ route('block.update') }}" method="post">
        <input type="hidden" name="id" value="{{ $block->id }}">

        <select name="instance_id">
            @foreach($editSettings['instances'] as $instance)
                <option value="{{ $instance->id }}">{{ $instance->name }}</option>
            @endforeach
        </select>

        <input type="submit" value="Assign {{ $plugin->getName() }}">
    </form>
@elseif (array_key_exists('inputs', $plugin->registerBlock()))
    <form action="{{ route('inputs.store') }}" method="post">

        @foreach($editSettings['inputs'] as $inputName => $inputDetails)
            <input type="{{ $inputDetails['type'] }}" name="{{ $inputName }}">
        @endforeach
    </form>
@endif