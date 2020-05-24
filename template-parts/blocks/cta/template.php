<?php
    //Content
    $header                 = get_field('header');
    $header_size            = get_field('header_size');
    $content                = get_field('content');
    $buttons                = get_field('buttons');
    $sub_text               = get_field('sub_text');

    //Styles
    $bg_color               = get_field('background_color');
    $layout                 = get_field('layout');
    $h_padding              = get_field('horizontal_padding');
    $c_width                = get_field('content_width') ? get_field('content_width') . '-width' : '';
    $center                 = get_field('center_content') ? 'center' : '';
    $subtext_location       = get_field('subtext_location');
    $id                     = 'cta-' . $block['id'];

    $classes                = $bg_color . ' ' . $layout . ' ' . $h_padding . ' ' . $center . ' ' . $c_width;

?>

<section class="block cta container-fluid <?php echo $classes; ?>">
    <div class="container">
        <?php if ( $layout == 'horizontal') : ?>
            <div class="row d-flex align-items-center">
                <div class="col-md-9">
                    <?php echo '<' . $header_size . '>'; ?><?php echo $header; ?><?php echo '</' . $header_size . '>'; ?>
                    <?php echo $content; ?>
                </div>
                <div class="col-md-3">
                    <?php if ( $subtext_location == 'top' ) : ?>
                        <?php if ( $sub_text ) : ?>
                            <span class="cta-sub-text"><?php echo $sub_text; ?></span>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php echo get_block_button(); ?>
                    <?php if ( $subtext_location == 'bottom' ) : ?>
                        <?php if ( $sub_text ) : ?>
                            <span class="cta-sub-text"><?php echo $sub_text; ?></span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php elseif ( $layout == 'vertical') : ?>
            <div class="row d-flex flex-column">
                <div class="col">
                    <?php echo '<' . $header_size . '>'; ?><?php echo $header; ?><?php echo '</' . $header_size . '>'; ?>
                    <?php echo $content; ?>
                    <?php echo get_block_button(); ?>
                    <?php if ( $sub_text ) : ?>
                        <span class="cta-sub-text"><?php echo $sub_text; ?></span>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
