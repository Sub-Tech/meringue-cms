<form id="form-{{ $form->id }}" action="/{{ $form->uri }}" method="POST">

    <input type="hidden" name="vendor" value="Meringue">
    <input type="hidden" name="plugin" value="Form">
    <input type="hidden" name="form_id" value="{{ $form->id }}">

    @foreach($form->inputs as $input)
        <label>{{ $input->label }}</label><br/>
        @include('Meringue/Form/views/inputs/' . $input->type)<br/>
    @endforeach

    <input type="submit" value="Submit">
</form>