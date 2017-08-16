@foreach(json_decode($input->options) as $option)
    <input type="radio" name="{{ $input->name }}" value="{{ $option }}">{{ $option }}<br/>
@endforeach