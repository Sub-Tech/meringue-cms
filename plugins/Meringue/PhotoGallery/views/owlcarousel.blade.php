<script src="{{ route('assets.js.slick') }}"></script>
<link rel="stylesheet" href="{{ route('assets.css.slick') }}">

<div class="owl-carousel">
    @foreach($images as $image)
        <div><img src="{{ $image->url }}"></div>
    @endforeach
</div>

<script>
    $(document).ready(function () {
        $('.owl-carousel').slick();
    });
</script>