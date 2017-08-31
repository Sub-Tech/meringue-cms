<div class="owl-carousel">
    @foreach($images as $image)
        <img src="{{ $image->url }}">
    @endforeach
</div>

<script>
    $(document).ready(function () {
        $(".owl-carousel").owlCarousel();
    });
</script>