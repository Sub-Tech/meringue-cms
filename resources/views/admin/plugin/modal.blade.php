{{-- If the Plugin relies on premade Instances --}}
@if (array_key_exists('instances', $editSettings))

    <form action="{{ route('block.update', ['block' => $block]) }}" method="post">

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

    <form action="{{ $instance ? route('instance.update', ['instanceId' => $instance->id]) : route('instance.store') }}"
          method="post">

        @if($instance) {{ method_field('PATCH') }} @endif

        <input type="hidden" name="vendor" value="{{ $plugin->getVendor() }}">
        <input type="hidden" name="plugin" value="{{ $plugin->getName() }}">
        <input type="hidden" name="block_id" value="{{ $block->id }}">

        @foreach($editSettings['inputs'] as $inputName => $inputDetails)
            <div class="form-group">
                <label for="{{ $inputDetails['type'] }}-{{ $inputName }}">{{ ucfirst($inputName) }}</label>

                @if ($inputDetails['type'] == 'textarea')
                    <textarea name="{{ $inputName }}"
                              id="{{ $inputDetails['type'] }}-{{ $inputName }}">{{ $instance->$inputName ?? "" }}</textarea>

                    <script>CKEDITOR.replace('{{ $inputDetails['type'] }}-{{ $inputName }}');</script>
                @else
                    <input type="{{ $inputDetails['type'] }}" name="{{ $inputName }}"
                           id="{{ $inputDetails['type'] }}-{{ $inputName }}" class="form-control"
                           value="{{ $instance->$inputName ?? "" }}">
                @endif

            </div>
        @endforeach

        <input class="btn btn-primary" type="submit" value="Save">
    </form>

@endif