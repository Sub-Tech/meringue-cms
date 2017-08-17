@foreach(json_decode($input->options) as $option)
    <div class="radio">
        <label><input type="radio" name="{{ $input->name }}" value="{{ $option }}">{{ $option }}</label>
    </div>
@endforeach
