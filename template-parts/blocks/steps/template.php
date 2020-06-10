<?php
    //Content
    $steps                  = get_field('steps');
    //Styles
    $style                  = get_field('style');
    $bg_color               = get_field('background_color');
    $h_padding              = get_field('horizontal_padding');
    $center                 = get_field('center_content') ? 'center' : '';
    $equal_height           = get_field('equal_height') ?  'equal_height' : '';


    $id = 'testimonial-' . $block['id'];

?>

<section class="block steps container-fluid <?php echo $bg_color . ' ' . $style . ' ' . $h_padding . ' ' . $equal_height; ?>">
    <?php block_custom_id(); ?>
    <div class="container">
        <?php echo get_block_header(); ?>
        <div class="row <?php echo $center; ?>">
        <?php if( have_rows('steps') ): $count = 0; ?>
            <?php while( have_rows('steps') ): $count++; the_row(); ?>
                <?php
                    $header         = get_sub_field('heading');
                    $subheader      = get_sub_field('subheading');
                    $content        = get_sub_field('content');
                    $link           = get_sub_field('link');
                    if ( $link ) {
                        $link_text      = $link['text'];
                        $link_url       = $link['url'];
                    }
                ?>
                <div class="col-sm step-<?php echo $count; ?>">
                    <div>
                        <span class="step-number"><?php echo $count; ?></span>
                        <?php if ( $header ) : echo '<h4>' . $header . '</h4>'; endif; ?>
                        <?php if ( $subheader ) : echo '<h5>' . $subheader . '</h5>'; endif; ?>
                        <?php if ( $content ) : echo '<p>' . $content . '</p>'; endif; ?>
                        <?php if ( $link ) : echo '<a class="button" href="' . $link['url'] . '">' . $link['title'] . '</a>'; endif; ?>
                    </div>
                </div>
            <?php endwhile; $count = 0; ?>
        <?php endif; ?>
        </div>
        <?php echo get_block_button(); ?>
    </div>
</section>
