<?php
    //Content
    $content = get_field('content');

    //Styles
    $bg_color = get_field('background_color');
    $bg_image = get_field('background_image') ? ' style="background-image: url(' . get_field('background_image') . ')"' : '';

    $bg_image_pos = get_field('background_image_position');
    $align = get_field('align_content');
    $h_padding = get_field('horizontal_padding');
    $c_width = get_field('width_of_content') ? get_field('width_of_content') . '-width' : '';

    $classes = $bg_color . ' ' . $align . ' ' . $h_padding . ' ' . $c_width;

    if ( get_field('background_image') ) {
        $classes .= ' bg-img';
    }
?>

<section class="block full-width container-fluid <?php echo $classes; ?>" <?php echo $bg_image; ?>>
    <div class="container">
        <?php echo get_block_header(); ?>
        <div class="row">
            <div class="col-12">
                <?php echo $content; ?>
            </div>
        </div>
        <?php echo get_block_button(); ?>
    </div>
</section>
