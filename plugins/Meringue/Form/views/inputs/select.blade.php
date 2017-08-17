<select id="{{ $input->form_input_id }}" name="{{ $input->name }}" class="form-control">
    @foreach(json_decode($input->options) as $option)
        <option value="{{ $option }}">{{ $option }}</option>
    @endforeach
</select>
