@foreach(json_decode($input->options) as $option)
    <input type="checkbox" name="{{ $input->name }}" value="{{ $option }}">{{ $option }}<br/>
@endforeach