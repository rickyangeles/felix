<?php
    //Content
    $posts                  = get_field('select_testimonials');
    $c_posts                = $posts ? count($posts) : '1';
    //Styles
    $layout                 = get_field('layout');
    $show_details           = get_field('show_details');
    $show_rating            = get_field('show_rating');
    $bg_color               = get_field('background_color');
    $h_padding              = get_field('horizontal_padding');


    $id = 'testimonial-' . $block['id'];

    if ( $c_posts == 1 ) {
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

<section class="block testimonial container-fluid <?php echo $bg_color . ' ' . $h_padding; ?>">
    <div class="container">
        <?php echo get_block_header(); ?>
        <div class="row <?php echo $layout ?>">
            <?php if ( $layout == 'slider'): ?>
                <div class="splide <?php echo $id; ?>">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php if( $posts ): ?>
                            	<?php foreach( $posts as $post): ?>
                            		<?php setup_postdata($post); ?>
                                    <?php
                                        $pID        = $post->ID;
                                        $title      = get_the_title($pID);
                                        $name       = get_field('name', $pID) ? get_field('name', $pID) : '';
                                        $company    = get_field('company', $pID) ? ', ' .get_field('company', $pID) : '';
                                        $rating     = get_field('rating', $pID);
                                    ?>
                                    <li class="slide__slide single-testimonial">
                                        <h4><?php echo $title; ?></h4>
                                        <p><?php echo content(600); ?></p>
                                        <?php if ( $show_details ) : ?>
                                            <span><?php echo $name; ?><?php echo $company; ?></span>
                                        <?php endif; ?>
                                        <?php if ( $show_rating ) : ?>
                                            <?php $i = 0; ?>
                                            <?php if ( $rating ) : ?>
                                                <ul class="rating">
                                                    <?php
                                                        for($x=1;$x<=$rating;$x++) {
                                                            echo '<li><i class="fas fa-star"></i></li>';
                                                        }
                                                        if (strpos($rating,'.')) {
                                                            echo '<li class="half-star"></i><i class="far fa-star"></i><i class="fas fa-star-half"></li>';
                                                            $x++;
                                                        }
                                                        while ($x<=5) {
                                                            echo '<li><i class="far fa-star"></i></li>';
                                                            $x++;
                                                        }
                                                    ?>
                                                </ul>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </li>
                            	<?php endforeach; ?>
                            	<?php wp_reset_postdata(); ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            <?php elseif ( $layout == 'grid') : ?>
                <?php if( $posts ): ?>
                	<?php foreach( $posts as $post): ?>
                		<?php setup_postdata($post); ?>
                        <?php
                            $pID        = $post->ID;
                            $title      = get_the_title($pID);
                            $name       = get_field('name', $pID);
                            $company    = get_field('company', $pID);
                            $rating     = get_field('rating', $pID);
                        ?>
                        <div class="col-md-4 single-testimonial">
                            <h4><?php echo $title; ?></h4>
                            <p><?php echo excerpt(20, false, $pID); ?></p>
                            <?php if ( $show_details ) : ?>
                                <span><?php echo $name; ?>, <?php echo $company; ?></span>
                            <?php endif; ?>
                            <?php if ( $show_rating) : ?>
                                <?php $i = 0; ?>
                                <ul class="rating">
                                    <?php
                                    for($x=1;$x<=$rating;$x++) {
                                        echo '<li><i class="fas fa-star"></i></li>';
                                    }
                                    if (strpos($rating,'.')) {
                                        echo '<li class="half-star"></i><i class="far fa-star"></i><i class="fas fa-star-half"></li>';
                                        $x++;
                                    }
                                    while ($x<=5) {
                                        echo '<li><i class="far fa-star"></i></li>';
                                        $x++;
                                    }
                                    ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                	<?php endforeach; ?>
                	<?php wp_reset_postdata(); ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php echo get_block_button(); ?>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function( $ ) {
            new Splide( '.splide.<?php echo $id; ?>', {
                type : '<?php echo $banner_type; ?>',
                pagination: <?php echo $pagination; ?>,
                arrows: <?php echo $arrows; ?>,
                drag: <?php echo $drag; ?>,
                perPage: 1,
                width: '100%',
            }).mount();
        });
    </script>
</section>
