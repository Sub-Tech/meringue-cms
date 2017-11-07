<form method="post" id="css-form" action="{{ route('section.css', ['section' => $section]) }}">

    {{ method_field('PATCH') }}

    <div class="row">
        <div class="col-md-4">
            <h6>Padding</h6>
        </div>

        <div class="col-md-8">
            <div class="form-group">
                <input class="form-control" id="padding" name="padding" placeholder="eg 10px 5px 0 5px"
                       value="{{ $section->padding }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <h6>Background Colour</h6>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <input class="form-control" type="color"
                       name="background_color" value="{{ $section->background_color }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <h6>Custom CSS</h6>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <textarea class="form-control" id="custom-css" name="custom_css">{!! $section->page->custom_css !!}</textarea>
            </div>
        </div>
    </div>
    <input type="submit" class="btn btn-primary">
</form>