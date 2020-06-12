<?php
    //Content
    $select_post        = get_field('select_posts');
    $select_category    = get_field('select_category') ? implode(', ', get_field('select_category')) : '';
    $p_count            = get_field('use_latest_posts') ? get_field('number_of_posts') : count($select_post);

    if ( get_field('use_latest_posts') ) {
        if ( $select_category ) {
            $posts = wp_get_recent_posts(array('numberposts' => $p_count, 'post_status' => 'publish', 'category' => $select_category), OBJECT);
        } else {
            $posts = wp_get_recent_posts(array('numberposts' => $p_count, 'post_status' => 'publish'), OBJECT);
        }
    } else {
        $posts = get_field('select_posts');
    }

    //Styles
    $bg_color           = get_field('background_color');
    $style              = get_field('style');
    $columns            = get_field('number_of_columns');
    $show_images        = get_field('show_images');
    $show_post_meta     = get_field('show_post_meta');
    $show_excerpt       = get_field('show_excerpt');
    $classes            = $bg_color . ' ' . $style . ' equal-height';

    if ( $p_count % 4 == 0 ) {
        $col_thumb_size = 'column_image_four';
    } else {
        $col_thumb_size = 'column_iamge_three';
    }
    // if ( $equal_height ) {
    //     $classes .= ' equal-height';
    // }
?>

<section class="block post container-fluid <?php echo $classes; ?>">
    <?php block_custom_id(); ?>
    <div class="container">
        <?php echo get_block_header(); ?>
        <div class="row d-md-flex justify-content-center <?php echo $center; ?>">
            <?php if( $posts ): ?>
                <?php foreach( $posts as $post): ?>
                    <?php setup_postdata($post); ?>
                    <?php
                        $pID        =  $post->ID;
                        $image      = get_the_post_thumbnail( $pID, $col_thumb_size );
                        $title      = get_the_title($pID);
                        $author     = get_the_author_meta('display_name');
                        $date       = get_the_date('M dS, Y', $pID);
                        $excerpt    = get_field('custom_excerpt', $pID);
                        $link       = get_the_permalink($pID);
                    ?>
                <div class="col <?php echo $columns; ?>">
                    <?php if ( $show_images ) : ?>
                        <a href="<?php echo $link; ?>">
                            <?php echo $image; ?>
                        </a>
                    <?php endif; ?>
                    <div>
                        <h5 class="post-title"><a href="<?php echo $link; ?>"><?php echo $title; ?></a></h5>
                        <?php if ( $show_post_meta != 'none' ) : ?>
                            <ul class="post-meta">
                                <?php if ( $show_post_meta == 'date' ) : ?>
                                    <li><?php echo $date; ?></li>
                                <?php elseif ( $show_post_meta == 'author' ) : ?>
                                    <li><?php echo $author; ?></li>
                                <?php elseif ( $show_post_meta == 'all') : ?>
                                    <li><?php echo $date; ?></li>
                                    <li><?php echo $author; ?></li>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>
                        <?php if ( $show_excerpt ) : ?>
                            <div class="post-excerpt">
                                <?php if ( $excerpt ) : ?>
                                    <?php echo $excerpt; ?>
                                <?php else : ?>
                                    <?php echo excerpt(10, $pID); ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?><?php wp_reset_postdata(); ?>
        <?php endif; ?>
        </div>
        <?php echo get_block_button(); ?>
    </div>
</section>
