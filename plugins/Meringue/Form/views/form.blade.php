<form id="form-{{ $form->id }}" action="/{{ $form->uri }}" method="POST">

    <input type="hidden" name="form_id" value="{{ $form->id }}">

    @foreach($form->inputs as $input)
        <div class="form-group">
            <label for="{{ $input->form_input_id }}">{{ $input->label }}</label>
            @include('Meringue/Form/views/inputs/' . $input->type)
        </div>
    @endforeach

    <input type="submit" value="Submit">
</form>