<form id="">

    @foreach($form->inputs as $input)
        <label>{{ $input->label }}</label><br/>
        @include('Meringue/Form/views/inputs/' . $input->type)<br/>
    @endforeach

    <button id="">Submit</button>
</form>

<script>
    // $.ajax
</script>