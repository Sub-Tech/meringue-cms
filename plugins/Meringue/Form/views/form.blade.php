<form id="form-{{ $form->id }}">

    @foreach($form->inputs as $input)
        <label>{{ $input->label }}</label><br/>
        @include('Meringue/Form/views/inputs/' . $input->type)<br/>
    @endforeach

    <button id="fuckoff"></button>
</form>

<script>
    $("#fuckoff".on('click', function (e) {

        $.ajax({
            type: "{{ $form->verb ?? 'POST' }}",
            url: "/{{ $form->uri }}",
            data: $("#form-{{ $form->id }}").serialize()
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    }));
</script>