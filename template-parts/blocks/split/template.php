<?php
    //Content
    $main_content           = get_field('main_content');
    $main_content_btn       = get_field('main_content_button');
    $secondary_content_type = get_field('secondary_content_type');
    $secondary_content      = get_field('secondary_content_' . $secondary_content_type);
    $secondary_image_link   = get_field('secondary_image_link');
    $secondary_button       = get_field('secondary_content_button');
    $secondary_button_color = get_field('secondary_button_color');
    //Styles
    $bg_color               = get_field('background_color');
    $h_padding              = get_field('horizontal_padding');
    $main_content_width     = get_field('main_content_width');
    $main_content_side      = get_field('main_content_side') == 'right' ? ' flex-row-reverse': '';
    $enable_secondary_bg    = get_field('enable_secondary_background');
    $secondary_bg           = get_field('enable_secondary_background') ? get_field('secondary_background_color') .' bg' : '';
    $flip_column_mobile     = get_field('flip_column_mobile') ? ' flip-mobile' : '';

    if ( $secondary_content_type == 'text' && $enable_secondary_bg ) {
        $margin = 'style="margin-top: 1.6em;"';
    } else {
        $margin = '';
    }
    if ( $secondary_content ) {
        if ( $main_content_width == 'col-md-9') {
            $addition_content_width = 'col-md-3';
        } elseif ( $main_content_width == 'col-md-6' ) {
            $addition_content_width = 'col-md-6';
        } elseif ( $main_content_width == 'col-md-3') {
            $addition_content_width = 'col-md-9';
        }
    } else {
        $main_content_width = 'col-12';
    }
    $id = 'splt-' . $block['id'];

?>

<section class="block split container-fluid <?php echo $bg_color . ' ' . $h_padding; ?>">
    <div class="container">
        <?php echo get_block_header(); ?>
        <div class="row d-flex<?php echo $main_content_side; ?><?php echo $flip_column_mobile; ?>">
            <div class="main-content <?php echo $main_content_width; ?>" <?php echo $margin; ?>>
                <?php echo $main_content; ?>
                <?php if ( $main_content_btn ) : ?>
                    <a href="<?php echo $main_content_btn['url']; ?>" class="button"><?php echo $main_content_btn['title']; ?></a>
                <?php endif; ?>
            </div>
            <?php if ( $secondary_content ) : ?>
                <div class="<?php echo $addition_content_width . ' ' . $secondary_content_type . ' ' . $secondary_bg; ?>">
                    <?php if ( $secondary_content_type == 'text') : ?>
                        <div>
                            <?php echo $secondary_content; ?>
                            <?php if ( $secondary_button['title'] ) : ?>
                                <a class="button <?php echo $secondary_button_color; ?>" href="<?php echo $secondary_button['url']; ?>"><?php echo $secondary_button['title']; ?></a>
                            <?php endif; ?>
                        </div>
                    <?php elseif ( $secondary_content_type == 'image' ) : ?>
                        <div>
                            <?php if ( $secondary_image_link ) : ?>
                                <a href="<?php echo $secondary_image_link; ?>">
                            <?php endif; ?>
                            <?php $img = wp_get_attachment_image_src($secondary_content, 'slideshow_image'); ?>
                            <img src="<?php echo $img[0]; ?>" alt="">
                            <?php if ( wp_get_attachment_caption($secondary_content) ) : ?>
                                <caption><?php echo wp_get_attachment_caption($secondary_content); ?></caption>
                            <?php endif; ?>
                            <?php if ( $secondary_image_link ) : ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php elseif ( $secondary_content_type == 'video') : ?>
                        <div class="embed-responsive embed-responsive-16by9">
                            <?php echo $secondary_content; ?>
                        </div>
                    <?php elseif ( $secondary_content_type == 'slideshow') : ?>
                        <?php $size = 'slideshow_image'; ?>
                        <?php if ( $secondary_content ) : ?>
                            <div class="splide <?php echo $id; ?>">
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        <?php if( have_rows('secondary_content_slideshow') ): ?>
                                        	<?php while( have_rows('secondary_content_slideshow') ): the_row(); ?>
                                                <?php
                                                    $image      = get_sub_field('image');
                                                    $caption    = get_sub_field('caption');
                                                ?>
                                                <li class="splide__slide">
                                                    <?php echo wp_get_attachment_image( $image, $size ); ?>
                                                    <?php if ( $caption ) : ?>
                                                        <div><?php echo $caption; ?></div>
                                                    <?php endif; ?>
                                                </li>
                                        	<?php endwhile; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php echo get_block_button(); ?>
    </div>
    <?php if ( $secondary_content_type == 'slideshow') : ?>
        <script type="text/javascript">
            jQuery(document).ready(function( $ ) {
                new Splide( '.splide.<?php echo $id; ?>', {
                    type : 'loop',
                    perPage: 1,
                    width: '100%',
                }).mount();
            });
        </script>
    <?php endif; ?>
</section>
