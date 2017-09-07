<script src="/assets/plugins/Meringue/PhotoGallery/assets/js/slick.min.js"></script>
<link rel="stylesheet" href="/assets/plugins/Meringue/PhotoGallery/assets/css/slick.css">

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