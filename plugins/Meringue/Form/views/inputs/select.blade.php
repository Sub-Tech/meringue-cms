<select name="{{ $input->name }}">
    @foreach(json_decode($input->options) as $option)
        <option value="{{ $option }}">{{ $option }}</option>
    @endforeach
</select>