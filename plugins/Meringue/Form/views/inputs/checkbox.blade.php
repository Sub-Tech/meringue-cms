@foreach(json_decode($input->options) as $option)
    <div class="checkbox">
        <label><input type="checkbox" name="{{ $input->name }}" value="{{ $option }}">{{ $option }}</label>
    </div>
@endforeach
