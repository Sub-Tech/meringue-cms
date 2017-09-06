<script src="{{ route('assets.js.isotope') }}"></script>

<div class="grid">
    @foreach($images as $image)
        <div class="grid-item"><img src="{{ $image->url }}"></div>
    @endforeach
</div>

<style>
    .grid-item {
        width: 25%;
    }

    .grid-item--width2 {
        width: 50%;
    }
</style>


<script>
    var $grid = $('.grid').isotope({
        // options
        itemSelector: '.grid-item',
        layoutMode: 'fitRows'
    });

    $grid.imagesLoaded().progress(function () {
        $grid.isotope('layout');
    });
</script>