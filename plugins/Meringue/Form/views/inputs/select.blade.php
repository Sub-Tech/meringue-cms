<select id="{{ $input->name }}-{{ $input->id }}" name="{{ $input->name }}" class="form-control">
    @foreach(json_decode($input->options) as $option)
        <option value="{{ $option }}">{{ $option }}</option>
    @endforeach
</select>
