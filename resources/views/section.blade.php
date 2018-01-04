<?php if ($render_type == 'full_width') {
    foreach ($blocks as $block) {
        echo $block['html'];
    }
} else {?>


<div class="section" style="background-color: {{ $section->background_color }}; padding: {{ $section->padding }}">
    <div class='container'>
        <div class='row align-items-center'>

            <?php foreach ($blocks as $block) {
                echo $block['html'];
            }?>

        </div>
    </div>
</div>
<?php } ?>