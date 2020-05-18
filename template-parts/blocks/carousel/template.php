<?php
    //Content
    $images             = get_field('images');
    //Styles
    $bg_color           = get_field('background_color');
    $h_padding          = get_field('horizontal_padding');
    $number_of_slides   = get_field('number_of_slides') ? get_field('number_of_slides') : '5';
    $auto_play          = get_field('autoplay')? 'true' : 'false';


    $classes = $bg_color . ' ' . $h_padding;
    $id = 'carouse-' . $block['id'];
?>

<section class="block carousel container-fluid <?php echo $id; ?> <?php echo $classes; ?>">
    <div class="container">
        <?php echo get_block_header(); ?>
        <div class="row">
            <div class="splide <?php echo $id; ?>">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php if( $images ): ?>
                        	<?php foreach( $images as $image ): ?>
                        		<li class="splide__slide">
                                    <?php $img = wp_get_attachment_image_src( $image, 'medium' ); ?>
                        			<img src="<?php echo $img[0]; ?>" alt="">
                        		</li>
                        	<?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php echo get_block_button(); ?>
    </div>
</section>

<script>
    jQuery(document).ready(function( $ ) {
        new Splide( '.splide.<?php echo $id; ?>', {
            type : 'loop',
            gap: 20,
            width: '100%',
            perPage: <?php echo $number_of_slides; ?>,
            autoplay : '<?php echo $auto_play; ?>',
        }).mount();
    });
</script>
