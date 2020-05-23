<?php
    //Content
    $content        = get_field('columns');
    $c_count        = count($content);

    //Styles
    $bg_color       = get_field('background_color');
    $style          = get_field('style');
    $columns        = get_field('number_of_columns');
    $media_type     = get_field('media_type');
    $equal_height   = get_field('equal_height');
    $center         = get_field('center_content') ? 'center' : '';
    $h_padding      = get_field('horizontal_padding');
    $link_column    = get_field('link_whole_column');
    $classes        = $bg_color . ' ' . $style . ' ' . $h_padding;

    if ( $equal_height ) {
        $classes .= ' equal-height';
    }
?>

<section class="block multi container-fluid <?php echo $classes; ?>">
    <div class="container">
        <?php echo get_block_header(); ?>
        <div class="row d-md-flex justify-content-center <?php echo $center; ?>">
        <?php if ( have_rows('columns') ) : ?>
            <?php while ( have_rows('columns') ) : the_row(); ?>
                <?php
                    $header         = get_sub_field('header');
                    $subheader      = get_sub_field('subheader');
                    $content        = get_sub_field('content');
                    $button         = get_sub_field('button');
                    $button_color   = get_sub_field('button_color');
                    $image          = get_sub_field('image');
                    if ( $c_count < 4 ) {
                        $image      = wp_get_attachment_image_src( $image, 'column_image_three' );
                    } else {
                        $image      = wp_get_attachment_image_src( $image, 'column_image_four' );
                    }
                    $icon       = get_sub_field('icon');
                ?>
                <div class="col <?php echo $columns; ?>">
                <?php if ( $button && $link_column ) : ?> <a href="<?php echo $button['url']; ?>"><?php endif; ?>

                    <?php if ( $media_type == 'image') : ?>
                        <?php if ( $image ) : ?>
                            <img src="<?php echo $image[0]; ?>" alt="<?php echo $header; ?>">
                        <?php endif; ?>
                    <?php elseif ( $media_type == 'icon') : ?>
                        <?php if ( $icon ) : ?>
                            <i class="<?php echo $icon; ?>"></i>
                        <?php endif; ?>
                    <?php endif; ?>

                <?php if ( $button && $link_column ) : ?></a><?php endif; ?>

                <?php if ( $header || $subheader || $content || $button ) : ?>
                    <div>
                        <?php if ( $header ) : ?>
                            <?php if ( $button && $link_column ) : ?> <a href="<?php echo $button['url']; ?>"><?php endif; ?>
                            <h4><?php echo $header; ?></h4>
                            <?php if ( $button && $link_column ) : ?></a><?php endif; ?>
                        <?php endif; ?>
                        <?php if ( $subheader ) : ?>
                            <?php if ( $button && $link_column ) : ?> <a href="<?php echo $button['url']; ?>"><?php endif; ?>
                            <h5><?php echo $subheader; ?></h5>
                            <?php if ( $button && $link_column ) : ?></a><?php endif; ?>
                        <?php endif; ?>
                        <?php if ( $content ) : ?>
                            <!-- <?php if ( $button && $link_column ) : ?> <a href="<?php echo $button['url']; ?>"><?php endif; ?> -->
                            <?php echo $content; ?>
                            <!-- <?php if ( $button && $link_column ) : ?></a><?php endif; ?> -->
                        <?php endif; ?>
                        <?php if ( $button ) : ?>
                            <?php if ( $button && $link_column ) : ?> <a href="<?php echo $button['url']; ?>"><?php endif; ?>
                            <a class="button <?php echo $button_color; ?>" href="<?php echo $button['url']; ?>"><?php echo $button['title']; ?></a>
                            <?php if ( $button && $link_column ) : ?></a><?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
        </div>
        <?php echo get_block_button(); ?>
    </div>
</section>
