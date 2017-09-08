<div class="slider-for">
    @forelse($mainGallery->images as $image)
        {{ $image->id }}
    @empty
        Nada
    @endforelse
</div>

<hr/>

<div class="slider-nav">
    @forelse($navGallery->images as $image)
        {{ $image->id }}
    @empty
        Zip
    @endforelse
</div>

<script>
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: true,
        centerMode: true,
        focusOnSelect: true
    });
</script>