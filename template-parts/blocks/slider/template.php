<?php
    //Content
    $slides             = get_field('slides');
    $c_slides           = $slides ? count($slides) : '1';

    //Styles
    $bg_color           = get_field('background_color');
    $height             = get_field('height');
    $align              = get_field('align_content') ? 'content-' . get_field('align_content') : '';
    $c_width            = get_field('content_width');
    $auto_play          = get_field('auto_play');
    $speed              = get_field('speed');

    //Other
    $classes            = $bg_color . ' ' . $align . ' ' . $h_padding . ' ' . $c_width;
    $id                 = 'slider-' . $block['id'];
    $c_id               = get_field('custom_id') ? 'id="' . get_field('custom_id') . '"' : '';

    //Slider or Banner
    if ( $c_slides == 1 ) {
        $banner_type    = 'slide';
        $drag           = 'false';
        $arrows         = 'false';
        $auto_play      = 'false';
        $pagination     = 'false';
    } else {
        $banner_type    = 'loop';
        $drag           = 'true';
        $arrows         = 'true';
        $pagination     = 'true';
    }
?>

<section class="block splide slider container-fluid bg-img <?php echo $id; ?> <?php echo $classes; ?>" >
    <?php block_custom_id(); ?>
    <div class="splide__track">
        <ul class="splide__list">
            <?php if ( have_rows('slides') ) : ?>
                <?php while( have_rows('slides') ): the_row(); ?>
                    <?php
                        $image          = get_sub_field('slide_image');
                        $image          = wp_get_attachment_image_src( $image, 'slider_image' );
                        $header         = get_sub_field('header');
                        $header_size    = get_sub_field('header_size');
                        $subheader      = get_sub_field('subheader');
                        $subheader_size = get_sub_field('subheader_size');
                        $content        = get_sub_field('content');
                        $buttons        = get_sub_field('buttons');
                    ?>
                    <li class="splide__slide d-flex align-items-center" style="background-position: center; background-size: cover; background-image: url('<?php echo $image[0]; ?>');">
                        <div class="slide-content">
                            <div>
                                <?php if ( $header || $subheader ) : ?>
                                    <div class="block-header">
                                        <?php if ( $header ) : ?>
                                            <?php echo '<' . $header_size . '>' . $header . '</' . $header_size . '>'; ?>
                                        <?php endif; ?>
                                        <?php if ( $subheader ) : ?>
                                            <?php echo '<' . $subheader_size . '>' . $subheader . '</' . $subheader_size . '>'; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ( $content ) : ?>
                                    <?php echo $content; ?>
                                <?php endif; ?>
                                <?php if( have_rows('buttons') ) : ?>
                                    <div class="block-buttons"><ul class="buttons">
                                    <?php while( have_rows('buttons') ) : the_row(); ?>
                                        <?php
                                            $link       = get_sub_field('link');
                                            $color      = get_sub_field('color');
                                            if ( $link['title'] ) {
                                                $link_title = ' alt="' . $link['title'] . '"';
                                            }
                                            if ( get_sub_field('reverse') == 1 ) {
                                                $color .= ' reverse';
                                            }
                                        ?>

                                        <li><a href="<?php echo $link['url']; ?>" class="<?php echo $color; ?>" <?php echo $link_title; ?>><?php echo $link['title']; ?></a></li>

                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                <?php endwhile; ?>
            <?php endif; ?>
        </ul>
    </div>
    <script>
        jQuery(document).ready(function( $ ) {
            new Splide( '.splide.<?php echo $id; ?>', {
                type : '<?php echo $banner_type; ?>',
                cover  : true,
                perPage: 1,
                width: '100%',
                pagination: <?php echo $pagination; ?>,
                arrows: <?php echo $arrows; ?>,
                drag: <?php echo $drag; ?>,
                height : '<?php echo $height; ?>',
                autoplay : '<?php echo $auto_play; ?>',
                interval : '<?php echo $speed; ?>',
            }).mount();
        });
    </script>
</section>
